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
 * Fetch teamss for pagination
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
 * Count the number of teamss
 * @return int|null
 */
function countTeams()
{
    require_once("model/database.php");
    $query = "SELECT COUNT(*) as 'count' FROM teams";
    return (int)executeQuerySelect($query)[0]["count"] ?? null;
}
