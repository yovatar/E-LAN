<?php

/**
 * homepage view
 * @return void
 */
function viewHome()
{
    $title = "home";

    ob_start();
    ?>
    <br>
    <div>
        <h1 class=" text-5xl text-center font-mono font-bold text-gray-100 bg-gradient-to-r from-pink-400 to-purple-500 ">
            E-LAN Acceuil</h1>

    </div><br>
    <div class="bg-gradient-to-r h-96 from-purple-500 to-pink-300  flex flex-col justify-center items-center">
        <div class="text-center text-gray-100 text-bold text-3xl">  Evénements du mois   </div> <br>
        <div
                class="max-w-2xl mx-auto relative"
                x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }"
        >
            <!-- Slides -->
            <template x-for="slide in slides" :key="slide">
                <div
                        x-show="activeSlide === slide"
                        class="p-24 font-bold text-5xl w-[3.23rem] flex items-center bg-pink-100 text-purple-900 rounded-lg">
                    <span class="w-12 text-center" x-text="slide"></span>
                    <span class="text-teal-300">/</span>
                    <span class="w-12 text-center" x-text="slides.length"></span>
                </div>
            </template>

            <!-- Prev/Next Arrows -->
            <div class="absolute inset-0 flex">
                <div class="flex items-center justify-start w-1/2">
                    <button
                            class="bg-pink-200 text-purple-250 hover:text-black-500 font-black hover:shadow-lg rounded-full w-30 h-16 -ml-6"
                            @click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                        &#8592;
                    </button>
                </div>
                <div class="flex items-center justify-end w-1/2">
                    <button
                            class="bg-pink-200 text-purple-250 hover:text-black-500 font-black hover:shadow-lg rounded-full w-30 h-16 -mr-6"
                            @click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                        &#8594;
                    </button>
                </div>
            </div>

            <!-- Buttons -->
            <div class="absolute w-full flex items-center justify-center px-4">
                <template x-for="slide in slides" :key="slide">
                    <button
                            class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-teal-600 hover:shadow-lg"
                            :class="{
              'bg-orange-600': activeSlide === slide,
              'bg-teal-300': activeSlide !== slide
          }"
                            @click="activeSlide = slide"
                    ></button>
                </template>
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
