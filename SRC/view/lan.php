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
        <div class="flex flex-col-reverse items-center justify-center w-full px-4 py-2 space-y-5 space-y-reverse bg-white rounded-md md:max-w-2xl md:flex-row filter md:drop-shadow-md md:px-8 md:py-6 md:space-x-6 md:space-y-0">
            <div class="flex flex-col space-y-3">
                <p class="hidden text-xl font-medium md:block"><?= strftime("%A %e %B %Y",strtotime($lan["start"])) ?> - <?= strftime("%A %e %B %Y",strtotime($lan["end"])) ?></p>
                <div class="flex flex-col items-center text-xl font-medium md:hidden">
                <p><?= strftime("%a %e %b %Y",strtotime($lan["start"])) ?></p>
                <p>à</p>
                <p><?= strftime("%a %e %b %Y",strtotime($lan["end"])) ?></p>
                </div>
                <p class="text-lg whitespace-pre-line"><?= $lan["description"] ?></p>
            </div>
            <div class="flex flex-col items-center space-y-3">
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
            </div>
        </div>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
