<?php

/**
 * Team creation form
 * @return void
 */
function viewCreateTeams()
{
    $title = "Création d'équipe";

    ob_start();
?>
    <div class="flex flex-row justify-center w-full p-8">
        <form action="/createTeam" method="POST" enctype="multipart/form-data" class="flex flex-col w-8/12 px-6 py-3 space-y-2 bg-white rounded-md filter drop-shadow-md">
            <h1 class="mb-2 text-xl font-medium">Création de Team</h1>
            <div class="flex flex-row md:space-x-5 md:space-y-0">
                <div class="flex flex-col justify-between flex-grow">
                    <div class="flex flex-col">
                        <label for="name">Nom d'équipe</label>
                        <input type="text" id="name" name="name" placeholder="Les FreeKills" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <label for="abbreviation">abréviation</label>
                        <input type="text" id="abbreviation" name="abbreviation" placeholder="LFK" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div class="flex flex-col w-full space-y-2 place-self-end lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                        <button type="submit" class="flex flex-row items-center justify-center flex-grow px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">Créer l'équipe</button>
                    </div>

                </div>
                <div class="flex flex-col">
                    <div class="relative" x-data="imageViewer()">
                        <img src="<?= $user["image"]["path"] ?? "/public/images/userDefault.jpg" ?>" :src="imageUrl ?? '/public/images/photograph.svg'" alt="Image de profile" class="object-cover w-48 h-48 bg-white rounded-full filter drop-shadow-md" loading="lazy">
                        <label for="image" tabindex="0" class="absolute bottom-0 left-0 flex flex-row px-2 py-1 space-x-2 bg-white border-2 border-gray-100 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <p>modifier</p>
                        </label>
                        <input type="file" name="image" id="image" class="hidden" accept=" .jpeg, .jpg,
                        .png, .gif, .svg" @change="fileChosen">
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
