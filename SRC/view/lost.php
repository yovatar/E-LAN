<?php

/**
 * lost view for unknown routes
 * @return void
 */
function viewLost()
{
    $title = "lost";

    ob_start();
?>

    <div class="flex justify-center">
        <p class="text-7xl font-mono text-center sm:text-left cursor-not-allowed">404 <a class="hover:bg-red-600 rounded-full py-1 px-2" href="https://fr.wiktionary.org/wiki/se_perdre">PERDU</a></p>
    </div>
    <div class="flex justify-center">
        <img src="public/images/lost3.jpg">
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
