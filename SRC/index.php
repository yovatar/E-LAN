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

// Router
// Remove get parameters
$uri = strtok($_SERVER["REQUEST_URI"], '?');
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
        case  '/protection':
            controllerProtection();
            break;
        case '/condition':
            controllerCondition();
            break;
        case '/equipe':
            controllerEquipe();
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
