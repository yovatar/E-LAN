<?php

function controllerTeam($name)
{
    // Fetch team
    require_once("model/teams.php");
    $team = selectTeamByName($name);

    if(empty($team)){
        // Show error
        require_once("view/lost.php");
        viewLost();
    } else {
        // Show team page
        require_once("view/team.php");
        viewTeam($team);
    }
}
