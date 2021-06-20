<?php

/**
 * Fetch every event with a give name
 * @param string $name
 * @return array|null
 */
function selectEventsWithName($name)
{
    require_once("model/database.php");
    $query = "SELECT * FROM events WHERE events.name LIKE :name ;";
    return executeQuerySelect($query, createBinds([[":name", $name]]));
}

/**
 * Store an event in the database
 * @param string $name
 * @param string $description
 * @param string $type
 * @param string $start
 * @param string $end
 * @return int|null inserted row
 */
function insertEvent($name, $description, $type, $start, $end)
{
    require_once("model/database.php");
    $query = "INSERT INTO events (name, description, type, start, end) VALUES(:name, :description, :type, :start, :end);";
    return executeQueryInsert($query, createBinds([[":name", $name], [":description", $description], [":type", $type], [":start", $start], [":end", $end]]));
}

/**
 * Fetch an event with a given id
 * @param int $id
 * @return array|null 1D array of an event
 */
function selectEvent($id)
{
    require_once("model/database.php");
    $query = "SELECT events.*, images.path, lans.start AS 'minTime', lans.end AS 'maxTime', lans.name AS 'lan' FROM events LEFT JOIN lan_contains_event AS j ON j.event_id = events.id LEFT JOIN lans ON lans.id = j.lan_id LEFT JOIN images ON images.id = events.image_id WHERE events.id = :id LIMIT 1;";
    return executeQuerySelect($query, createBinds([[":id", $id, PDO::PARAM_INT]]))[0] ?? null;
}

/**
 * Update event image
 * @param int $eventId
 * @param int $imageId
 * @return int|null number of affected rows
 */
function updateEventImage($eventId, $imageId)
{
    require_once("model/database.php");
    $query = "UPDATE events SET image_id = :imageId WHERE id = :eventId";
    return executeQueryIUDAffected($query, createBinds([[":imageId", $imageId, PDO::PARAM_INT], [":eventId", $eventId, PDO::PARAM_INT]]));
}

/**
 * Fetch a specific event
 * @param string $name
 * @param string $start
 * @param string $end
 * @return array|null 1D array of an event
 */
function selectEventSpecific($name, $start, $end)
{
    require_once("model/database.php");
    $query = "SELECT * FROM events WHERE name LIKE :name AND start LIKE :start AND end LIKE :end LIMIT 1";
    return executeQuerySelect($query, createBinds([[":name", $name], [":start", $start], [":end", $end]]))[0] ?? null;
}

/**
 * Update an event in the database
 * @param int $id event id
 * @param string $name
 * @param string $description
 * @param string $type
 * @param string $start date("Y-m-d H:i:s",$yourTimeStamp)
 * @param string $end date("Y-m-d H:i:s",$yourTimeStamp)
 * @return int|null number of affected rows
 */
function updateEvent($id, $name, $description, $type, $start, $end)
{
    require_once("model/database.php");
    $query = "UPDATE events SET name = :name, description = :description, type = :type, start = :start, end = :end WHERE id = :id ;";
    return executeQueryIUDAffected($query, createBinds([[":id", $id, PDO::PARAM_INT], [":name", $name], [":description", $description], [":type", $type], [":start", $start], [":end", $end]]));
}
