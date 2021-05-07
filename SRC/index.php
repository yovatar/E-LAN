<?php

// create/resume sessions
session_start();

// Global dependencies
require_once("lib/utils.php");
setlocale(LC_ALL, 'fr-CH');
date_default_timezone_set("Europe/Zurich");

// Controllers
require_once("controller/static.php");

// Router
// Remove get parameters
$uri = strtok($_SERVER["REQUEST_URI"], '?');
// Remove ending /
$uri = (strlen($uri) > 1) ? preg_replace("/\/$/", '', $uri) : $uri;

switch ($uri) {
    case '/':
    case '/home':
        controllerHome();
        break;
    case '/forbidden':
        controllerForbidden();
        break;
    default:
        controllerLost();
}
