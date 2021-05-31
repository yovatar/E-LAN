<?php

function controllerTeam($name)
{
    // Fetch team
    require_once("model/teams.php");
    $team = selectTeamByName($name);

    if (empty($team)) {
        // Show error
        require_once("view/lost.php");
        viewLost();
    } else {
        // TODO: fetch team members
        // $team["members"] = [["username" => "Paul"], ["username" => "Matt"], ["username" => "Steve"]];
        $team["members"] = selectTeamUsers($team["name"]);
        // Show team page
        require_once("view/team.php");
        viewTeam($team);
    }
}
