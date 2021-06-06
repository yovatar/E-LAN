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
    viewLansList($lans, $page, ceil($count / $items));
}
