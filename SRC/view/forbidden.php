<?php

/**
 * forbidden view. used with redirects to /forbidden
 * @return void
 */
function viewForbidden()
{
    $title = "forbidden";

    ob_start();
?>
    forbidden
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
