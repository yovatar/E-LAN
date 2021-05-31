<?php

/**
 * Login view for account authentication
 * @return void
 *
 */
function viewCreateLAN()
{
    $title = "Création de LAN";

    ob_start();
    ?>
    <div class="w-full p-8 flex flex-row justify-center">
        <form action="/LAN/creation" method="POST"
              class="w-8/12 flex flex-col px-6 py-3 space-y-2 bg-white rounded-md filter drop-shadow-md">
            <h1 class="mb-2 text-xl font-medium">Création de LAN</h1>
            <label for="name">Nom de LAN</label>
            <input type="name" id="name" name="name" placeholder="1Vs1 Tic-tac-to" required
                   class="border-2 px-4 py-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="date">Date de la LAN</label>
            <input type="date" id="date" name="date" placeholder="31.05.2021" required
                   class="border-2 px-4 py-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="date">Image</label>
            <input type="file" id="date" name="date" placeholder="31.05.2021" required
                   class="border-2 px-4 py-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

            <div class="flex flex-col space-y-2 p-px lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
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