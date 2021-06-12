<?php

#######################
# Router entry points #
#######################

/**
 * Handles account update requests
 * @param array $request expects $_POST
 * @param array $files expects $_FILES
 */
function ControllerSettingsAccount($request, $files)
{
    // Check for authentication
    require_once("controller/authentication.php");
    if (isAuthenticated()) {
        if (empty($request)) {
            // Display settings view
            require_once("view/settingsAccount.php");
            require_once("model/users.php");
            // Get user data
            $user = getCurrentUser();
            // Check validity
            if (empty($user)) {
                logout();
                toast("Session non cohérente","error");
                header("Location: /authentication/login");
            } else {
                // get profile picture if available
                if ($user["image_id"] !== null) {
                    require_once("model/images.php");
                    $user["image"] = selectImageById($user["image_id"]);
                }
                // Display account settings
                viewSettingsAccount($user);
            }
        } else {
            try {
                switch ($request["action"]) {
                    case "updatePicture":
                        // Validate input
                        if (empty($files["profilePicture"])) throw new Exception("Aucune image donnée");
                        $picture = $files["profilePicture"];

                        // Save image
                        require_once("model/images.php");
                        $newPictureId = insertImage($picture["name"], $picture["tmp_name"]);
                        if ($newPictureId === null) throw new Exception("Erreur lors de la sauvegarde de votre image");

                        // Update profile
                        require_once("model/users.php");
                        $user = getCurrentUser();
                        if (empty($user)) throw new Exception("Session mismatch");
                        $rows = updateUserImage($user["id"], $newPictureId);

                        if (empty($rows)) throw new Exception("Une erreur est survenue lors de l'ajout de votre image de profile");


                        // Update session for next refresh
                        refreshLogin($_SESSION["user"]["email"]);
                        // TODO : remove old image from the database and storage

                        break;
                    case "updatePassword":
                        // Validate input
                        if (empty($request["oldPassword"])) throw new Exception("Aucun ancient mot de passe donné");
                        if (empty($request["newPassword"])) throw new Exception("Aucun nouveau mot de passe donné");
                        if (empty($request["newPasswordConfirm"])) throw new Exception("Aucune confirmation de mot de passe donnée");

                        // Fetch user from the database
                        require_once("model/users.php");
                        $user = getCurrentUser();
                        if (empty($user)) throw new Exception("Session mismatch");

                        // Check if the old password is right
                        if (password_verify($request["oldPassword"], $user["password"]) == false) throw new Exception("Mot de passe invalide");

                        // Check if the new password matches its confirmation
                        if ($request["newPassword"] !== $request["newPasswordConfirm"]) throw new Exception("Le nouveau mot de passe et la confirmation ne sont pas identiques");

                        // Update password
                        updateUserPassword($user["id"], $request["newPassword"]);
                        logout();

                        break;
                    default:
                        throw new Exception("Action inconnue");
                }
                // Redirect to account settings with updated infos
                header("Location: /settings/account");
            } catch (Exception $e) {
                toast($e->getMessage(),"error");
                header("Location: /settings/account");
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}