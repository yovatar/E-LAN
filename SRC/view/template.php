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
        <header class="flex flex-col p-4 text-xl text-white bg-purple-500">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row space-x-5">
                    <div class="flex flex-col justify-center">
                        <a href="/home" class="font-bold">E-LAN</a>
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="items-center hidden space-x-3 lg:flex">
                            <a href="/home" class="h-full hover:text-purple-900">Home</a>
                            <a href="/lans" class="h-full hover:text-purple-900">Lans</a>
                            <a href="/teams" class="h-full hover:text-purple-900">Teams</a>
                        </div>
                    </div>
                </div>
                <div class="flex-col justify-center hidden lg:flex">
                    <div class="flex flex-row space-x-3">
                        <a href="/authentication/login" class="flex px-3 py-2 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <p>Connexion</p>
                        </a>
                        <a href="/authentication/register" class="flex px-3 py-2 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            <p>Créer un compte</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:hidden">
                <div class="flex-col items-center flex border-t border-white mt-5">
                    <a href="/home" class="h-full hover:text-purple-900">Home</a>
                    <a href="/lans" class="h-full hover:text-purple-900">Lans</a>
                    <a href="/teams" class="h-full hover:text-purple-900">Teams</a>
                </div>
                <div class="flex-col items-center flex border-t border-white mt-2 pt-2 text-lg">
                    <div class="flex flex-row space-x-3">
                        <a href="/authentication/login" class="flex px-3 py-2 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <p>Connexion</p>
                        </a>
                        <a href="/authentication/register" class="flex px-3 py-2 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            <p>Créer un compte</p>
                        </a>
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
                <a href="/about" class="text-center hover:text-gray-900 hover:underline">Protection des données</a>
                <a href="/about" class="text-center hover:text-gray-900 hover:underline">Conditions d’utilisation</a>
            </div>
        </footer>
        <?= $foot ?? "" ?>
        <script type="module" src="/public/js/app.js"></script>
    </body>

    </html>
<?php
}
