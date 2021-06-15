<?php

/**
 * forbidden view. used with redirects to /forbidden
 * @return void
 */
function viewForbidden()
{
    $title = "Interdiction";

    ob_start();

?>
    <div class="flex justify-center">
        <p class="text-4xl font-mono"> Désolé vous n'avez pas le droit de faire cette action</p>
    </div>
<br><br>
        <div class="flex justify-center">
            <img  src="public/images/forbiden.png">
        </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}

