<?php

/**
 * Fetches a list of lans and informations for pagination
 * @param array $request expects $_GET with page key
 * @return void
 */
function controllerLanList($request)
{
    // Pagination
    $page = 1;
    $items = 5;
    if (!empty($request["page"])) {
        if (filter_var($request["page"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
            $page = $request["page"];
        }
    }

    // Fetch lans
    require_once("model/lans.php");
    $lans = selectLansList($items, $items * ($page - 1));
    // Fetch lan count
    $count = countLans();

    // Display lans
    require_once("view/lansList.php");
    viewLansList($lans, $page, ceil($count / $items), isModerator());
}

/**
 * displays the lan creation form
 * @param array $request expects $_POST
 * @param array $files expects $_FILES
 * @return void
 */
function controllerCreateLAN($request, $files)
{
    require_once("controller/authentication.php");
    if (isModerator()) {
        // Check if there were inputs
        if (empty($request)) {
            // Show creation form
            require_once("view/createLAN.php");
            viewCreateLAN();
        } else {
            try {
                // Validate input format
                $name = filter_var(@$request["name"], FILTER_SANITIZE_STRING);
                if (empty($name)) throw new Exception("Aucun nom donné");
                $description = filter_var(@$request["description"], FILTER_SANITIZE_STRING);
                $places = filter_var(@$request["places"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 2147483647]]);
                if ($places === false) throw new Exception("Places invalides");
                $start = filter_var(@$request["start"], FILTER_SANITIZE_STRING);
                if (empty($start)) throw new Exception("Aucune date de début passée");
                $end = filter_var(@$request["end"], FILTER_SANITIZE_STRING);
                if (empty($end)) throw new Exception("Aucune date de fin passée");

                // Check date validity
                $start = strtotime($start);
                $end = strtotime($end);
                $maxTime = strtotime("9999-12-31");
                $minTime = strtotime("00:00:00", time());
                if ($start < $minTime) throw new Exception("La date de début ne peut pas être passée");
                if ($end < $minTime) throw new Exception("La date de fin ne peut pas être passée");
                if ($start > $maxTime) throw new Exception("La date de début est trop grande");
                if ($end > $maxTime) throw new Exception("La date de fin est trop grande");
                if ($start > $end) throw new Exception("Votre date de début doit être avant votre date de fin");
                // Format date
                $start = date("Y-m-d H:i:s", $start);
                $end = date("Y-m-d H:i:s", $end);

                // Clean name to avoid visual duplicates
                $name = trim($name);
                // Validate constraints
                require_once("model/lans.php");
                if (!empty(selectLanByName($name))) throw new Exception("Ce nom de LAN est déjà utilisé");

                // Create LAN
                $row = insertLan($name, $description, $places, $start, $end);
                if (empty($row)) throw new Exception("Erreur lors de l'ajout de votre LAN");

                // Handle image
                if (!empty($files["image"])) {
                    $picture = $files["image"];
                    // Save image
                    require_once("model/images.php");
                    $newPictureId = insertImage($picture["name"], $picture["tmp_name"]);
                    if ($newPictureId === null) toast("Erreur lors de la sauvegarde de votre image", "error");
                    $affected = updateLanImage($row, $newPictureId);
                    if (empty($affected)) toast("Une erreur est survenue lors de l'ajout de l'image à votre LAN", "error");
                }
                // Success message and redirection
                toast("Votre LAN a été crée avec succès", "success");
                header("Location: /lans/$name");
            } catch (Exception $e) {
                toast($e->getMessage(), "error");
                header("Location: /lan/create");
            }
        }
    } else {
        toast("Vous n'êtes pas modérateurs", "warning");
        header("Location: /forbidden");
    }
}

/**
 * Handles lan view requests
 * @param string $name name of the lan
 * @return void
 */
function controllerLan($name)
{
    // Fetch lan
    require_once("model/lans.php");
    $lan = selectLanByName($name);

    if (empty($lan)) {
        // Show error
        require_once("view/lost.php");
        viewLost();
    } else {
        $lan["events"] = selectLanEvents($lan["id"]);
        // Show lan page
        require_once("view/lan.php");
        viewLan($lan, isModerator());
    }
}


/**
 * Handles lan update requests
 * @param string $lanName
 * @param array $request Expects $_POST
 * @param array $files Expects $_FILES
 * @return void
 */
function controllerUpdateLan($lanName, $request, $files)
{
    require_once("controller/authentication.php");
    if (isModerator()) {
        try {
            // Format input
            if (empty($lanName)) throw new Exception("Aucune lan sélectionnée");
            $lanName = trim($lanName);
            // Check if the lan exist
            require_once("model/lans.php");
            $lan = selectLanByName($lanName);
            if (empty($lan)) throw new Exception("Aucune lan du nom : $lanName");

            if (empty($request)) {
                // Display update form 
                require_once("view/updateLan.php");
                viewUpdateLan($lan);
            } else {
                // Handle update
                try {
                    // Validate input format
                    $name = filter_var(@$request["name"], FILTER_SANITIZE_STRING);
                    if (empty($name)) throw new Exception("Aucun nom donné");
                    $description = filter_var(@$request["description"], FILTER_SANITIZE_STRING);
                    $places = filter_var(@$request["places"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 2147483647]]);
                    if ($places === false) throw new Exception("Places invalides");
                    $start = filter_var(@$request["start"], FILTER_SANITIZE_STRING);
                    if (empty($start)) throw new Exception("Aucune date de début passée");
                    $end = filter_var(@$request["end"], FILTER_SANITIZE_STRING);
                    if (empty($end)) throw new Exception("Aucune date de fin passée");

                    // Check date validity
                    $start = strtotime($start);
                    $end = strtotime($end);
                    $maxTime = strtotime("9999-12-31");
                    $minTime = strtotime("00:00:00", time());
                    if ($start < $minTime) throw new Exception("La date de début ne peut pas être passée");
                    if ($end < $minTime) throw new Exception("La date de fin ne peut pas être passée");
                    if ($start > $maxTime) throw new Exception("La date de début est trop grande");
                    if ($end > $maxTime) throw new Exception("La date de fin est trop grande");
                    if ($start > $end) throw new Exception("Votre date de début doit être avant votre date de fin");
                    // Format date
                    $start = date("Y-m-d H:i:s", $start);
                    $end = date("Y-m-d H:i:s", $end);

                    // Clean name to avoid visual duplicates
                    $name = trim($name);
                    if ($name !== $lan["name"]) {
                        // Validate constraints
                        require_once("model/lans.php");
                        if (!empty(selectLanByName($name))) throw new Exception("Ce nom de LAN est déjà utilisé");
                    }

                    if ($lan["name"] != $name || $lan["description"] != $description || $lan["places"] != $places || $lan["start"] != $start || $lan["end"] != $end) {
                        $affected = updateLan($name, $description, $places, $start, $end, $lan["id"]);
                        if (empty($affected)) throw new Exception("Une erreur est survenue lors de la mise à jour de votre lan.");
                    }

                    // Handle image
                    if (!empty($files["image"]) && !empty($files["image"]["size"])) {
                        $picture = $files["image"];
                        // Save image
                        require_once("model/images.php");
                        $newPictureId = insertImage($picture["name"], $picture["tmp_name"]);
                        if ($newPictureId === null) toast("Erreur lors de la sauvegarde de votre image", "error");
                        $affected = updateLanImage($lan["id"], $newPictureId);
                        if (empty($affected)) toast("Une erreur est survenue lors de l'ajout de l'image à votre LAN", "error");
                    }

                    toast("Lan mise a jour", "success");
                    header("Location: /lans/$name");
                } catch (Exception $e) {
                    toast($e->getMessage(), "error");
                    header("Location: /lan/update?lan=$lanName");
                }
            }
        } catch (Exception $e) {
            toast($e->getMessage(), "error");
            header("Location: /lans");
        }
    } else {
        toast("Vous n'êtes pas modérateur", "warning");
        header("Location: /forbidden");
    }
}
