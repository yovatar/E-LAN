<?php

function controllerCreateEvent($lanName, $request, $files)
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
                // Display creation form 
                require_once("view/createEvent.php");
                ViewCreateEvent($lan);
            } else {
                // Handle update
                try {
                    // Validate input format
                    $name = filter_var(@$request["name"], FILTER_SANITIZE_STRING);
                    if (empty($name)) throw new Exception("Aucun nom donné");
                    $description = filter_var(@$request["description"], FILTER_SANITIZE_STRING);
                    $type = filter_var(@$request["type"], FILTER_SANITIZE_STRING);
                    if (empty($type)) throw new Exception("Aucun type d'événement donné");
                    $start = filter_var(@$request["start"], FILTER_SANITIZE_STRING);
                    if (empty($start)) throw new Exception("Aucune date de début passée");
                    $end = filter_var(@$request["end"], FILTER_SANITIZE_STRING);
                    if (empty($end)) throw new Exception("Aucune date de fin passée");

                    // Check date validity
                    $start = strtotime($start);
                    $end = strtotime($end);
                    $maxTime = strtotime($lan["end"]);
                    $minTime = strtotime($lan["start"]);
                    if ($start < $minTime) throw new Exception("La date de début ne peut pas être avant votre lan");
                    if ($end < $minTime) throw new Exception("La date de fin ne peut pas être avant votre lan");
                    if ($start > $maxTime) throw new Exception("La date de début ne peut pas être après la fin de votre lan");
                    if ($end > $maxTime) throw new Exception("La date de fin ne peut pas être après la fin de votre lan");
                    if ($start > $end) throw new Exception("Votre date de début doit être avant votre date de fin");
                    // Format date
                    $start = date("Y-m-d H:i:s", $start);
                    $end = date("Y-m-d H:i:s", $end);

                    // Clean name to avoid visual duplicates
                    $name = trim($name);
                    // Check constraints
                    require_once("model/events.php");
                    $events = selectEventsWithName($name);
                    foreach ($events as $event) {
                        // TODO check for overlaps
                        if ($event["start"] == $start && $event["end"] == $end) throw new Exception("Un autre événement du même nom a lieu en même temps");
                    }

                    // Create event
                    $eventId = insertEvent($name, $description, $type, $start, $end);
                    if (empty($eventId)) throw new Exception("Erreur lors de l'ajout de votre événement");

                    // Add event to a lan
                    $res =  insertLanEvent($lan["id"], $eventId);
                    if (empty($res)) throw new Exception("Erreur lors de l'ajout de votre événement à la lan");

                    // Handle image
                    if (!empty($files["image"])) {
                        $picture = $files["image"];
                        // Save image
                        require_once("model/images.php");
                        $newPictureId = insertImage($picture["name"], $picture["tmp_name"]);
                        if ($newPictureId === null) toast("Erreur lors de la sauvegarde de votre image", "error");
                        $affected = updateEventImage($eventId, $newPictureId);
                        if (empty($affected)) toast("Une erreur est survenue lors de l'ajout de l'image à votre événement", "error");
                    }

                    toast("Événement crée", "success");
                    header("Location: /lans/$lanName");
                } catch (Exception $e) {
                    toast($e->getMessage(), "error");
                    header("Location: /event/create?lan=$lanName");
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
