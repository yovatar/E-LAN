<?php

/**
 * Team view
 * @return void
 */
function viewTeam($team)
{
    $title = $team["name"] ?? "Error";

    ob_start();
?>
    test
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
