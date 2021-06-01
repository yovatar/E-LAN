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

function selectTeamUsers($teamName){
    require_once("model/database.php");
    $query = "SELECT users.username, images.path FROM teams LEFT JOIN user_joins_team ON teams.id = user_joins_team.team_id LEFT JOIN users on users.id = user_joins_team.user_id LEFT JOIN images ON users.image_id = images.id WHERE teams.name LIKE :teamName";
    return executeQuerySelect($query,createBinds([[":teamName",$teamName]]));
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
 * Count the number of teams
 * @return int|null
 */
function countTeams()
{
    require_once("model/database.php");
    $query = "SELECT COUNT(*) as 'count' FROM teams";
    return (int)executeQuerySelect($query)[0]["count"] ?? null;
}
