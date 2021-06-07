<?php

/**
 * fetch all users from the database
 * @return array|null array of multiple users|query failure
 */
function selectUsers()
{
    require_once("model/database.php");
    $query = "SELECT * FROM users";
    return executeQuerySelect($query);
}

/**
 * fetch an user by email
 * @param string $email
 * @return array|null array of one user|null on no match
 */
function selectUserByEmail($email)
{
    require_once("model/database.php");
    $query = "SELECT * FROM users WHERE email LIKE :email LIMIT 1";
    return executeQuerySelect($query, createBinds([[":email", $email]]))[0] ?? null;
}

/**
 * fetch an user by username
 * @param string $username
 * @return array|null array of one user|null on no match
 */
function selectUserByUsername($username)
{
    require_once("model/database.php");
    $query = "SELECT * FROM users WHERE username LIKE :username LIMIT 1";
    return executeQuerySelect($query, createBinds([[":username", $username]]))[0] ?? null;
}

/**
 * fetch every team owned by an user
 * @warn should only have one team but this can still be bypassed
 * @param string $email
 * @return array|null
 */
function selectOwnedTeams($email)
{
    require_once("model/database.php");
    $query = "SELECT teams.* FROM teams LEFT JOIN users ON teams.owner_id = users.id WHERE users.email LIKE :email";
    return executeQuerySelect($query, createBinds([[":email", $email]]));
}

/**
 * updates user image
 * @param int $userId
 * @param int $imageId
 * @return int|null number of affected rows
 */
function updateUserImage($userId, $imageId)
{
    require_once("model/database.php");
    $query = "UPDATE users SET image_id = :imageId WHERE id = :userId";
    return executeQueryIUDAffected($query, createBinds([[":imageId", $imageId, PDO::PARAM_INT], [":userId", $userId, PDO::PARAM_INT]]));
}

/**
 * updates user password
 * @param int $userId
 * @param string $password
 * @return int|null number of affected rows
 */
function updateUserPassword($userId, $password)
{
    require_once("model/database.php");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = :password WHERE id = :id";
    return executeQueryIUDAffected($query, createBinds([[":password", $password], [":id", $userId, PDO::PARAM_INT]]));
}

/**
 * store an user in the database
 * @param string $username
 * @param string $email
 * @param string $lastName
 * @param string $firstName
 * @param string $password
 * @return bool|null
 */
function insertUser($username, $email, $lastName, $firstName, $password)
{
    require_once("model/database.php");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, firstname, lastname, password) VALUES(:username, :email, :firstName, :lastName, :password)";
    return executeQueryIUD($query, createBinds([[":username", $username], [":email", $email], [":firstName", $firstName], [":lastName", $lastName], [":password", $password]]));
}
