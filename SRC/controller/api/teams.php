<?php

function apiTeamSearch($request){
    try {
        // Validate input
        if (empty($request)) throw new Exception("Aucune donnée reçue");

        $query = filter_var($request["query"], FILTER_SANITIZE_STRING);
        if (empty($query)) throw new Exception("Recherche vide");

        // Fetch database
        require_once("model/teams.php");
        $teams = selectTeamsSearch($query,5);

        $response =  ["code" => 200, "status" => "success", "data" => ["teams" => $teams]];
    } catch(Exception $e){
        $response = ["code" => 400, "status" => "fail", "data" => ["message" => $e->getMessage()]];
    }
    return $response;
}