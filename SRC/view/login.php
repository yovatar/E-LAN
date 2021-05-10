<?php

/**
 * Login view for account authentication
 * @return void
 */
function viewLogin()
{
    $title = "Elan - Login";

    ob_start();
?>
    <div class="flex flex-row justify-center w-full">
        <form action="/authentication/login" method="POST" class="flex flex-col px-6 py-3 space-y-2 bg-white rounded-md filter drop-shadow-md">
            <h1 class="mb-2 text-xl font-medium">Connexion</h1>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="bob.ross@cpnv.ch" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <div class="flex flex-col space-y-2 lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                <button type="submit" class="flex flex-row items-center justify-center px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <p>Se connecter</p>
                </button>
                <p>vous avez n’avez pas de compte? <a href="/authentication/register" class="text-purple-500 hover:text-purple-700">créer un compte</a></p>
            </div>
        </form>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
