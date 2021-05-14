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
        <?= $head ?? "" ?>
    </head>

    <body class="flex flex-col justify-between min-h-screen bg-white">
        <header role="navigation" x-data="{ open: false }" class="flex flex-col p-4 text-xl text-white bg-purple-500">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row space-x-5">
                    <div class="flex flex-col justify-center">
                        <a href="/home" class="font-bold">E-LAN</a>
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="items-center hidden space-x-3 lg:flex">
                            <a href="/home" class="h-full hover:text-purple-900 focus:text-purple-900">Home</a>
                            <a href="/lans" class="h-full hover:text-purple-900 focus:text-purple-900">Lans</a>
                            <a href="/teams" class="h-full hover:text-purple-900 focus:text-purple-900">Teams</a>
                        </div>
                    </div>
                </div>
                <div class="flex-col items-center justify-center hidden lg:flex">
                    <?php if (empty($_SESSION["user"])) { ?>
                        <div class="flex flex-row space-x-3">
                            <a href="/authentication/login" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <p>Connexion</p>
                            </a>
                            <a href="/authentication/register" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                <p>Créer un compte</p>
                            </a>
                        </div>
                    <?php } else { ?>
                        <form action="/authentication/logout" method="POST">
                            <input type="hidden" name="confirm" value="true">
                            <button type="submit" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                <p>Déconnexion</p>
                            </button>
                        </form>
                    <?php } ?>
                </div>
                <button @click="open = !open" :class="{'brightness-90':open}" class="px-3 py-2 lg:hidden filter focus:text-blueGray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div class="relative flex flex-col overflow-hidden transition-all duration-300 lg:hidden" x-ref="collapsible" x-bind:style="open ? `max-height:${$refs.collapsible.scrollHeight}px` : 'max-height:0'" x-bind:class="{ 'invisible': !open }">
                <div class="flex flex-col items-center mt-5 border-t border-white">
                    <a href="/home" class="h-full hover:text-purple-900 focus:text-purple-900">Home</a>
                    <a href="/lans" class="h-full hover:text-purple-900 focus:text-purple-900">Lans</a>
                    <a href="/teams" class="h-full hover:text-purple-900 focus:text-purple-900">Teams</a>
                </div>
                <div class="flex flex-col items-center pt-2 mt-2 text-lg border-t border-white">
                    <div class="flex flex-row space-x-3">
                        <?php if (empty($_SESSION["user"])) { ?>

                            <a href="/authentication/login" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <p>Connexion</p>
                            </a>
                            <a href="/authentication/register" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                <p>Créer un compte</p>
                            </a>
                        <?php } else { ?>
                            <form action="/authentication/logout" method="POST">
                                <input type="hidden" name="confirm" value="true">
                                <button type="submit" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                    </svg>
                                    <p>Déconnexion</p>
                                </button>
                            </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </header>
        <main class="flex flex-col justify-center flex-grow w-full mx-auto justify-self-start lg:max-w-7xl">
            <?= $content ?? "no content" ?>
        </main>
        <footer class="flex flex-col justify-center p-2">
            <div class="flex flex-col justify-center pt-2 font-medium text-gray-700 border-t-2 border-purple-500 lg:flex-row lg:space-x-3">
                <a href="/about" class="text-center hover:text-gray-900 hover:underline">E-LAN</a>
                <a href="/protection" class="text-center hover:text-gray-900 hover:underline">Protection des données</a>
                <a href="/condition" class="text-center hover:text-gray-900 hover:underline">Conditions d’utilisation</a>
            </div>
        </footer>
        <div role="toast area" x-data="{toasts : []}" @toast.window="toasts.push($event.detail)" class="fixed flex flex-col items-end space-y-2 right-2 bottom-4" x-init="$nextTick(() => {
                const urlParams = new URLSearchParams(window.location.search)
                if(urlParams.has('error')){
                    $dispatch('toast', { text: urlParams.get('error'), class : 'bg-red-500 text-white' })
                }
            })
        ">
            <template x-for="(toast,index) in toasts" :key="index">
                <div class="flex flex-row items-center px-3 py-2 space-x-2 rounded-md" :class="toast.class ?? 'bg-blue-500 text-white'">
                    <p x-text="`${toast.text}`" class="whitespace-pre-wrap"></p>
                    <button type="button" @click="toasts.splice(index,1)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </template>
        </div>
        <?= $foot ?? "" ?>
        <script type="module" src="/public/js/app.js"></script>
    </body>

    </html>
<?php
}
