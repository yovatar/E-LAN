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

function insertLan($name, $description, $places, $startTime, $endTime)
{
    require_once("model/database.php");
    $query = "INSERT INTO lans (name, description, places, start, end) VALUES (:name, :description, :places, :startTime, :endTime )";
    return executeQueryInsert($query, createBinds([[":name", $name], [":description", $description], [":places", $places, PDO::PARAM_INT], [":startTime", $startTime], [":endTime", $endTime]]));
}

function selectLanByName($name)
{
    require_once("model/database.php");
    $query = "SELECT Lans.*, images.path FROM lans LEFT JOIN images ON lans.images_id = images.id WHERE name LIKE :name LIMIT 1";
    return executeQuerySelect($query, createBinds([[":name", $name]]))[0] ?? null;
}

function updateLan($name, $description, $places, $startTime, $endTime, $lanid)
{
    require_once("model/database.php");
    $query = "UPDATE lans SET name = :name, description= :description, places= :places, start= :startTime, end= :endTime WHERE id = :lanid";
    return executeQueryIUDAffected($query, createBinds([[[":name", $name], [":description", $description], [":places", $places, PDO::PARAM_INT], [":startTime", $startTime], [":endTime", $endTime],[":lanid", $lanid] ]]));
}

