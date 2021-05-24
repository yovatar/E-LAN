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
    <div
        class="flex flex-col w-full max-w-2xl bg-white divide-y-2 rounded-md filter drop-shadow-md divide-blueGray-100">
        <h1 class="px-6 py-3 text-xl font-medium">Compte</h1>
        <div class="flex flex-col-reverse justify-between px-6 py-3 space-y-2 lg:flex-row lg:space-y-0 lg:space-x-6">
            <div class="flex flex-col flex-grow space-y-3">
                <h2 class="text-lg font-normal">Information</h2>
                <hr>
                <div class="flex flex-col space-y-2">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" disabled class="bg-gray-100 border-2 border-none rounded-md" name="username"
                        id="username" value="<?= $user["username"] ?? "nom d'utilisateur inconnu" ?>" ">
                        <label for=" email">Email</label>
                    <input type="email" disabled class="bg-gray-100 border-2 border-none rounded-md" name="email"
                        id="email" value="<?= $user["email"] ?? "email inconnu" ?>">
                </div>
                <h2 class="text-lg font-normal">Modification du mot de passe</h2>
                <hr>
                <form action="/settings/account" method="POST" class="flex flex-col space-y-2">
                    <label for="oldPassword">Ancient mot de passe</label>
                    <input type="password" name="oldPassword" id="oldPassword"
                        class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>
                    <label for="newPassword">Nouveau mot de passe</label>
                    <input type="password" name="newPassword" id="newPassword"
                        class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>
                    <label for="newPasswordConfirm">confirmer le nouveau mot de passe</label>
                    <input type="password" name="newPasswordConfirm" id="newPasswordConfirm"
                        class="border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>
                    <input type="hidden" name="action" value="updatePassword">

                    <button type="submit"
                        class="bg-purple-500 rounded-md text-white font-medium px-6 py-3 hover:bg-purple-700 focus:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">
                        <p>Mettre à jour</p>
                    </button>
                </form>
            </div>
            <form action="/settings/account" method="POST" enctype="multipart/form-data"
                class="flex flex-col items-center lg:items-start space-y-4">
                <div class="relative">
                    <img src="<?= $user["image"]["path"] ?? "/public/images/userDefault.jpg" ?>" alt="Image de profile"
                        class="rounded-full h-64 w-64 object-cover">
                    <label for="profilePicture" tabindex="0"
                        class="absolute bottom-0 left-0 flex flex-row space-x-2 border-2 rounded-md px-2 py-1 border-gray-100 bg-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <p>modifier</p>
                    </label>
                    <input type="file" name="profilePicture" id="profilePicture" class="hidden" accept=" .jpeg, .jpg,
                        .png, .gif, .svg" required>
                </div>
                <input type="hidden" name="action" value="updatePicture">
                <button type="submit"
                    class="bg-purple-500 rounded-md text-white font-medium px-6 py-3 hover:bg-purple-700 focus:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300 w-full">Appliquer</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}