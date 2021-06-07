<?php

/**
 * Lan creation form
 * @return void
 *
 */
function viewCreateLAN()
{
    $title = "Création de LAN";

    ob_start();
    ?>
    <div class="flex flex-row justify-center w-full p-8">
        <form action="/LAN/creation" method="POST"
              class="flex flex-col w-8/12 px-6 py-3 space-y-2 bg-white rounded-md filter drop-shadow-md">
            <h1 class="mb-2 text-xl font-medium">Création de LAN</h1>
            <label for="name">Nom de LAN</label>
            <input type="name" id="name" name="name" placeholder="1Vs1 Tic-tac-to" required
                   class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

            <label for="name">Description</label>
            <input type="text" id="text" name="text" placeholder="Description courte" required
                   class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

            <label for="name">Nombre de place</label>
            <input type="number" id="number" name="number" placeholder="Ex : 23" required
                   class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">


            <label for="date">Date de début</label>
            <input type="date" id="date1" name="date1" placeholder="31.05.2021" required
                   class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

            <label for="date">Date de fin</label>
            <input type="date" id="date2" name="date2" placeholder="6.06.2021" required
                   class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

            <label for="image">Image</label>
            <input type="file" id="image" name="image" required
                   class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">


            <div class="flex flex-col p-px space-y-2 lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                <button type="submit"
                        class="flex flex-row items-center justify-center px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">
                    <p>Créer la LAN</p>
                </button>
            </div>
        </form>
    </div>
    <?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}