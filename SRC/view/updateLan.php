<?php

/**
 * Lan update form
 * @param array $lan
 * @return void
 *
 */
function viewUpdateLan($lan)
{
       $title = "Mise à jour de" . $lan["name"];

       ob_start();
?>
       <div class="flex flex-row justify-center w-full ">
              <form action="/lan/update?lan=<?= $lan["name"] ?>" method="POST" enctype="multipart/form-data" class="flex flex-col w-full px-6 py-3 space-y-2 bg-white rounded-md md:w-8/12 filter drop-shadow-md">
                     <h1 class="mb-2 text-xl font-medium">Mise à jour de <?= $lan["name"] ?></h1>
                     <label for="name">Nom de LAN</label>
                     <input type="text" id="name" name="name" placeholder="1Vs1 Tic-tac-to" required value="<?= $lan["name"] ?>" class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

                     <label for="description">Description</label>
                     <input type="text" id="description" name="description" placeholder="Description courte" value="<?= $lan["description"] ?>" class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

                     <label for="places">Nombre de place</label>
                     <input type="number" id="places" name="places" placeholder="Ex : 23" required value="<?= $lan["places"] ?>" class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" min="0" max="2147483647">


                     <label for="start">Date de début</label>
                     <input type="date" id="start" name="start" placeholder="31.05.2021" required value="<?= date("Y-m-d", strtotime($lan["start"])) ?>" class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" min="<?= date("Y-m-d") ?>" max="9999-12-31">

                     <label for="end">Date de fin</label>
                     <input type="date" id="end" name="end" placeholder="6.06.2021" required value="<?= date("Y-m-d", strtotime($lan["end"])) ?>" class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" min="<?= date("Y-m-d") ?>" max="9999-12-31">

                     <div class="flex flex-row justify-center">
                            <div class="relative" x-data="imageSelector">
                                   <img src="<?= $lan["path"] ?? "/public/images/photograph.svg" ?>" :src="imageUrl ?? '<?= $lan["path"] ?? "/public/images/photograph.svg" ?>'" alt="Image de lan" class="object-cover w-48 h-48 bg-white rounded-full cursor-pointer filter drop-shadow-md" loading="lazy" @click="$('#image').click()">
                                   <label for="image" class="absolute bottom-0 left-0 flex flex-row px-2 py-1 space-x-2 bg-white border-2 border-gray-100 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                          </svg>
                                          <p>modifier</p>
                                   </label>
                                   <input type="file" id="image" name="image" class="hidden" accept=" .jpeg, .jpg, .png, .gif, .svg" @change="fileChosen">
                            </div>
                     </div>


                     <div class="flex flex-col p-px space-y-2 lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                            <button type="submit" class="flex flex-row items-center justify-center px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">
                                   <p>Appliquer</p>
                            </button>
                     </div>
              </form>
       </div>
<?php
       $content = ob_get_clean();

       require_once "view/template.php";
       viewTemplate($title, $content);
}
