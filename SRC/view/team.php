<?php

/**
 * Team view
 * @param array $team
 * @param bool $isMember
 * @return void
 */
function viewTeam($team, $isMember, $isOwner)
{
    $title = $team["name"] ?? "Error";

    ob_start();
?>
    <div class="flex flex-col items-center">
        <div class="flex flex-col-reverse justify-center w-full px-4 py-2 space-y-5 space-y-reverse bg-white rounded-md md:max-w-2xl md:flex-row filter md:drop-shadow-md md:px-8 md:py-6 md:space-x-6 md:space-y-0">
            <!-- Team members -->
            <div class="flex-grow">
                <table class="table w-full border-collapse rounded-md table-auto ring-purple-500 ring-2">
                    <thead class="table-header-group min-w-full divide-blueGray-200">
                        <tr class="table-row">
                            <th class="table-cell px-6 py-3 text-2xl font-medium " colspan="<?= $isOwner ? "4" : "2" ?>">Membres</th>
                        </tr>
                    </thead>
                    <tbody class="table-row-group text-lg ">
                        <?php foreach ($team["members"] as $member) { ?>
                            <tr class="table-row px-6 py-3 border-t-2 border-purple-500">
                                <td class="table-cell px-3 py-1">
                                    <?php if (empty($member["path"])) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="object-cover w-8 h-8 text-white bg-purple-500 rounded-full" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                        </svg>
                                    <?php } else { ?>
                                        <img src="<?= $member["path"] ?>" alt="member profile image" class="object-cover w-8 h-8 rounded-full">
                                    <?php } ?>
                                </td>
                                <td class="flex flex-row items-center px-3 py-1">
                                    <p class=text-xl><?= $member["username"] ?></p>
                                    <?php if ($member["id"] == $team["owner_id"]) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 ml-3 text-yellow-300 fill-current" viewBox="0 0 24 24">
                                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l2 13h14l2-13-5 3-4-6-4 6-5-3z" />
                                            <circle cx="12" cy="14" r="2" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </svg>
                                    <?php } ?>
                                </td>
                                <?php if ($isOwner) { ?>
                                    <td class="items-center table-cell px-3 py-1">
                                        <?php if ($member["id"] != $team["owner_id"]) { ?>
                                            <form x-data action="/team/kick" method="POST" class="flex flex-row items-center">
                                                <input type="hidden" name="team" value="<?= $team["name"] ?>">
                                                <input type="hidden" name="target" value="<?= $member["email"] ?>">
                                                <button type="submit" class="p-1 rounded-full hover:text-purple-500 active:ring-purple-900 focus:outline-none focus:text-purple-500 focus:ring-2 active:text-purple-900 focus:ring-purple-500" @click="$event.preventDefault();$store.modal.kick.team = '<?=$team["name"]?>';$store.modal.kick.username = '<?=$member["username"]?>';$store.modal.kick.member = '<?=$member["email"]?>';$store.modal.kick.open();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                                <?php if ($isOwner) { ?>
                                    <td class="items-center table-cell px-3 py-1">
                                        <?php if ($member["id"] != $team["owner_id"]) { ?>
                                            <form action="/team/ownership" method="POST" class="flex flex-row items-center">
                                                <input type="hidden" name="team" value="<?= $team["name"] ?>">
                                                <input type="hidden" name="target" value="<?= $member["email"] ?>">
                                                <button type="submit" class="flex flex-row items-center p-1 rounded-full hover:text-purple-500 active:ring-purple-900 focus:outline-none focus:text-purple-500 focus:ring-2 active:text-purple-900 focus:ring-purple-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 text-yellow-300 fill-current" viewBox="0 0 24 24">
                                                        <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l2 13h14l2-13-5 3-4-6-4 6-5-3z" />
                                                        <circle cx="12" cy="14" r="2" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- Team info -->
            <div class="flex flex-col items-center">
                <?php if (empty($team["path"])) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="w-32 h-32 text-white bg-purple-500 rounded-full" stroke="currentColor" viewBox="0 0 24 24" fill="#000000">
                        <g>
                            <g>
                                <path stroke-width="0.01" fill="white" d="M21.58,16.09l-1.09-7.66C20.21,6.46,18.52,5,16.53,5H7.47C5.48,5,3.79,6.46,3.51,8.43l-1.09,7.66 C2.2,17.63,3.39,19,4.94,19h0c0.68,0,1.32-0.27,1.8-0.75L9,16h6l2.25,2.25c0.48,0.48,1.13,0.75,1.8,0.75h0 C20.61,19,21.8,17.63,21.58,16.09z M19.48,16.81C19.4,16.9,19.27,17,19.06,17c-0.15,0-0.29-0.06-0.39-0.16L15.83,14H8.17 l-2.84,2.84C5.23,16.94,5.09,17,4.94,17c-0.21,0-0.34-0.1-0.42-0.19c-0.08-0.09-0.16-0.23-0.13-0.44l1.09-7.66 C5.63,7.74,6.48,7,7.47,7h9.06c0.99,0,1.84,0.74,1.98,1.72l1.09,7.66C19.63,16.58,19.55,16.72,19.48,16.81z" />
                                <polygon fill="white" points="9,8 8,8 8,10 6,10 6,11 8,11 8,13 9,13 9,11 11,11 11,10 9,10" />
                                <circle fill="white" cx="17" cy="12" r="1" />
                                <circle fill="white" cx="15" cy="9" r="1" />
                            </g>
                        </g>
                    </svg>
                <?php } else { ?>
                    <img src="<?= $team["path"] ?>" alt="team icon" class="object-cover w-32 h-32 bg-white rounded-full filter drop-shadow-md">
                <?php } ?>
                <h1 class="text-2xl font-medium"><?= $team["name"] ?></h1>
                <p class="text-xl"> <?= $team["abbreviation"] ?></p>
                <?php if (!$isMember) { ?>
                    <form action="/joinTeam" method="POST" class="w-full mt-4 md:w-auto">
                        <input type="hidden" name="teamName" value="<?= $team["name"] ?>">
                        <button class="w-full px-4 py-2 font-medium text-white bg-purple-500 rounded-md focus:outline-none hover:bg-purple-700 focus:bg-purple-700 focus:ring-2 focus:ring-purple-500 filter focus:drop-shadow-md" type="submit">Rejoindre</button>
                    </form>
                <?php } else { ?>
                    <form action="/quitTeam" method="POST" class="w-full mt-4 md:w-auto">
                        <input type="hidden" name="teamName" value="<?= $team["name"] ?>">
                        <button class="w-full px-4 py-2 font-medium text-white bg-purple-500 rounded-md focus:outline-none hover:bg-purple-700 focus:bg-purple-700 focus:ring-2 focus:ring-purple-500 filter focus:drop-shadow-md" type="submit">Quitter</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div x-cloak x-data x-show="$store.modal.kick.visible" x-init="$store.modal.new('kick')" class="fixed top-0 left-0 flex flex-col items-center justify-center w-screen h-screen bg-black bg-opacity-25" @keyup.window.tab="if($store.modal.kick.visible && !$($el).has($event.target).length) {$event.prevent;$($el).find('button:visible').first().focus()}">
        <form action="/team/kick" method="POST" class="w-full text-lg bg-white divide-y divide-black rounded-md md:w-auto md:max-w-7xl filter drop-shadow-lg">
            <div class="flex flex-row items-center justify-between px-4 py-2 space-x-3">
                <h2 class="font-medium">Expulsion</h2>
                <button type="button" @click="$store.modal.kick.close()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-row items-center px-4 py-2">
                    <p>Voulez-vous vraiment expulser <span class="text-purple-700" x-text="$store.modal.kick.username"></span> ?</p>
            </div>
            <div class="flex flex-row items-center justify-end px-4 py-2 space-x-3">
                <input type="hidden" name="team" :value="$store.modal.kick.team">
                <input type="hidden" name="target" :value="$store.modal.kick.member">
                <button type="button" @click="$store.modal.kick.close()" class="px-4 py-2 text-white rounded-md bg-blueGray-500">Non</button>
                <button class="px-4 py-2 text-white bg-red-500 rounded-md">Oui</button>
            </div>
        </form>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
