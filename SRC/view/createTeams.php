<?php

/**
 * Team creation form
 * @return void
 *
 */
function viewCreateTeams()
{
    $title = "Création d'équipe";

    ob_start();
?>
    <div class="flex flex-row justify-center w-full p-8">
        <form action="/createTeam" method="POST" enctype="multipart/form-data" class="flex flex-col w-8/12 px-6 py-3 space-y-2 bg-white rounded-md filter drop-shadow-md">
            <h1 class="mb-2 text-xl font-medium">Création de Team</h1>
            <label for="name">Nom d'équipe</label>
            <input type="text" id="name" name="name" placeholder="Les FreeKills" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="abbreviation">abréviation</label>
            <input type="text" id="abbreviation" name="abbreviation" placeholder="LFK" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept=".jpeg, .jpg, .gif, .png, .svg" class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <div class="flex flex-col p-px space-y-2 lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                <button type="submit" class="flex flex-row items-center justify-center px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">Créer l'équipe</button>
            </div>
        </form>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
