<?php

/**
 * Fetch every team in the database
 * @return array|null
 */
function selectTeams()
{
    require_once("model/database.php");
    $query = "SELECT * FROM teams";
    return executeQuerySelect($query);
}

/**
 * Fetch a team
 * @param string $name
 * @return array|null
 */
function selectTeamByName($name)
{
    require_once("model/database.php");
    $query = "SELECT teams.*, images.path FROM teams LEFT JOIN images ON teams.images_id = images.id WHERE name LIKE :name LIMIT 1";
    return executeQuerySelect($query, createBinds([[":name", $name]]))[0] ?? null;
}

/**
 * Fetches every team member
 * @param string $teamName
 * @return array|null
 */
function selectTeamUsers($teamName)
{
    require_once("model/database.php");
    $query = "SELECT users.id, users.username, users.email, images.path FROM teams LEFT JOIN user_joins_team ON teams.id = user_joins_team.team_id LEFT JOIN users on users.id = user_joins_team.user_id LEFT JOIN images ON users.image_id = images.id WHERE teams.name LIKE :teamName";
    return executeQuerySelect($query, createBinds([[":teamName", $teamName]]));
}


/**
 * Fetch teams for pagination
 * @param int $limit amount fetched
 * @param int $offset amount of matches skipped
 * @return array|null
 */
function selectTeamsList($limit, $offset = 0)
{
    require_once("model/database.php");
    // Create query string
    $query = "SELECT teams.*, images.path FROM teams LEFT JOIN images ON teams.images_id = images.id LIMIT :offset , :limit";
    // Fetch teams
    return executeQuerySelect($query, createBinds([[":offset", $offset, PDO::PARAM_INT], [":limit", $limit, PDO::PARAM_INT]]));
}

/**
 * fetch id, username and email of the team owner
 * @param string $teamName
 * @return array|null
 */
function selectTeamOwner($teamName)
{
    require_once("model/database.php");
    $query = "SELECT users.id, users.username, users.email FROM users LEFT JOIN teams ON teams.owner_id = users.id WHERE teams.name LIKE :teamName LIMIT 1";
    return executeQuerySelect($query, createBinds([[":teamName", $teamName]]))[0] ?? null;
}

/**
 * Insert a team in the database
 * @param string $name
 * @param string $abbreviation
 * @param int $ownerId
 * @return int|null
 */
function insertTeam($name, $abbreviation, $ownerId = null)
{
    require_once("model/database.php");
    $query = "INSERT INTO teams (name, abbreviation, owner_id) VALUES (:name, :abbreviation, " . ($ownerId === null ? "NULL" : ":ownerId") . ")";
    return executeQueryInsert($query, createBinds([[":name", $name], [":abbreviation", $abbreviation], [":ownerId", $ownerId, PDO::PARAM_INT]]));
}

/**
 * Add an user to a team
 * @param int $teamId
 * @param int $userId
 * @return int|null
 */
function insertTeamMember($teamId, $userId)
{
    require_once("model/database.php");
    $query = "INSERT INTO user_joins_team(team_id, user_id) VALUES(:teamId, :userId);";
    return executeQueryInsert($query, createBinds([[":teamId", $teamId, PDO::PARAM_INT], [":userId", $userId, PDO::PARAM_INT]]));
}

/**
 * updates team image
 * @param int $teamId
 * @param int $imageId
 * @return int|null number of affected rows
 */
function updateTeamImage($teamId, $imageId)
{
    require_once("model/database.php");
    $query = "UPDATE teams SET images_id = :imageId WHERE id = :teamId";
    return executeQueryIUDAffected($query, createBinds([[":imageId", $imageId, PDO::PARAM_INT], [":teamId", $teamId, PDO::PARAM_INT]]));
}

/**
 * Remove an user from a team
 * @param int $teamId
 * @param int $userId
 * @return int|null number of affected lines
 */
function deleteTeamMember($teamId, $userId)
{
    require_once("model/database.php");
    $query = "DELETE FROM user_joins_team WHERE team_id = :teamId AND user_id = :userId;";
    return executeQueryIUDAffected($query, createBinds([[":teamId", $teamId, PDO::PARAM_INT], [":userId", $userId, PDO::PARAM_INT]]));
}

/**
 * Count the number of teams
 * @return int|null
 */
function countTeams()
{
    require_once("model/database.php");
    $query = "SELECT COUNT(*) as 'count' FROM teams";
    return (int)executeQuerySelect($query)[0]["count"] ?? null;
}
