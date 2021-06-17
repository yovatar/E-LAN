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
        <p class="font-mono text-center cursor-not-allowed text-7xl sm:text-left">404 <a class="px-2 py-1 rounded-full hover:bg-red-600" href="https://fr.wiktionary.org/wiki/se_perdre">PERDU</a></p>
    </div>
    <div class="flex justify-center">
        <img src="/public/images/lost3.jpg">
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
