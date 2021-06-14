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
 * @return void
 */
function controllerCreateLAN($request)
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
                // Validate input
                $name = filter_var(@$request["name"],FILTER_SANITIZE_STRING);
                if(empty($name)) throw new Exception("Aucun nom donné");
                $description = filter_var(@$request["description"],FILTER_SANITIZE_STRING);
                $places = filter_var(@$request["places"],FILTER_VALIDATE_INT);
                if($places === false) throw new Exception("Places invalides");
                $start = filter_var(@$request["start"],FILTER_SANITIZE_STRING);
                if(empty($start)) throw new Exception("Aucune date de début passée");
                $end = filter_var(@$request["end"],FILTER_SANITIZE_STRING);
                if(empty($end)) throw new Exception("Aucune date de fin passée");

                // Translate date
                $start = date("Y-m-d H:i:s",strtotime($start));
                $end = date("Y-m-d H:i:s",strtotime($end));

                // Create LAN
                require_once("model/lans.php");
                $row = insertLan($name,$description,$places,$start,$end);
                if(!empty($request["image"])){

                }
            } catch(Exception $e){
                toast($e->getMessage(),"error");
                header("Location: /lan/create");
            }
        }
    } else {
        toast("Vous n'êtes pas modérateurs", "warning");
        header("Location: /forbidden");
    }
}
