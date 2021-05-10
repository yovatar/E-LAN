<?php

function selectUsers()
{
    require_once("model/database.php");
    $query = "SELECT * FROM users";
    return executeQuerySelect($query);
}

function selectUserByEmail($email)
{
    require_once("model/database.php");
    $query = "SELECT * FROM users WHERE email LIKE :email";
    return executeQuerySelect($query, createBinds([[":email", $email]]));
}

function insertUser($username, $email, $lastName, $firstName, $password)
{
    require_once("model/database.php");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, firstname, lastname, password) VALUES(:username, :email, :firstName, :lastName, :password)";
    return executeQueryIUD($query, createBinds([[":username", $username], [":email", $email], [":firstName", $firstName], [":lastName", $lastName], [":password", $password]]));
}
