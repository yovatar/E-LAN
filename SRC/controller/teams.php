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
        // Fetch members
        $team["members"] = selectTeamUsers($team["name"]);
        if (empty($team["members"][0]["username"])) $team["members"] = [];
        // Show team page
        require_once("view/team.php");
        viewTeam($team);
    }
}

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

function controllerJoinTeam($request)
{
    // Check if the user is logged in
    require_once("controller/authentication.php");
    if (isAuthenticated() && !empty($request)) {
        // Validate input
        $teamName = filter_var($request["teamName"], FILTER_SANITIZE_STRING);
        if (empty($teamName)) {
            header("Location: /teams?error=Aucun nom d'équipe donné");
        } else {
            try {
                // Get user from the database to avoid issues
                require_once("model/users.php");
                $user = selectUserByEmail($_SESSION["user"]["email"]);
                if ($user === null) {
                    logout();
                    throw new Exception("Il semblerait que votre session utilisateur ait des problèmes");
                }
                // Check if team exists
                require_once("model/teams.php");
                $team = selectTeamByName($teamName);
                if (empty($team)) throw new Exception("Équipe invalide");
                // Fetch team members
                $team["members"] = selectTeamUsers($teamName);
                // Check if the user is in the list
                foreach ($team["members"] as $member) {
                    if ($member["email"] === $_SESSION["user"]["email"]) throw new Exception("Vous faites déjà partie de cette équipe");
                }
                // Add user to the team
                $row = insertTeamMember($team["id"], $user["id"]);
                if ($row === null) throw new Exception("Une erreur est survenue lors de l'ajout à l'équipe");
                // Reload team page
                header("Location: /teams/" . $teamName);
            } catch (Exception $e) {
                header("Location: /teams/" . $teamName . "?error=" . $e->getMessage());
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}
