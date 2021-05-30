<?php

/**
 * Fetch every lan in the database
 * @return array|null
 */
function selectLans()
{
    require_once("model/database.php");
    $query = "SELECT * FROM lans";
    return executeQuerySelect($query);
}

/**
 * Fetch lans for pagination
 * @param int $limit amount fetched
 * @param int $offset amount of matches skipped
 * @return array|null
 */
function selectLansList($limit, $offset = 0)
{
    require_once("model/database.php");
    // Create query string
    $query = "SELECT lans.*, images.path FROM lans LEFT JOIN images ON lans.images_id = images.id LIMIT :offset , :limit";
    // Fetch lans
    return executeQuerySelect($query, createBinds([[":offset", $offset, PDO::PARAM_INT], [":limit", $limit, PDO::PARAM_INT]]));
}

/**
 * Count the number of lans
 * @return int|null
 */
function countLans()
{
    require_once("model/database.php");
    $query = "SELECT COUNT(*) as 'count' FROM lans";
    return (int)executeQuerySelect($query)[0]["count"] ?? null;
}
