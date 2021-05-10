<?php

/**
 * displays home view
 * @return void
 */
function controllerHome()
{
    require_once("view/home.php");
    viewHome();
}

/**
 * displays lost view
 * @return void
 */
function controllerLost()
{
    require_once("view/lost.php");
    viewLost();
}

/**
 * displays forbidden view
 * @return void
 */
function controllerForbidden()
{
    require_once("view/forbidden.php");
    viewForbidden();
}

function controllerProtection(){
    require_once ("view/protection.php");
    viewProtect();
}