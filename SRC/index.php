<?php

// create/resume sessions
session_start();

// Global dependencies
require_once("lib/utils.php");
setlocale(LC_ALL, 'fr-CH');
date_default_timezone_set("Europe/Zurich");
include_once("config.php");
$GLOBALS["config"] = getConfig();

// Controllers
require_once("controller/static.php");
require_once("controller/authentication.php");
require_once("controller/settings.php");
require_once("controller/lans.php");
require_once("controller/teams.php");

// Router
// Remove get parameters
$uri = strtok($_SERVER["REQUEST_URI"], '?');
// Decode url
$uri = urldecode($uri);
// Remove ending /
$uri = (strlen($uri) > 1) ? preg_replace("/\/$/", '', $uri) : $uri;
// Check for api requests
$api = preg_match("/^\/api(?:\/|$)/", $uri);

if ($api == false) {
    // Web routes
    switch ($uri) {
        case '/':
        case '/home':
            controllerHome();
            break;
        case '/authentication/login':
            controllerLogin($_POST);
            break;
        case '/authentication/logout':
            controllerLogout($_POST);
            break;
        case '/authentication/register':
            controllerRegister($_POST);
            break;
        case '/forbidden':
            controllerForbidden();
            break;
        case '/settings':
        case '/settings/account':
            ControllerSettingsAccount($_POST, $_FILES);
            break;
        case '/lans':
            controllerLanList($_GET);
            break;
        case '/teams':
            controllerTeamsList($_GET);
            break;
        case (preg_match('/^\/teams\/(.+)$/', $uri, $res) ? $uri : false):
            controllerTeam($res[1]);
            break;
        case '/protection':
            controllerProtection();
            break;
        case '/condition':
            controllerCondition();
            break;
        case '/joinTeam':
            controllerJoinTeam($_POST);
            break;
        case '/createTeams':
            controllerCreateTeams();
            break;
        case '/createLAN':
            controllerCreateLAN();
            break;
        default:
            controllerLost();
    }
} else {
    // api dependencies
    require_once("controller/api/authentication.php");

    switch ($uri) {
        case '/api':
            $response = ["code" => 200, "status" => "success", "data" => ["message" => "api online"]];
            break;
        case '/api/authentication/available/username':
            $response = apiAvailableUsername($_POST);
            break;
        case '/api/authentication/available/email':
            $response = apiAvailableEmail($_POST);
            break;
        default:
            $response = ["code" => 400, "status" => "fail", "data" => ["message" => "unknown route"]];
    }

    echo json_encode($response);
}
