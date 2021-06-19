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
    $query = "SELECT lans.*, images.path FROM lans LEFT JOIN images ON lans.images_id = images.id ORDER BY DATE(lans.start) DESC LIMIT :offset , :limit";
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

/**
 * Insert a lan in the database
 * @param string $name
 * @param string $description
 * @param int $places
 * @param string $startTime date("Y-m-d H:i:s",$yourTimeStamp)
 * @param string $endTime date("Y-m-d H:i:s",$yourTimeStamp)
 * @return int|null insert id
 */
function insertLan($name, $description, $places, $startTime, $endTime)
{
    require_once("model/database.php");
    $query = "INSERT INTO lans (name, description, places, start, end ,state_id) SELECT :name, :description, :places, :startTime, :endTime , id FROM states WHERE type LIKE 'disabled'";
    return executeQueryInsert($query, createBinds([[":name", $name], [":description", $description], [":places", $places, PDO::PARAM_INT], [":startTime", $startTime], [":endTime", $endTime]]));
}

/**
 * Fetch a lan
 * @param string $name
 * @return array|null lan 1D array
 */
function selectLanByName($name)
{
    require_once("model/database.php");
    $query = "SELECT Lans.*, images.path FROM lans LEFT JOIN images ON lans.images_id = images.id WHERE name LIKE :name LIMIT 1";
    return executeQuerySelect($query, createBinds([[":name", $name]]))[0] ?? null;
}

// TODO: add state_id update
/**
 * Update a lan
 * @param string $name
 * @param string $description
 * @param int $places
 * @param string $startTime date("Y-m-d H:i:s",$yourTimeStamp)
 * @param string $endTime date("Y-m-d H:i:s",$yourTimeStamp)
 * @param int $lanId
 * @return int|null number of affected rows
 */
function updateLan($name, $description, $places, $startTime, $endTime, $lanId)
{
    require_once("model/database.php");
    $query = "UPDATE lans SET name = :name, description= :description, places= :places, start= :startTime, end= :endTime WHERE id = :lanId";
    return executeQueryIUDAffected($query, createBinds([[":name", $name], [":description", $description], [":places", $places, PDO::PARAM_INT], [":startTime", $startTime], [":endTime", $endTime], [":lanId", $lanId, PDO::PARAM_INT]]));
}

/**
 * updates lan image
 * @param int $teamId
 * @param int $lanId
 * @return int|null number of affected rows
 */
function updateLanImage($lanId, $imageId)
{
    require_once("model/database.php");
    $query = "UPDATE lans SET images_id = :imageId WHERE id = :lanId";
    return executeQueryIUDAffected($query, createBinds([[":imageId", $imageId, PDO::PARAM_INT], [":lanId", $lanId, PDO::PARAM_INT]]));
}

/**
 * Adds a relationship between a lan and an event
 * @param int $lanId
 * @param int $eventId
 * @return int|null inserted row id
 */
function insertLanEvent($lanId, $eventId)
{
    require_once("model/database.php");
    $query = "INSERT INTO lan_contains_event (lan_id, event_id) VALUES(:lanId, :eventId)";
    return executeQueryInsert($query, createBinds([[":lanId", $lanId, PDO::PARAM_INT], [":eventId", $eventId, PDO::PARAM_INT]]));
}

/**
 * Fetch every event in a lan
 * @param int $lanId
 * @return array|null
 */
function selectLanEvents($lanId){
    require_once("model/database.php");
    $query = "SELECT events.*, images.path FROM lans LEFT JOIN lan_contains_event AS j ON lans.id = j.lan_id LEFT JOIN events ON events.id = j.event_id LEFT JOIN images ON images.id = events.image_id WHERE lans.id = :lanId;";
    return executeQuerySelect($query,createBinds([[":lanId",$lanId,PDO::PARAM_INT]]));
}