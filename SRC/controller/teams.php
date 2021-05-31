<?php

/**
 * Fetches a list of teamss and informations for pagination
 * @param array $request expects $_GET with pageteams key
 * @return void
 */
function controllerTeamsList($request)
{
    // Pagination
    $pageteams = 1;
    $items = 5;
    if (!empty($request["pageteams"])) {
        if (filter_var($request["pageteams"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
            $pageteams = $request["pageteams"];
        }
    }

    // Fetch teams
    require_once("model/teams.php");
    $teams = selectTeamsList($items, $items * ($pageteams - 1));
    // Fetch team count
    $count = countTeams();

    // Display teams
    require_once("view/teamsList.php");
    viewTeamsList($teams, $pageteams, $count / $items);

}
