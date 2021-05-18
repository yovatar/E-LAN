<?php

/**
 * homepage view
 * @return void
 */
function viewHome()
{
    $title = "Accueil";

    ob_start();
    ?>
    <br>
    <div>
        <h1 class=" text-5xl text-center font-mono font-bold text-gray-100 bg-gradient-to-r from-pink-400 to-purple-500 ">
            E-LAN Acceuil</h1>

    </div><br>
    <div class="bg-gradient-to-r h-96 from-purple-500 to-pink-300  flex flex-col justify-center items-center">
        <div class="text-center text-gray-100 text-bold text-3xl"> Meilleurs evénements de l'année</div>
        <br>
        <div
                class="w-full px-12 mx-auto relative w-full flex-initial"
                x-data="{
                activeSlide: 1,
                 slides: [
                 {id:1,src:'public/images/PolyLAN.png',text:`La polylan est la plus grosse lan de suisse, elle a lieu à l'EPFL a Lausanne. Elle comporte plusieurs evenements et acticitées`},
                 {id:2,src:'public/images/NumerikGames.PNG',text:`Le NumerikGames est une convention de jeux suisse ce deroulant a yverdon avec le soutien de la maison d'ailleurs`},
                 {id:3,src:'public/images/E3.png',text:`L'E3 est un salon consacré exclusivement aux jeux vidéo organisé par l'Entertainment Software Association. L'évènement se déroulera du 12 au 15 juin 2021.`},
                 {id:4,src:'public/images/gamescom.png',text:`La Gamescom est un salon international consacré au jeu vidéo. Elle est à ce jour le plus gros évènement consacré au jeux vidéos  `},
                 {id:5,src:'public/images/Japan_impact.png',text:`Japan Impact est une convention dédiée à la culture japonaise qui se déroule tous les ans sur un week-end en février à l'École polytechnique fédérale de Lausanne.On y trouve également plusieurs événement consacré aux jeux japonais`},
                 {id:6,src:'public/images/herofestival.png',text:`Le HeroFestival est un événement culturel qui a vu le jour à Marseille en 2014. Ce festival transgénérationnel se déroule autour du thème des héros de tout univers : BD, cinéma, séries, manga, comics, jeux vidéo, cosplay`},
                 {id:7,src:'public/images/GameAwards.png',text:`The Game Awards est une soirée de récompenses annuelle, qui distingue une sélection de jeux vidéo sortis tout au long de l'année, aussi bien que des jeux vidéo sortis récemment, ou même certains annoncés officiellement avant la soirée de remise de prix. Cette soirée est produite et présentée par le journaliste canadien Geoff Keighley. les Game Awards présentent également de nouveaux jeux et du gameplay de jeux récemment annoncés.`},
                 {id:8,src:'public/images/Blizzconline.png',text:`La BlizzCon est une convention organisée chaque année depuis 2005 par Blizzard Entertainment au Anaheim Convention Center de Anaheim en Californie, pour présenter les nouveautés de leurs licences, mettre à disposition des versions de démonstration jouables, rencontrer les joueurs et proposer divers autres activités et panels liés aux univers de Warcraft, StarCraft, Diablo, Hearthstone, Heroes of the Storm et Overwatch.`},
                 {id:9,src:'public/images/SummerGameFest.png',text:`Le Summer Game Fest est l’équivalent de l’E3 mais diffusée en direct en ligne sur plusieurs plateformes de streaming telles que Twitch ou YouTube. Ils compte également avec la présence de  Geoff Keighley.`}
                 ]
                }"
        >
            <div>

                <!-- Slides -->
                <template x-for="slide in slides" :key="slide">
                    <div
                            x-show="activeSlide === slide.id"
                            class="w-full flex flex-col rounded-lg justify-center h-64 px-24 overflow-hidden">
                        <div class="flex flex-row  items-start">
                            <img class="object-contain w-64 text-center" x-bind:src="`/${slide.src}`"/>
                            <div class="px-6 py-3 text-white font-medium text-xl h-full" x-text="slide?.text">
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Prev/Next Arrows -->
                <div class="absolute w-full inset-0 flex">
                    <div class="flex items-center justify-start w-1/2">
                        <button
                                class="bg-pink-200 text-purple-250 hover:text-black-500 font-black hover:shadow-lg rounded-full w-30 h-16 -ml-6 flex justify-center items-center"
                                @click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-end w-1/2">
                        <button
                                class="bg-pink-200 text-purple-250 hover:text-black-500 font-black hover:shadow-lg rounded-full w-30 h-16 -mr-6  flex justify-center items-center"
                                @click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
            <!-- Buttons -->
            <div class="relative w-full flex items-center justify-center px-4">
                <template x-for="slide in slides">
                    <button type="button"
                            class="w-full h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-teal-600 hover:shadow-lg"
                            :class="{
              'bg-white': activeSlide === slide.id,
              'bg-purple-300': activeSlide !== slide.id
          }"
                            @click="activeSlide = slide.id"
                    ></button>
                </template>
            </div>
        </div>

    </div>
</div>
    
<?php
    $content = ob_get_clean();

    //Meta tag for nav
    ob_start();
    ?>
    <?php
    $head = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content, $head);
}