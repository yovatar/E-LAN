<?php
//TODO refactor with bind params

/**
 * This function is designed to execute a query received as parameter
 * @param string $query : must be correctly build for sql (synthaxis) but the protection against sql injection will be done there
 * @param array $binds [":queryBind",$value] for sql injection prevention
 * @return array|null : get the query result (can be null)
 */
function executeQuerySelect($query, $binds = [])
{
    $queryResult = null;

    $dbConnexion = openDBConnexion(); //open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query); //prepare query

        // Bind params for safety
        foreach ($binds as $bind) {
            $statement->bindParam($bind["name"], $bind["value"], $bind["type"] ?? PDO::PARAM_STR);
        }

        $statement->execute(); //execute query
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC); //prepare result for client
    }
    $dbConnexion = null; //close database connexion
    return $queryResult;
}

/**
 * This function is designed to insert value in database
 * @param string $query
 * @param array $binds [":queryBind",$value] for sql injection prevention
 * @return bool|null : $statement->execute() return true is the insert was successful
 */
function executeQueryIUD($query, $binds = [])
{
    $queryResult = null;

    $dbConnexion = openDBConnexion(); //open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query); //prepare query

        // bind params for safety
        foreach ($binds as $bind) {
            $statement->bindParam($bind["name"], $bind["value"], $bind["type"] ?? PDO::PARAM_STR);
        }

        $queryResult = $statement->execute(); //execute query
    }
    $dbConnexion = null; //close database connexion
    return $queryResult;
}

/**
 * This this function executes a query and returns the number of affected rows
 * @param string $query
 * @param array $binds [":queryBind",$value] for sql injection prevention
 * @return int|null : number of rows affected | null on query failure
 */
function executeQueryIUDAffected($query, $binds = [])
{
    $queryResult = null;
    $affectedRows = null;
    $dbConnexion = openDBConnexion(); //open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query); //prepare query

        // bind params for safety
        foreach ($binds as $bind) {
            $statement->bindParam($bind["name"], $bind["value"], $bind["type"] ?? PDO::PARAM_STR);
        }

        $queryResult = $statement->execute(); //execute query
        if ($queryResult) {
            $affectedRows = $statement->rowCount();
        }
    }
    $dbConnexion = null; //close database connexion
    return $affectedRows;
}


/**
 * This function is designed to insert value in database
 * @param string $query
 * @param array $binds [":queryBind",$value] for sql injection prevention
 * @return int|null : last inserted id | $statement->execute() return true is the insert was successful
 */
function executeQueryInsert($query, $binds = [])
{
    $queryResult = null;

    $dbConnexion = openDBConnexion(); //open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query); //prepare query

        // bind params for safety
        foreach ($binds as $bind) {
            $statement->bindParam($bind["name"], $bind["value"], $bind["type"] ?? PDO::PARAM_STR);
        }

        $queryResult = $statement->execute(); //execute query

        if ($queryResult) {
            $queryResult = $dbConnexion->lastInsertId();
        } else {
            $queryResult = null;
        }
    }
    $dbConnexion = null; //close database connexion
    return $queryResult;
}

// TODO export logins to config file
/**
 * This function is designed to manage the database connexion. Closing will be not proceeded there. The client is responsible of this.
 * @return PDO|null
 */
function openDBConnexion()
{
    $tempDbConnexion = null;

    $sqlDriver = $GLOBALS["config"]["database"]["driver"];
    $hostname = $GLOBALS["config"]["database"]["hostname"];
    $port = $GLOBALS["config"]["database"]["port"];
    $charset = $GLOBALS["config"]["database"]["charset"];
    $dbName = $GLOBALS["config"]["database"]["name"];
    $userName = $GLOBALS["config"]["database"]["username"]; //par compatibilité avec le dépôt swisscenter
    $userPwd = $GLOBALS["config"]["database"]["password"];
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try {
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    } catch (PDOException $exception) {
        echo 'Connection failed: ' . $exception->getMessage();
    }
    return $tempDbConnexion;
}

/**
 * count entries in a table
 * @warning table must have an id column
 * @TODO handle failure
 * @param string $table table name
 */
function countEntries($table)
{
    $query = "SELECT COUNT(id) AS 'count' FROM $table";

    $res = executeQuerySelect($query, []);
    return $res[0]["count"];
}

/**
 * creates a binds array ["name" => $name, "value" => $value, "type" => $type]
 * @param string $name binding name in sql Eg. ":id"
 * @param mixed $value value to be checked and stored
 * @param int $type PDO::PARAM_type datatype in the database, defaults to string
 * @return array array with key/value pairs to be stored in an array passed to query execution
 */
function createBind($name, $value, $type = PDO::PARAM_STR)
{
    return ["name" => $name, "value" => $value, "type" => $type];
}

/**
 * creates a 2d array with binds for query execution
 * @param array $arr expected [[":param",value,PDO::PARAM_INT],[":otherParam",otherValue]]
 * @return array 2d array ready for query execution
 */
function createBinds($arr)
{
    $binds = [];
    foreach ($arr as $bind) {
        if (count($bind) < 2) {
            throw new Exception("Binds expect 2-3 values");
        } else {
            $tmp = createBind($bind[0], $bind[1], isset($bind[2]) ? $bind[2] : PDO::PARAM_STR);
            array_push($binds, $tmp);
        }
    }
    return $binds;
}
