<?php

#######################
# Router entry points #
#######################

/**
 * Handles account update requests
 */
function ControllerSettingsAccount($request, $files)
{
    // Check for authentication
    if (isAuthenticated()) {
        if (empty($request)) {
            // Display settings view
            require_once("view/settingsAccount.php");
            require_once("model/users.php");
            // Get user data
            $user = selectUserByEmail($_SESSION["user"]["email"]);
            // Check validity
            if (empty($user)) {
                logout();
                header("Location: /authentication/login?error=Session mismatch");
            } else {
                if ($user["image_id"] !== null) {
                    // get profile picture
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
                        $user = selectUserByEmail($_SESSION["user"]["email"]);
                        if (empty($user)) throw new Exception("Session mismatch");
                        $rows = updateUserImage($user["id"], $newPictureId);

                        if (empty($rows)) throw new Exception("Une erreur est survenue lors de l'ajout de votre image de profile");

                        // TODO : remove old image from the database and storage

                        break;
                    case "updatePassword":
                        echo "password";
                        break;
                    default:
                        throw new Exception("Action inconnue");
                }
                // Redirect to account settings with updated infos
                header("Location: /settings/account");
            } catch (Exception $e) {
                header("Location: /settings/account?error=" . $e->getMessage());
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}
