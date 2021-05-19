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
        <h1 class="font-mono text-5xl font-bold text-center text-gray-100 bg-gradient-to-r from-pink-400 to-purple-500">
            E-LAN Acceuil</h1>

    </div><br>
    <div class="flex flex-col items-center justify-center bg-gradient-to-r h-96 from-purple-500 to-pink-300">
        <div class="text-3xl text-center text-gray-100 text-bold"> Meilleurs evénements de l'année</div>
        <br>
        <div class="relative flex-initial w-full px-12 mx-auto" x-data="{
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
                }">
            <div>

                <!-- Slides -->
                <template x-for="slide in slides" :key="slide">
                    <div x-show="activeSlide === slide.id" class="flex flex-col justify-center w-full h-64 px-24 overflow-hidden rounded-lg">
                        <div class="flex flex-row items-start">
                            <img class="object-cover w-64 text-center rounded-lg ring-2 ring-white" x-bind:src="`/${slide.src}`" />
                            <div class="h-full px-6 py-3 text-xl font-medium text-white" x-text="slide?.text">
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Prev/Next Arrows -->
                <div class="absolute inset-0 flex w-full">
                    <div class="flex items-center justify-start w-1/2">
                        <button class="flex items-center justify-center h-16 -ml-6 font-black transition-colors duration-75 bg-pink-200 rounded-full stroke-2 hover:animate-wiggle focus:animate-wiggle active:text-white focus:stroke-4 text-purple-250 hover:text-black-500 hover:shadow-lg w-30 focus:outline-none focus:ring-4 focus:ring-white" @click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-end w-1/2">
                        <button class="flex items-center justify-center h-16 -ml-6 font-black transition-colors duration-75 bg-pink-200 rounded-full stroke-2 hover:animate-wiggle-reverse focus:animate-wiggle-reverse active:text-white focus:stroke-4 text-purple-250 hover:text-black-500 hover:shadow-lg w-30 focus:outline-none focus:ring-4 focus:ring-white" @click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
            <!-- Buttons -->
            <div class="relative flex items-center justify-center w-full px-4">
                <template x-for="slide in slides">
                    <button type="button" class="w-full focus:outline-none focus:ring-2 focus:ring-white h-2 mx-2 mt-4 mb-0 overflow-hidden transition-colors duration-200 ease-out rounded-full hover:bg-teal-600 hover:shadow-lg" :class="{
              'bg-white focus:bg-gray-200': activeSlide === slide.id,
              'bg-purple-300': activeSlide !== slide.id
          }" @click="activeSlide = slide.id"></button>
                </template>
            </div>
        </div>

    </div>
    </div>

    <!-- ----------------------NEWS1----------------------- -->
    <br><br><br><br>
    <div>
        <h1 class="mx-auto text-5xl text-center font-mono font-bold text-gray-100 bg-gradient-to-r from-purple-300 to-purple-600">
            LANs Suisses</h1>
    </div>
<div class="bg-gradient-to-r from-purple-300 to-purple-600">
    <div class="flex w-full h-96 ">
        <div class="flex-grow-0 bg-black rounded-3xl m-8 w-144">
            <img src="public/images/PolyLAN.png" class="pt-16 px-8 " alt="Swiss LAN img">
        </div>
        <div class="w-full bg-white rounded-3xl m-8">
            <h2 class="font-normal subpixel-antialiased px-8 font-serif pt-8 ">
                Depuis 2002,
                <a href="https://polylan.ch/" class="font-bold italic text-indigo-700 ">PolyLAN</a> organise des LAN
                (ou LAN party) deux fois par an. Ces rassemblements, qui se sont déroulé à l'EPFL, successivement dans le hall du bâtiment
                SG, au Rolex Learning Center, à l'Amphimax à l'UNIL et plus récemment au SwissTech Convention Center,
                voient s'affronter jusqu'à 1250 personnes au travers d'un réseau local. Le comité, formé principalement
                d'étudiantes et étudiants de la faculté IC, est composé d'une vingtaine
                de membres, qui mettent en pratique les connaissances acquises dans le cadre de leurs études, et plus
                encore. Bénéficiant de l'infrastructure électrique, informatique et logistique de l'EPFL, l'association
                propose une manifestation de grande qualité pour un prix abordable. Contrairement aux autres événements
                de ce type, où l'esprit de compétition prime avant tout, la convivialité ainsi que le côté ludique des
                jeux vidéo sont privilégiés.
            </h2>
        </div>
    </div>
    <!-- ----------------------NEWS2----------------------- -->
    <div class="flex w-full h-96 ">
        <div class="bg-gradient-to-r from-purple-300 to-pink-300"><br></div>

        <div class="flex-grow-0 w-full bg-white rounded-3xl m-8">

            <h2 class="font-normal subpixel-antialiased px-8 font-serif pt-8 ">Le <a
                        href="https://www.numerik-games.ch/" class="font-bold italic text-indigo-700">Numerik Games
                    Festival</a>
                est une manifestation tout public dédiée à l’art et la culture numériques.
                Depuis 2016, cet événement convainc des foules de plus en plus nombreuses: enfants, familles,
                adolescents, adultes – tous trouvent leur compte dans ce festival interdisciplinaire faisant la part
                belle à une créativité qui, c’est le point commun de toutes les activités proposées, implique les
                ressources permises par le digital.
            </h2>
        </div>

        <div class="flex-grow-0 bg-white rounded-3xl m-8 w-144">
            <img src="public/images/NumerikGames.PNG" class="pt-16 px-8 " alt="Swiss LAN img">
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
