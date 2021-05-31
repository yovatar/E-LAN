<?php

/**
 * Displays a list of Teams
 * @param array $teams teams to be displayed
 * @param int $pageteams current page for pagination
 * @param int $maxPageTeams max page for pagination
 * @return void
 */
function viewTeamsList($teams, $pageteams, $maxPageTeams)
{
    $title = "Teams";

    ob_start();
    ?>
    <? /* List */ ?>
    <div class="flex flex-row justify-center w-full px-6 py-3 bg-white rounded-md filter drop-shadow-md">
        <div class="flex flex-col w-full space-y-3">
            <?php foreach ($teams as $team) { ?>
                <a href="/teams/<?= $team["name"] ?>" class="flex flex-col items-center w-full px-4 py-2 space-y-2 rounded-md bg-blueGray-100 filter drop-shadow-sm md:items-start md:flex-row md:space-x-3 md:space-y-0 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-purple-200 hover:text-purple-900">
                    <?php if (empty($team["path"])) { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="object-contain w-32 h-32 bg-white rounded-md" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                    <?php } else { ?>
                        <img class="object-cover w-32 h-32 bg-white rounded-md" src="<?= $team["path"] ?>" alt="Team image">
                    <?php } ?>
                    <div class="flex flex-col flex-grow space-y-2">
                        <h1 class="text-xl font-medium"><?= $team["name"] ?></h1>
                        <p class="text-base"><?= $team["abbreviation"] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <? /* Pagination */ ?>
    <div class="flex flex-row justify-center">
        <div role="pagination" class="flex flex-row items-center justify-center mt-3 overflow-hidden bg-white border-2 divide-x-2 rounded-md border-blueGray-200 w-min filter drop-shadow">
            <a <?= $pageteams > 1 ? 'href="/teams?pageteams=' . ($pageteams - 1) . '"' : '' ?> class="px-3 py-2 h-full flex flex-col justify-center focus:outline-none focus:text-white focus:bg-purple-500 <?= $pageteams > 1 ? 'hover:bg-purple-500 hover:text-white' : 'bg-blueGray-100 text-gray-600' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <?php if ($maxPageTeams <= 7) {
                // all
                for ($i = 1; $i <= $maxPageTeams; $i++) { ?>
                    <a href="/teams?pageteams=<?= $i ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($pageteams == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php }
            } else if ($pageteams <= 4) {
                // early
                for ($i = 1; $i <= 5; $i++) { ?>
                    <a href="/teams?pageteams=<?= $i ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($pageteams == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php } ?>
                <div class="px-3 py-2">...</div>
                <a href="/teams?page=<?= $maxPageTeams ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white"><?= $maxPageTeams ?></a>
                <?php
            } else if (($maxPageTeams - $pageteams) < 4) {
                // late
                ?>
                <a href="/teams?page=1" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white">1</a>
                <div class="px-3 py-2">...</div>
                <?php for ($i = $maxPageTeams - 4; $i <= $maxPageTeams; $i++) { ?>
                    <a href="/teams?pageteams=<?= $i ?>" class="py-2 px-3 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($pageteams == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php }
            } else {
                // middle
                ?>
                <a href="/teams?pageteams=1" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white">1</a>
                <div class="px-3 py-2">...</div>
                <?php for ($i = $pageteams - 1; $i <= $pageteams + 1; $i++) {  ?>
                    <a href="/teams?pageteams=<?= $i ?>" class="py-2 px-3 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($pageteams == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php } ?>
                <div class="px-3 py-2">...</div>
                <a href="/teams?pageteams=<?= $maxPageTeams ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white"><?= $maxPageTeams ?></a>
            <?php } ?>
            <a <?= $pageteams < $maxPageTeams ? 'href="/teams?pageteams=' . ($pageteams + 1) . '"' : '' ?> class="px-3 py-2 h-full flex flex-col justify-center focus:outline-none focus:text-white focus:bg-purple-500 <?= $pageteams < $maxPageTeams ? 'hover:bg-purple-500 hover:text-white' : 'bg-blueGray-100 text-gray-600' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
    <?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}
