<?php

/**
 * Setting view for account modification
 * @param array $user
 * @return void
 */
function viewSettingsAccount($user)
{
    $title = "Compte";

    ob_start();
?>
    <div class="flex flex-row justify-center w-full">
        <div class="flex flex-col w-full max-w-2xl bg-white divide-y-2 rounded-md filter drop-shadow-md divide-blueGray-100">
            <h1 class="px-6 py-3 text-xl font-medium">Compte</h1>
            <div class="flex flex-col-reverse justify-between px-6 py-3 space-y-2 lg:flex-row lg:space-y-0 lg:space-x-6">
                <div class="flex flex-col flex-grow space-y-3">
                    <h2 class="text-lg font-normal">Information</h2>
                    <hr>
                    <div class="flex flex-col space-y-2">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" disabled class="bg-gray-100 border-2 border-none rounded-md" name="username" id="username" value="<?= $user["username"] ?? "nom d'utilisateur inconnu" ?>" ">
                        <label for=" email">Email</label>
                        <input type="email" disabled class="bg-gray-100 border-2 border-none rounded-md" name="email" id="email" value="<?= $user["email"] ?? "email inconnu" ?>">
                    </div>
                    <h2 class="text-lg font-normal">Modification du mot de passe</h2>
                    <hr>
                    <form action="/settings/account" method="POST" class="flex flex-col space-y-2">
                        <label for="oldPassword">Ancient mot de passe</label>
                        <div role="old password field" class="relative" x-data="{show : false}">
                            <input x-bind:type="show ? 'text' : 'password'" name=" oldPassword" id="oldPassword" class="w-full border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
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
                        <label for="newPassword">Nouveau mot de passe</label>
                        <div role="new password field" class="relative" x-data="{show : false}">
                            <input x-bind:type="show ? 'text' : 'password'" name=" newPassword" id="newPassword" class="w-full border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
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
                        <label for="newPasswordConfirm">confirmer le nouveau mot de passe</label>
                        <div role="new password confirm field" class="relative" x-data="{show : false}">
                            <input x-bind:type="show ? 'text' : 'password'" name=" newPasswordConfirm" id="newPasswordConfirm" class="w-full border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
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
                        <input type="hidden" name="action" value="updatePassword">

                        <button type="submit" class="px-6 py-3 font-medium text-white bg-purple-500 rounded-md hover:bg-purple-700 focus:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">
                            <p>Mettre à jour</p>
                        </button>
                    </form>
                </div>
                <form action="/settings/account" method="POST" enctype="multipart/form-data" class="flex flex-col items-center space-y-4 lg:items-start" x-data="imageViewer()">
                    <div class="relative">
                        <img src="<?= $user["image"]["path"] ?? "/public/images/userDefault.jpg" ?>" :src="imageUrl ?? '<?= $user["image"]["path"] ?? "/public/images/userDefault.jpg" ?>'" alt="Image de profile" class="object-cover w-64 h-64 rounded-full" loading="lazy">
                        <label for="profilePicture" tabindex="0" class="absolute bottom-0 left-0 flex flex-row px-2 py-1 space-x-2 bg-white border-2 border-gray-100 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <p>modifier</p>
                        </label>
                        <input type="file" name="profilePicture" id="profilePicture" class="hidden" accept=" .jpeg, .jpg,
                        .png, .gif, .svg" required @change="fileChosen">
                    </div>
                    <input type="hidden" name="action" value="updatePicture">
                    <button type="submit" class="w-full px-6 py-3 font-medium text-white bg-purple-500 rounded-md hover:bg-purple-700 focus:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">Appliquer</button>
                </form>
            </div>
        </div>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content, null);
}
