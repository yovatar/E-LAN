<?php

/**
 * template view with navbar and footer
 * @param string $title title of the page
 * @param string $content placed in main
 * @param string $head placed in header tag
 * @param string $foot placed at the end of the body
 * @return void
 */
function viewTemplate($title, $content, $head = null, $foot = null)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?? "no title" ?></title>
        <link rel="stylesheet" href="/public/css/style.css">
        <link rel="shortcut icon" href="/public/images/elan-icon-circle.png" type="image/x-icon">
        <?= $head ?? "" ?>
    </head>

    <body class="flex flex-col justify-between min-h-screen bg-white">
        <header role="navigation" x-data="dropdown" class="flex flex-col p-4 text-xl text-white bg-purple-500">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row space-x-5">
                    <a href="/" class="flex flex-row items-center justify-center px-2 space-x-2 transition-shadow border-2 border-transparent border-dashed focus:border-white focus:outline-none focus:text-purple-900">
                        <img class="object-contain h-12" alt="E-LAN logo" src="/public/images/Logo_E-LAN-removebg.png">
                        <p class="ml-1 mr-1 font-black">E-LAN</p>
                    </a>
                    <div class="flex flex-col justify-center">
                        <div class="items-center hidden space-x-3 lg:flex">
                            <a href="/home" class="h-full ml-10 font-bold hover:text-purple-900 focus:text-purple-900 focus:underline focus:outline-none hover:underline">Home</a>
                            <a href="/lans" class="h-full font-bold hover:text-purple-900 focus:text-purple-900 focus:underline focus:outline-none hover:underline">Lans</a>
                            <a href="/teams" class="h-full font-bold hover:text-purple-900 focus:text-purple-900 focus:underline focus:outline-none hover:underline">Teams</a>
                        </div>
                    </div>
                </div>
                <div class="flex-col items-center justify-center hidden lg:flex">
                    <div class="flex flex-row items-center space-x-3">
                        <?php if (empty($_SESSION["user"])) { ?>
                            <a href="/authentication/login" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <p>Connexion</p>
                            </a>
                            <a href="/authentication/register" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                <p>Créer un compte</p>
                            </a>
                        <?php } else { ?>

                            <div role="dropdown profil" x-data="dropdown" class="relative">
                                <div class="flex flex-row items-center space-x-2 cursor-pointer" @click="open = true">
                                    <p class="font-medium"><?= $_SESSION["user"]["username"] ?></p>
                                    <img src="<?= $_SESSION["user"]["image"]["path"] ?? "/public/images/userDefault.jpg" ?>" alt="icône utilisateur" class="object-cover w-10 h-10 bg-white rounded-full">
                                </div>
                                <ul x-cloak x-show="open" @click.away="open = false" class="absolute px-4 py-2 text-base text-black bg-white border border-gray-200 rounded-md">
                                    <li><a class="px-1 rounded-md hover:underline focus:outline-none focus:ring-2 focus:ring-purple-500" href="/settings/account">Compte</a></li>
                                </ul>

                            </div>
                            <form action="/authentication/logout" method="POST">
                                <input type="hidden" name="confirm" value="true">
                                <button type="submit" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                    </svg>
                                    <p>Déconnexion</p>
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
                <button @click="toggle()" :class="{'brightness-90':open}" class="px-3 py-2 lg:hidden filter focus:text-blueGray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div x-cloak class="relative flex flex-col p-1 overflow-hidden transition-all duration-300 lg:hidden" x-ref="collapsible" x-bind:style="open ? `max-height:${$refs.collapsible.scrollHeight}px` : 'max-height:0'" x-bind:class="{ 'invisible': !open }">
                <div class="flex flex-col items-center mt-5 border-t border-white">
                    <a href="/home" class="h-full hover:text-purple-900 focus:text-purple-900 focus:underline focus:outline-none hover:underline">Home</a>
                    <a href="/lans" class="h-full hover:text-purple-900 focus:text-purple-900 focus:underline focus:outline-none hover:underline">Lans</a>
                    <a href="/teams" class="h-full hover:text-purple-900 focus:text-purple-900 focus:underline focus:outline-none hover:underline">Teams</a>
                </div>
                <div class="flex flex-col items-center pt-2 mt-2 text-lg border-t border-white">
                    <?php if (empty($_SESSION["user"])) { ?>
                        <div class="flex flex-row items-center space-x-3">

                            <a href="/authentication/login" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <p>Connexion</p>
                            </a>
                            <a href="/authentication/register" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                <p>Créer un compte</p>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="flex flex-col mb-3 space-y-2">
                            <a class="px-1 rounded-md hover:underline focus:outline-none focus:ring-2 focus:ring-purple-500" href="/settings/account">Compte</a>
                        </div>

                        <div class="flex flex-col items-center w-full space-y-3 font-medium">

                            <a href="/settings/account" class="flex flex-row items-center space-x-2">
                                <p class="font-medium"><?= $_SESSION["user"]["username"] ?></p>
                                <img src="<?= $_SESSION["user"]["image"]["path"] ?? "/public/images/userDefault.jpg" ?>" alt="icône utilisateur" class="object-cover w-10 h-10 bg-white rounded-full">
                            </a>

                            <form action="/authentication/logout" method="POST" class="flex flex-row items-center justify-center w-full">
                                <input type="hidden" name="confirm" value="true">
                                <button type="submit" class="flex items-center justify-center w-full px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                    </svg>
                                    <p>Déconnexion</p>
                                </button>
                            </form>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </header>
        <main class="flex flex-col justify-center flex-grow w-full mx-auto justify-self-start lg:max-w-7xl">
            <?= $content ?? "no content" ?>
        </main>
        <footer class="flex flex-col justify-center p-2">
            <div class="flex flex-col justify-center pt-2 font-medium text-gray-700 border-t-2 border-purple-500 lg:flex-row lg:space-x-3">
                <a href="/about" class="text-center hover:text-gray-900 hover:underline focus:underline focus:outline-none focus:text-gray-900">E-LAN</a>
                <a href="/protection" class="text-center hover:text-gray-900 hover:underline focus:underline focus:outline-none focus:text-gray-900">Protection des données</a>
                <a href="/condition" class="text-center hover:text-gray-900 hover:underline focus:underline focus:outline-none focus:text-gray-900">Conditions d’utilisation</a>
            </div>
        </footer>
        <div role="toast area" x-data class="fixed flex flex-col items-end space-y-2 right-2 bottom-4">
            <template x-for="(toast,index) in $store.toasts.toasts" :key="index">
                <div class="flex flex-row items-center px-3 py-2 space-x-2 rounded-md" :class="toast.class ?? 'bg-blue-500 text-white'">
                    <p x-text="`${toast.message}`" class="whitespace-pre-wrap"></p>
                    <button type="button" @click="$store.toasts.toasts.splice(index,1)" class="focus:outline-none filter focus:brightness-75 hover:brightness-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </template>
        </div>
        <?php if (!empty($GLOBALS["flash"]["toasts"])) {
            $toasts = $GLOBALS["flash"]["toasts"];
        ?>
            <script>
                document.addEventListener("alpine:initialized", () => {
                    <?php foreach ($toasts["errors"] as $error) { ?>
                        Alpine.store('toasts').error("<?= $error ?>")
                    <?php } ?>
                    <?php foreach ($toasts["successes"] as $success) { ?>
                        Alpine.store('toasts').success("<?= $success ?>")
                    <?php } ?>
                    <?php foreach ($toasts["infos"] as $info) { ?>
                        Alpine.store('toasts').info("<?= $info ?>")
                    <?php } ?>
                    <?php foreach ($toasts["warnings"] as $warning) { ?>
                        Alpine.store('toasts').warning("<?= $warning ?>")
                    <?php } ?>
                })
            </script>
        <?php } ?>
        <?= $foot ?? "" ?>
        <script src="/public/js/components.js"></script>
        <script type="module" src="/public/js/compiled/app.js"></script>
        <script src="/node_modules/alpinejs/dist/cdn.min.js"></script>
    </body>

    </html>
<?php
}
