<?php

/**
 * Check if an username is available
 * @param array $request with "username" key
 * @return array $response
 */
function apiAvailableUsername($request)
{
    try {
        // Validate input
        if (empty($request)) throw new Exception("empty data received");

        $username = filter_var($request["username"], FILTER_SANITIZE_STRING);
        if (empty($username)) throw new Exception("empty username given");

        // Compare to database
        $response =  ["code" => 200, "status" => "success", "data" => ["available" => false]];

        require_once("model/users.php");
        if (empty(selectUserByUsername($username))) {
            $response["data"]["available"] = true;
        }
    } catch (Exception $e) {
        $response = ["code" => 400, "status" => "fail", "data" => ["message" => $e->getMessage()]];
    }

    return $response;
}

/**
 * Check if an email is available
 * @param array $request with "email" key
 * @return array $response
 */
function apiAvailableEmail($request)
{
    try {
        // Validate input
        if (empty($request)) throw new Exception("empty data received");

        $email = filter_var($request["email"], FILTER_VALIDATE_EMAIL);
        if ($email === false) throw new Exception("invalid email");

        // Compare to database
        $response =  ["code" => 200, "status" => "success", "data" => ["available" => false]];

        require_once("model/users.php");
        if (empty(selectUserByEmail($email))) {
            $response["data"]["available"] = true;
        }
    } catch (Exception $e) {
        $response = ["code" => 400, "status" => "fail", "data" => ["message" => $e->getMessage()]];
    }
    return $response;
}
