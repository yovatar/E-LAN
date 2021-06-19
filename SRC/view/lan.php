<?php

/**
 * Lan view
 * @param array $lan
 * @param bool $isModerator
 * @return void
 */
function viewLan($lan, $isModerator)
{
    $title = $lan["name"] ?? "Error";

    ob_start();
?>
    <div class="flex flex-col items-center">
        <div class="flex flex-col w-full px-4 py-2 space-y-2 bg-white rounded-md md:max-w-2xl filter md:drop-shadow-md md:px-8 md:py-6">
            <div class="flex flex-col-reverse items-center justify-center w-full space-y-5 space-y-reverse md:flex-row md:space-x-6 md:space-y-0">
                <div class="flex flex-col space-y-3">
                    <p class="hidden text-xl font-medium md:block"><?= utf8_encode(strftime("%A %e %B %Y", strtotime($lan["start"]))) ?> - <?= utf8_encode(strftime("%A %e %B %Y", strtotime($lan["end"]))) ?></p>
                    <div class="flex flex-col items-center text-xl font-medium md:hidden">
                        <p><?= utf8_encode(strftime("%a %e %b %Y", strtotime($lan["start"]))) ?></p>
                        <p>à</p>
                        <p><?= utf8_encode(strftime("%a %e %b %Y", strtotime($lan["end"]))) ?></p>
                    </div>
                    <p class="text-lg whitespace-pre-line"><?= $lan["description"] ?></p>
                </div>
                <div class="flex flex-col items-center w-full space-y-3 md:w-auto">
                    <?php if (empty($lan["path"])) { ?>
                        <?php /* Default image */ ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-white bg-purple-500 rounded-full" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                    <?php } else { ?>
                        <?php /* Custom team image */ ?>
                        <img src="<?= $lan["path"] ?>" alt="team icon" class="object-cover w-32 h-32 bg-white rounded-full filter drop-shadow-md">
                    <?php } ?>
                    <h1 class="text-2xl font-medium"><?= $lan["name"] ?></h1>
                    <p class="text-xl"><?= $lan["places"] ?> places</p>
                    <?php if ($isModerator) { ?>
                        <a href="/lan/update?lan=<?= $lan["name"] ?>" class="w-full px-4 py-2 font-medium text-center text-white bg-purple-500 rounded-md focus:outline-none hover:bg-purple-700 focus:bg-purple-700 focus:ring-2 focus:ring-purple-500 filter focus:drop-shadow-md">Modifier</a>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col w-full space-y-2">
                <?php foreach ($lan["events"] as $event) { ?>
                    <?php if (!empty($event["id"])) {
                        $start = new DateTime($event["start"]);
                        $end = new DateTime($event["end"]);
                        $diff = $end->diff($start);
                    ?>
                        <div x-data="modal" :class="visible ? 'h-128 md:h-72' : 'h-64 md:h-48'" @click="open()" @click.outside="close()" class="relative flex flex-col object-cover w-full px-4 py-2 overflow-hidden overflow-y-auto transition-all bg-purple-500 rounded-md cursor-pointer bg-hero-endless-clouds-purple400-100" style="<?= !empty($event["path"]) ? "background:url(" . $event["path"] . ") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" : '' ?>">
                            <h1 class="text-2xl font-medium text-white md:text-3xl"><?= $event["name"] ?></h1>
                            <div class="flex flex-row items-center space-x-2 text-xl text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <p><?= $start->format("Y-m-d H:i") ?></p>
                                <?php if ($isModerator) { ?>
                                    <a href="/event/update&event=<?= $event["id"] ?>" x-cloak x-show="visible" type="button" class="absolute top-0 right-0 px-2 py-2 text-white focus:outline-none focus:text-purple-900 hover:text-purple-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:h-7 md:w-7" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="flex flex-row items-center space-x-2 text-xl text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg> </svg>
                                <p><?= $diff->d > 0 ? $diff->d . "j " : '' ?><?= str_pad($diff->h, 2, "0", STR_PAD_LEFT) ?>:<?= str_pad($diff->i, 2, "0", STR_PAD_LEFT) ?></p>
                            </div>
                            <div class="flex flex-row items-center space-x-2 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-lg text-white md:text-xl"><?= $event["type"] ?></p>
                            </div>
                            <p x-cloak x-show="visible" class="text-lg text-white whitespace-pre-line md:text-xl"><?= $event["description"] ?></p>
                            <form x-cloak x-show="visible" action="/event/register" class="absolute bottom-0 right-0 px-4 py-4" method="POST">
                                <input type="hidden" name="email" value="<?= getCurrentUser()["email"] ?>">
                                <input type="hidden" name="event" value="<?= $event["id"] ?>">
                                <button type="submit" class="flex items-center px-3 py-2 space-x-1 text-purple-500 bg-white rounded-md hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-white focus:ring focus:text-white focus:bg-purple-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <p>Rejoindre</p>
                                </button>
                            </form>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if ($isModerator) { ?>
                    <a href="/event/create?lan=<?= $lan["name"] ?>" class="w-full px-4 py-2 font-medium text-center text-white bg-purple-500 rounded-md focus:outline-none hover:bg-purple-700 focus:bg-purple-700 focus:ring-2 focus:ring-purple-500 filter focus:drop-shadow-md">Nouvel événement</a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
