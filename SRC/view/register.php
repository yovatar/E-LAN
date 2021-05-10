<?php

/**
 * Register view for account creation
 * @return void
 */
function viewRegister()
{
    $title = "Elan - Register";

    ob_start();
?>
    <div class="flex flex-row justify-center w-full">
        <form action="/authentication/register" method="POST" class="flex flex-col px-6 py-3 space-y-2 bg-white rounded-md filter drop-shadow-md">
            <h1 class="mb-2 text-xl font-medium">Inscription</h1>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" placeholder="bobby" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="bob.ross@cpnv.ch" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName" placeholder="Ross" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName" placeholder="Bob" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="passwordCheck">Confirmation du mot de passe</label>
            <input type="password" id="passwordCheck" name="passwordCheck" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <div class="flex flex-col space-y-2 lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                <button type="submit" class="flex flex-row items-center justify-center px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                    <p>Créer le compte</p>
                </button>
                <p>vous avez deja un compte? <a href="/authentication/login" class="text-purple-500 hover:text-purple-700">connectez vous</a></p>
            </div>
        </form>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
