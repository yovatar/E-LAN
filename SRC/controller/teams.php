<?php

/**
 * Handles team view requests
 * @param string $name name of the team
 * @return void
 */
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
        // Check if user is a member of the team
        $res = false;
        if (isAuthenticated()) {
            require_once("controller/authentication.php");
            $user = getCurrentUser();
            if (!empty("user")) {
                $res = isMember($team["members"], $user);
            }
        }
        $user = getCurrentUser();
        // Show team page
        require_once("view/team.php");
        viewTeam($team, $res, isTeamOwner($name));
    }
}

/**
 * Fetches a list of teams and informations for pagination
 * @param array $request expects $_GET with page key
 * @return void
 */
function controllerTeamsList($request)
{
    // Pagination
    $page = 1;
    $items = 5;
    if (!empty($request["page"])) {
        if (filter_var($request["page"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
            $page = $request["page"];
        }
    }

    // Fetch teams
    require_once("model/teams.php");
    $teams = selectTeamsList($items, $items * ($page - 1));
    // Fetch team count
    $count = countTeams();

    // Display teams
    require_once("view/teamsList.php");
    viewTeamsList($teams, $page, ceil($count / $items), canCreateTeam());
}

/**
 * Handles requests to join a team
 * @param array $request expects $_POST
 * @return void
 */
function controllerJoinTeam($request)
{
    // Check if the user is logged in
    require_once("controller/authentication.php");
    if (isAuthenticated() && !empty($request)) {
        // Validate input
        $teamName = filter_var($request["teamName"], FILTER_SANITIZE_STRING);
        if (empty($teamName)) {
            toast("Aucun nom d'équipe donné", "error");
            header("Location: /teams");
        } else {
            try {
                // Get user from the database to avoid issues
                require_once("model/users.php");
                $user = getCurrentUser();
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
                if (isMember($team["members"], $user)) throw new Exception("Vous faites déjà partie de cette équipe");
                // Add user to the team
                $row = insertTeamMember($team["id"], $user["id"]);
                if ($row === null) throw new Exception("Une erreur est survenue lors de l'ajout à l'équipe");
                // Reload team page
                header("Location: /teams/" . $teamName);
            } catch (Exception $e) {
                toast($e->getMessage(), "error");
                header("Location: /teams/" . $teamName);
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}

/**
 * Handles requests to quit a team
 * @param array $request expects $_POST
 * @return void
 */
function controllerQuitTeam($request)
{
    // Check if the user is logged in
    require_once("controller/authentication.php");
    if (isAuthenticated() && !empty($request)) {
        // Validate input
        $teamName = filter_var($request["teamName"], FILTER_SANITIZE_STRING);
        if (empty($teamName)) {
            toast("Aucun nom d'équipe donné", "error");
            header("Location: /teams");
        } else {
            try {
                // Get user from the database to avoid issues
                require_once("model/users.php");
                $user = getCurrentUser();
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
                if (!isMember($team["members"], $user)) throw new Exception("Vous ne faites pas partie de cette équipe");
                // Remove user from the team
                $affected = deleteTeamMember($team["id"], $user["id"]);
                if ($affected === null) throw new Exception("Une erreur est survenue lors de l'expulsion de l'équipe");
                // Check if the team is empty
                $disbanded = disbandEmptyTeam($team["id"]);
                if ($disbanded) {
                    toast("Votre équipe à été dissipée car il ne reste aucun membre", "info");
                    header("Location: /teams");
                } else {
                    // Check if the user is the team owner
                    if (isTeamOwner($team["name"])) {
                        $target = selectTeamUsers($team["name"],true)[0] ?? null;
                        if (!empty($target)) {
                            $affected = giveOwnership($team["id"], $target);
                            if ($affected) {
                                toast($target["username"] . " est le nouveau propriétaire de l'équipe", "info");
                            }
                        } else {
                            disbandTeam($team["id"]);
                            toast("Votre équipe a été dissipée car aucun membre ne pouvait prendre le role de propriétaire","warning");
                        }
                    }
                    // Reload team page
                    header("Location: /teams/" . $teamName);
                }
            } catch (Exception $e) {
                toast($e->getMessage(), "error");
                header("Location: /teams/" . $teamName);
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}

/**
 * Handles team creation requests
 * @param array $request expects $_POST
 * @param array $files expects $_FILES
 * @return void
 */
function controllerCreateTeam($request, $files)
{
    // Check if the user is logged in
    require_once("controller/authentication.php");
    if (canCreateTeam()) {
        // Check if there were inputs
        if (empty($request)) {
            // Show creation form
            require_once("view/createTeams.php");
            viewCreateTeams();
        } else {
            // Handle team creation
            // Get user from the database to avoid issues
            require_once("model/users.php");
            $user = getCurrentUser();
            if ($user === null) {
                logout();
                toast("Il semblerait que votre session utilisateur ait des problèmes", "error");
                header("Location: /authentication/login");
            } else {
                try {
                    // Check input
                    // Team name
                    $name = filter_var($request["name"], FILTER_SANITIZE_STRING);
                    if (empty($name)) throw new Exception("Vous n'avez pas fourni de nom d'équipe");
                    // Team abréviation
                    $abbreviation = filter_var($request["abbreviation"], FILTER_SANITIZE_STRING);
                    if (empty($abbreviation)) throw new Exception("Vous n'avez pas fourni d'abréviation'");

                    // Clean up abbreviation and name
                    $name = trim($name);
                    $abbreviation = trim($abbreviation);
                    // Check unique constraints
                    require_once("model/teams.php");
                    if (!empty(selectTeamByName($name))) throw new Exception("Nom d'équipe indisponible");
                    // Create team
                    $teamId = insertTeam($name, $abbreviation, $user["id"]);
                    if ($teamId === null) throw new Exception("Erreur lors de la sauvegarde de votre équipe");
                    try {
                        // Add user to the team as a member
                        $row = insertTeamMember($teamId, $user["id"]);
                        if (empty($row)) throw new Exception("Erreur lors de votre ajout à l'équipe");
                        // Image handling
                        if (!empty($files["image"]) && !empty($files["image"]["size"])) {
                            $picture = $files["image"];
                            // Save image
                            require_once("model/images.php");
                            $newPictureId = insertImage($picture["name"], $picture["tmp_name"]);
                            if ($newPictureId === null) throw new Exception("Erreur lors de la sauvegarde de votre image");
                            $affected = updateTeamImage($teamId, $newPictureId);
                            if (empty($affected)) throw new Exception("Une erreur est survenue lors de l'ajout de votre image d'équipe");
                        }
                    } catch (Exception $e) {
                        toast($e->getMessage(), "error");
                        header("Location: /teams/$name");
                    }

                    // Redirect to the team page
                    header("Location: /teams/$name");
                } catch (Exception $e) {
                    toast($e->getMessage(), "error");
                    header("Location: /createTeam");
                }
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}

/**
 * Handles kick requests
 * @param array $request expects $_POST
 * @return void
 */
function controllerKickMember($request)
{
    require_once("controller/authentication.php");
    if (isAuthenticated()) {
        // Validate input
        $teamName = filter_var($request["team"], FILTER_SANITIZE_STRING);
        if (empty($teamName)) {
            toast("Aucun nom d'équipe donné", "error");
            header("Location: /teams");
        } else {
            try {
                // Check for permissions
                if (!isTeamOwner($teamName)) throw new Exception("Vous n'êtes pas le propriétaire de cette équipe");
                // Validate input
                if (empty($request["target"])) throw new Exception("Aucun utilisateur ciblé");
                // Check if target is valid
                require_once("model/teams.php");
                require_once("model/users.php");
                $target = selectUserByEmail($request["target"]);
                if (empty($target)) throw new Exception("Utilisateur cible invalide");
                // Fetch team info
                $team = selectTeamByName($teamName);
                $team["members"] = selectTeamUsers($teamName);
                // Check if target is found in the team
                $tmp = false;
                foreach ($team["members"] as $member) {
                    if ($member["email"] == $target["email"]) $tmp = true;
                }
                if (!$tmp) throw new Exception("L'utilisateur ne fait pas partie de votre équipe");
                // Prevent self kicking
                if ($target["id"] == $team["owner_id"]) throw new Exception("Vous ne pouvez pas vous éjecter vous mêmes");
                // Remove target from the team
                $affected = deleteTeamMember($team["id"], $target["id"]);
                // Handle save errors
                if (empty($affected)) throw new Exception("Une erreur est survenue lors de l'ejection.");
                // Redirect to update visual
                toast($target["username"] . " a été expulsé", "success");
                header("Location: /teams/$teamName");
            } catch (Exception $e) {
                // Redirect with error message
                toast($e->getMessage(), "error");
                header("Location: /teams/$teamName");
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}

/**
 * Handles ownership change requests
 * @param array $request expects $_POST
 * @return void
 */
function controllerGiveOwnership($request)
{
    require_once("controller/authentication.php");
    if (isAuthenticated()) {
        // Validate input
        $teamName = filter_var($request["team"], FILTER_SANITIZE_STRING);
        if (empty($teamName)) {
            toast("Aucun nom d'équipe donné", "error");
            header("Location: /teams");
        } else {
            try {
                // Check for permissions
                if (!isTeamOwner($teamName)) throw new Exception("Vous n'êtes pas le propriétaire de cette équipe");
                // Validate input
                if (empty($request["target"])) throw new Exception("Aucun utilisateur ciblé");
                // Check if target is valid
                require_once("model/teams.php");
                require_once("model/users.php");
                $target = selectUserByEmail($request["target"]);
                if (empty($target)) throw new Exception("Utilisateur cible invalide");
                // Fetch team info
                $team = selectTeamByName($teamName);
                $team["members"] = selectTeamUsers($teamName);
                // Check if target is found in the team
                $tmp = false;
                foreach ($team["members"] as $member) {
                    if ($member["email"] == $target["email"]) $tmp = true;
                }
                if (!$tmp) throw new Exception("L'utilisateur ne fait pas partie de votre équipe");
                // Prevent self kicking
                if ($target["id"] == $team["owner_id"]) throw new Exception("Vous ne pouvez pas vous sélectionner vous mêmes");
                // Update owner
                $affected = giveOwnership($team["id"], $target);
                // Handle save errors
                if (empty($affected)) throw new Exception("Une erreur est survenue lors du changement.");
                // Redirect to update visual
                toast($target["username"] . " est le nouveau propriétaire de l'équipe", "success");
                header("Location: /teams/$teamName");
            } catch (Exception $e) {
                // Redirect with error message
                toast($e->getMessage(), "error");
                header("Location: /teams/$teamName");
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}

/**
 * Handle team disbanding requests
 * @param array $request expects $_POST
 * @return void
 */
function controllerTeamDisband($request)
{
    require_once("controller/authentication.php");
    if (isAuthenticated()) {
        // Validate input
        $teamName = filter_var($request["teamName"], FILTER_SANITIZE_STRING);
        if (empty($teamName)) {
            toast("Aucun nom d'équipe donné", "error");
            header("Location: /teams");
        } else {
            try {
                // Check for permissions
                if (!isTeamOwner($teamName)) throw new Exception("Vous n'êtes pas le propriétaire de cette équipe");
                // Delete team
                require_once("model/teams.php");
                $team = selectTeamByName($teamName);
                $disbanded = disbandTeam($team["id"]);
                if (empty($disbanded)) throw new Exception("Votre équipe n'as pas pu être dissipée");
                // Redirect to update visual
                toast("Équipe a été dissipée", "success");
                header("Location: /teams");
            } catch (Exception $e) {
                // Redirect with error message
                toast($e->getMessage(), "error");
                header("Location: /teams/$teamName");
            }
        }
    } else {
        header("Location: /authentication/login");
    }
}

/**
 * Check if an user is part of a given team
 * @param array $members
 * @param array $user
 * @return bool
 */
function isMember($members, $user)
{
    $res = false;
    foreach ($members as $member) {
        if ($member["email"] === $user["email"]) {
            $res = true;
            break;
        }
    }
    return $res;
}

/**
 * check whether current user is the owner of the team
 * @param string $teamName
 * @return bool
 */
function isTeamOwner($teamName)
{
    require_once("controller/authentication.php");
    $user = getCurrentUser();
    if (!empty($user)) {
        require_once("model/teams.php");
        $owner = selectTeamOwner($teamName);
        if (empty($owner)) {
            $res = false;
        } else {
            $res = $owner["email"] === $user["email"];
        }
    }
    return $res ?? false;
}

/**
 * check if user owns any team
 * @return bool
 */
function ownsTeams($email)
{
    require_once("model/users.php");
    $teams = selectOwnedTeams($email);
    return !empty($teams);
}

/**
 * check if user has the permissions to create a team
 * @return bool
 */
function canCreateTeam()
{
    return isAuthenticated() && !ownsTeams($_SESSION["user"]["email"]);
}

/**
 * Check if a given team is empty and disbands it if it's the case
 * @param int $teamId
 * @return bool true when the team was disbanded
 */
function disbandEmptyTeam($teamId)
{
    require_once("model/teams.php");
    if (countTeamMembers($teamId) === 0) {
        $res = disbandTeam($teamId);
    }
    return $res ?? false;
}

/**
 * give team ownership to an user, provides prevention against abuses
 * @param int $teamId
 * @param array $user user object
 * @return bool
 */
function giveOwnership($teamId, $user)
{
    require_once("model/teams.php");
    if (!ownsTeams($user["email"])) {
        $affected = updateTeamOwner($teamId, $user["id"]);
    } else {
        toast($user["username"] . " est déjà propriétaire d'une équipe", "warning");
    }
    return !empty($affected) ?? false;
}

/**
 * Disbands a team
 * @todo prevent disbanding during lans
 * @param int $teamId
 * @return bool true on success
 */
function disbandTeam($teamId)
{
    // Remove team
    require_once("model/teams.php");
    $affected = deleteTeam($teamId);
    return !empty($affected);
}
