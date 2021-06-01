<?php

/**
 * Team view
 * @return void
 */
function viewTeam($team, $isMember)
{
    $title = $team["name"] ?? "Error";

    ob_start();
?>
    <div class="flex flex-col items-center">
        <div class="flex flex-col-reverse justify-center w-auto px-4 py-2 bg-white rounded-md md:flex-row filter drop-shadow-md md:px-8 md:py-6 md:space-x-6 md:space-y-0">
            <!-- Team members -->
            <div>
                <div class="overflow-hidden border-2 rounded-md border-blueGray-200">
                    <div class="flex flex-col min-w-full divide-y-2 rounded-md table-auto divide-blueGray-200">
                        <div class="flex flex-row">
                            <div class="px-6 py-3 text-2xl font-medium">Membres</div>
                        </div>
                        <div class="flex flex-col text-lg divide-y divide-blueGray-200">
                            <?php foreach ($team["members"] as $member) { ?>
                                <div class="flex flex-row items-center px-6 py-3 space-x-3">
                                    <?php if (empty($member["path"])) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="object-cover w-6 h-6 text-white bg-purple-500 rounded-full" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                        </svg>
                                    <?php } else { ?>
                                        <img src="<?= $member["path"] ?>" alt="member profile image" class="object-cover w-6 h-6 rounded-full">
                                    <?php } ?>
                                    <p><?= $member["username"] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
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
                    <form action="/joinTeam" method="POST" class="mt-4">
                        <input type="hidden" name="teamName" value="<?= $team["name"] ?>">
                        <button class="px-4 py-2 font-medium text-white bg-purple-500 rounded-md focus:outline-none hover:bg-purple-700 focus:bg-purple-700 focus:ring-2 focus:ring-purple-500 filter focus:drop-shadow-md" type="submit">Rejoindre</button>
                    </form>
                <?php } else { ?>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
