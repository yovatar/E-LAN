<?php

/**
 * Fetch every role from the database
 * @return array|null
 */
function selectRoles(){
    require_once("model/database.php");
    $query = "SELECT * FROM roles";
    return executeQuerySelect($query);
}

/**
 * Fetch a role with a given id
 * @param int $id
 * @return array|null
 */
function selectRole($id){
    require_once("model/database.php");
    $query = "SELECT * FROM roles WHERE id = :id LIMIT 1";
    return executeQuerySelect($query,createBinds([[":id",$id,PDO::PARAM_INT]]))[0] ?? null;
}

/**
 * Fetch a role with a given name
 * @param string $name
 * @return array|null
 */
function selectRoleByName($name){
    require_once("model/database.php");
    $query = "SELECT * FROM roles WHERE name LIKE :name LIMIT 1;";
    return executeQuerySelect($query,createBinds([[":name",$name]]))[0] ?? null;
}