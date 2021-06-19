<?php

/**
 * Event creation form
 * @param array $lan
 * @return void
 */
function ViewCreateEvent($lan)
{
       $title = "Création d'événement";

       ob_start();
?>
       <div class="flex flex-row justify-center w-full ">
              <form x-data action="/event/create?lan=<?= $lan["name"] ?>" method="POST" enctype="multipart/form-data" class="flex flex-col w-full px-6 py-3 space-y-2 bg-white rounded-md md:w-8/12 filter drop-shadow-md">
                     <h1 class="mb-2 text-xl font-medium">Création d'événement</h1>
                     <label for="name">Nom de l'événement</label>
                     <input type="text" id="name" name="name" placeholder="1Vs1 Tic-tac-to" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" @keyup="$store.form.name = $el.value">

                     <label for="description">Description</label>
                     <textarea id="description" name="description" placeholder="Lorem ipsum dolor sit amet." class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" @keyup="$store.form.description = $el.value"></textarea>

                     <label for="type">Type d'événement</label>
                     <input type="text" id="type" name="type" placeholder="Battle royale" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">


                     <label for="start">Début</label>
                     <input type="datetime-local" id="start" name="start" placeholder="31.05.2021" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" @change="$store.form.start = $el.value" min="<?= date("Y-m-d\TH:i", strtotime($lan["start"])) ?>" max="<?= date("Y-m-d\TH:i", strtotime($lan["end"])) ?>">

                     <label for="end">Fin</label>
                     <input type="datetime-local" id="end" name="end" placeholder="6.06.2021" required class="px-4 py-2 border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" @change="$store.form.end = $el.value" min="<?= date("Y-m-d\TH:i", strtotime($lan["start"])) ?>" max="<?= date("Y-m-d\TH:i", strtotime($lan["end"])) ?>">
                     <div class="flex flex-row justify-center">
                            <div class="relative w-full" x-data="imageSelector">
                                   <div class="flex flex-col object-cover w-full h-64 px-4 py-2 overflow-hidden bg-purple-500 rounded-md cursor-pointer md:h-48 bg-hero-endless-clouds-purple400-100" :class="imageUrl ? '' : 'bg-hero-endless-clouds-purple400-100'" :style="imageUrl ? `background:url(${imageUrl}) no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;`:''" @click="$('#image').click()">
                                          <h1 class="text-2xl font-medium text-white md:text-3xl" x-text="$store.form.name ?? ''"></h1>
                                          <div x-cloak x-show="$store.form.start !== null" class="flex flex-row items-center space-x-2 text-xl text-white">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                 </svg>
                                                 <p x-text="$store.form.start ?? ''"></p>
                                          </div>
                                          <div x-cloak x-show="$store.form.diff !== null" class="flex flex-row items-center space-x-2 text-xl text-white">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                 </svg> </svg>
                                                 <p x-text="$store.form.diff ?? ''"></p>
                                          </div>

                                          <p class="text-lg text-white whitespace-pre-line md:text-xl" x-text="$store.form.description ?? ''"></p>
                                   </div>
                                   <label for="image" class="absolute bottom-0 right-0 flex flex-row px-2 py-1 space-x-2 bg-white border-2 border-gray-100 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
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
                                   <p>Créer l'événement</p>
                            </button>
                     </div>
              </form>
       </div>
       <?php
       $content = ob_get_clean();

       ob_start();
       ?>
       <script src="/public/js/eventForm.js"></script>
<?php

       $script = ob_get_clean();

       require_once "view/template.php";
       viewTemplate($title, $content, null, $script);
}
