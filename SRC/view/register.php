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
            <div role="passwordField" class="relative" x-data="{show : false}">
                <input x-bind:type="show ? 'text' : 'password'" id="password" name="password" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 w-full">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 rounded-md" @click="show = !show">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                </button>
            </div>
            <label for="passwordCheck">Confirmation du mot de passe</label>
            <div role="passwordField" class="relative" x-data="{show : false}">
                <input x-bind:type="show ? 'text' : 'password'" id="passwordCheck" name="passwordCheck" required class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 w-full">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 rounded-md" @click="show = !show">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                </button>
            </div>
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
