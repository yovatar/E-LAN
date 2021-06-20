<?php

/**
 * Handles live lan search
 * @param array $request Expects $_POST
 * @return array
 */
function apiLanSearch($request){
    try {
        // Validate input
        if (empty($request)) throw new Exception("Aucune donnée reçue");

        $query = filter_var($request["query"], FILTER_SANITIZE_STRING);
        if (empty($query)) throw new Exception("Recherche vide");

        // Fetch database
        require_once("model/lans.php");
        $lans = selectLansSearch($query,5);

        $response =  ["code" => 200, "status" => "success", "data" => ["lans" => $lans]];
    } catch(Exception $e){
        $response = ["code" => 400, "status" => "fail", "data" => ["message" => $e->getMessage()]];
    }
    return $response;
}