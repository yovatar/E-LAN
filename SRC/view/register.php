<?php

/**
 * Register view for account creation
 * @return void
 */
function viewRegister()
{
    $title = "Inscription";

    ob_start();
?>
    <div class="flex flex-row justify-center w-full">
        <form role="register form" x-data :class="{'md:ring-2 md:ring-red-500 box-border border-4 border-red-500 md:border-none':$store.register.valid === false}" action="/authentication/register" method="POST" class="flex flex-col w-full px-6 py-3 space-y-2 bg-white md:rounded-md filter drop-shadow-md md:w-auto">
            <div x-show="$store.register.valid === false" x-cloak class="flex flex-row items-center justify-between px-4 py-2 text-white bg-red-500 rounded-md">
                <p class="text-lg font-medium md:text-2xl">Vérifiez que vos données soient valides</p>
                <button type="button" class="flex flex-col justify-center focus:outline-none hover:text-red-900 focus:text-red-900" @click="$store.register.valid = null">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <h1 class="mb-2 text-xl font-medium">Inscription</h1>
            <label for="username">Nom d'utilisateur</label>
            <div role="username field" class="flex flex-col" x-data="{available : null}">
                <div class="relative w-full">
                    <input x-on:change="$store.register.checkUsername($event.target.value)" x-bind:class="{ 'border-blueGray-200' : $store.register.usernameValid === null, 'border-green-500': $store.register.usernameValid === true, 'border-red-500' : $store.register.usernameValid === false}" type="text" id="username" name="username" placeholder="bobby" required class="w-full border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 h-11">
                    <div x-show="$store.register.usernameValid === false" x-cloak class="absolute inset-y-0 right-0 flex items-center px-4 py-2 text-red-500 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div x-show="$store.register.usernameValid === true" x-cloak class="absolute inset-y-0 right-0 flex items-center px-4 py-2 text-green-500 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <p x-cloak x-show="$store.register.usernameValid === false" class="text-red-500">Nom d'utilisateur déjà utilisé</p>
            </div>
            <label for="email">Email</label>
            <div role="email field" class="flex flex-col" x-data>
                <div class="relative w-full">
                    <input x-on:change="$store.register.checkEmail($event.target.value)" x-bind:class="{ 'border-blueGray-200' : $store.register.emailValid === null, 'border-green-500': $store.register.emailValid === true, 'border-red-500' : $store.register.emailValid === false}" type="email" id="email" name="email" placeholder="bob.ross@cpnv.ch" required class="w-full border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 h-11 focus:ring-purple-500">
                    <div x-show="$store.register.emailValid === false" x-cloak class="absolute inset-y-0 right-0 flex items-center px-4 py-2 text-red-500 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div x-show="$store.register.emailValid === true" x-cloak class="absolute inset-y-0 right-0 flex items-center px-4 py-2 text-green-500 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <p x-cloak x-show="$store.register.emailValid === false" class="text-red-500">Email déjà Utilisé</p>
            </div>
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName" placeholder="Ross" required class="border-2 rounded-md h-11 border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName" placeholder="Bob" required class="border-2 rounded-md h-11 border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <label for="password">Mot de passe</label>
            <div role="passwordField" class="relative" x-data="{show : false}">
                <input :class="{'border-blueGray-200':$store.register.passwordValid === null,'border-red-500':$store.register.passwordValid === false, 'border-green-500': $store.register.passwordValid === true}" x-bind:type="show ? 'text' : 'password'" id="password" name="password" required @change="$store.register._password = $event.target.value" class="w-full border-2 rounded-md border-blueGray-200 h-11 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button type="button" tabindex="-1" class="absolute inset-y-0 right-0 flex items-center px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" @click="show = !show">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                </button>
            </div>
            <label for="passwordCheck">Confirmation du mot de passe</label>
            <div role="passwordField" class="relative" x-data="{show : false}">
                <input :class="{'border-blueGray-200':$store.register.passwordValid === null,'border-red-500':$store.register.passwordValid === false, 'border-green-500': $store.register.passwordValid === true}" x-bind:type="show ? 'text' : 'password'" id="passwordCheck" name="passwordCheck" required @change="$store.register._confirm = $event.target.value" class="w-full border-2 rounded-md h-11 border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button type="button" tabindex="-1" class="absolute inset-y-0 right-0 flex items-center px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" @click="show = !show">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                </button>
            </div>
            <p x-cloak x-show="$store.register.passwordValid === false" class="text-red-500">Les mots de passes ne correspondent pas</p>
            <div role="submit" x-data class="flex flex-col space-y-2 lg:flex-row lg:items-center lg:space-x-3 lg:space-y-0">
                <button type="submit" class="flex flex-row items-center justify-center px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700" @click="if(!$store.register.valid){$event.preventDefault(); $store.register.valid = false}">
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

    ob_start();
    ?>
    <script src="/public/js/register.js" defer></script>
<?php
    $scripts = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content, null, $scripts);
}
