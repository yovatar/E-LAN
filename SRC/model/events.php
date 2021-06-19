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
 * Update event image
 * @param int $eventId
 * @param int $imageId
 * @return int|null number of affected rows
 */
function updateEventImage($eventId, $imageId){
    require_once("model/database.php");
    $query = "UPDATE events SET image_id = :imageId WHERE id = :eventId";
    return executeQueryIUDAffected($query, createBinds([[":imageId", $imageId, PDO::PARAM_INT], [":eventId", $eventId, PDO::PARAM_INT]]));

}