<?php

/**
 * gets every image from the database
 * @warning limits and anf offset must be >= 0
 * @param int $limit maximum amount of entries returned
 * @param int $offset entries to be skipped
 * @return array|null array of images | null on query fail
 */
function selectImages($limit = null, $offset = null)
{
    require_once("model/dbConnector.php");
    $bindValue = [];
    if (isset($limit) && isset($offset)) {
        $query = "SELECT * FROM images LIMIT :offset, :limit";
        $bindValue = createBinds([[":offset", $offset, PDO::PARAM_INT], [":limit", $limit, PDO::PARAM_INT]]);
    } else if (isset($limit)) {
        $query = "SELECT * FROM images LIMIT :limit";
        $bindValue = createBinds([[":limit", $limit, PDO::PARAM_INT]]);
    } else {
        $query = "SELECT * FROM images";
    }

    $res = executeQuerySelect($query, $bindValue);
    return $res;
}

/**
 * gets image with a given id
 * @param int $id image id
 * @return array|null array of image (empty if no matches) | null on query fail
 */
function selectImageById($id)
{
    require_once("model/dbConnector.php");
    $query = "SELECT * FROM images WHERE id = :id LIMIT 1";

    $res = executeQuerySelect($query, createBinds([[":id", $id, PDO::PARAM_INT]]));
    return $res;
}

/**
 * adds an image to the database
 * @param string $fileName $_FILES["fileName"]
 * @param string $tempName $_FILES["tempName"]
 * @param string $directory file storage directory
 * @return int|null
 */
function addImage($fileName, $tempName, $directory = "/public/upload/img/")
{
    // Check file extension validity
    if (!preg_match("/.*(\.(?:(?:jpeg)|(?:jpg)|(?:png)|(?:gif)|(?:svg)))$/", $fileName, $extension)) {
        throw new Exception("Invalid filename filename => $fileName");
    }

    // Generate an unique filename
    do {
        $uniqueId = uniqId();
    } while (file_exists($_SERVER["DOCUMENT_ROOT"] . $directory . $uniqueId . $extension[1]));

    // Move image in upload
    move_uploaded_file($tempName, $_SERVER["DOCUMENT_ROOT"] . $directory . $uniqueId . $extension[1]);

    // Add entry to the database
    require_once("model/dbConnector.php");
    $query = "INSERT INTO images (path) VALUES (:path)";

    $res = executeQueryInsert($query, createBinds([[":path", $directory . $uniqueId . $extension[1]]]));
    return $res;
}
