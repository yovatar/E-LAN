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
                        <div class="flex flex-col object-cover w-full h-64 px-4 py-2 overflow-hidden bg-purple-500 rounded-md md:h-48 bg-hero-endless-clouds-purple400-100" style="<?= !empty($event["path"]) ? "background:url(" . $event["path"] . ") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" : '' ?>">
                            <h1 class="text-2xl font-medium text-white md:text-3xl"><?= $event["name"] ?></h1>
                            <div class="flex flex-row items-center space-x-2 text-xl text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <p><?= $start->format("Y-m-d H:i") ?></p>
                            </div>
                            <div class="flex flex-row items-center space-x-2 text-xl text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg> </svg>
                                <p><?= $diff->d > 0 ? $diff->d . "j " : '' ?><?= str_pad($diff->h, 2, "0", STR_PAD_LEFT) ?>:<?= str_pad($diff->i, 2, "0", STR_PAD_LEFT) ?></p>
                            </div>
                            <p class="text-lg text-white whitespace-pre-line md:text-xl"><?= $event["description"] ?></p>
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
