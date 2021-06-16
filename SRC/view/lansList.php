<?php

/**
 * Displays a list of lans
 * @param array $lans lans to be displayed
 * @param int $page current page for pagination
 * @param int $maxPage max page for pagination
 * @return void
 */
function viewLansList($lans, $page, $maxPage, $canCreate = false)
{
    $title = "Lans";

    ob_start();
?>
    <?php if($canCreate){ ?>
        <div class="flex justify-end w-full my-2 ">
            <a href="/lan/create" class="px-4 py-2 space-x-2 text-white bg-purple-500 rounded-md hover:bg-purple-700">Créer une LAN</a>
        </div>
    <?php } ?>
    <? /* List */ ?>
    <div class="flex flex-row justify-center w-full px-6 py-3 bg-white rounded-md filter drop-shadow-md">
        <div class="flex flex-col w-full space-y-3">
            <?php foreach ($lans as $lan) { ?>
                <a href="/lans/<?= $lan["name"] ?>" class="flex flex-col items-center w-full px-4 py-2 space-y-2 rounded-md bg-blueGray-100 filter drop-shadow-sm md:items-start md:flex-row md:space-x-3 md:space-y-0 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-purple-200 hover:text-purple-900">
                    <?php if (empty($lan["path"])) { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="object-contain w-32 h-32 bg-white rounded-md" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                    <?php } else { ?>
                        <img class="object-cover w-32 h-32 bg-white rounded-md" src="<?= $lan["path"] ?>" alt="Lan image">
                    <?php } ?>
                    <div class="flex flex-col flex-grow space-y-2">
                        <h1 class="text-xl font-medium"><?= $lan["name"] ?></h1>
                        <p class="text-base"><?= $lan["description"] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <? /* Pagination */ ?>
    <div class="flex flex-row justify-center">
        <div role="pagination" class="flex flex-row items-center justify-center mt-3 overflow-hidden bg-white border-2 divide-x-2 rounded-md border-blueGray-200 w-min filter drop-shadow">
            <a <?= $page > 1 ? 'href="/lans?page=' . ($page - 1) . '"' : '' ?> class="px-3 py-2 h-full flex flex-col justify-center focus:outline-none focus:text-white focus:bg-purple-500 <?= $page > 1 ? 'hover:bg-purple-500 hover:text-white' : 'bg-blueGray-100 text-gray-600' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <?php if ($maxPage <= 7) {
                // all
                for ($i = 1; $i <= $maxPage; $i++) { ?>
                    <a href="/lans?page=<?= $i ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php }
            } else if ($page <= 4) {
                // early
                for ($i = 1; $i <= 5; $i++) { ?>
                    <a href="/lans?page=<?= $i ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php } ?>
                <div class="px-3 py-2">...</div>
                <a href="/lans?page=<?= $maxPage ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white"><?= $maxPage ?></a>
            <?php
            } else if (($maxPage - $page) < 4) {
                // late
            ?>
                <a href="/lans?page=1" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white">1</a>
                <div class="px-3 py-2">...</div>
                <?php for ($i = $maxPage - 4; $i <= $maxPage; $i++) { ?>
                    <a href="/lans?page=<?= $i ?>" class="py-2 px-3 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php }
            } else {
                // middle
                ?>
                <a href="/lans?page=1" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white">1</a>
                <div class="px-3 py-2">...</div>
                <?php for ($i = $page - 1; $i <= $page + 1; $i++) {  ?>
                    <a href="/lans?page=<?= $i ?>" class="py-2 px-3 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php } ?>
                <div class="px-3 py-2">...</div>
                <a href="/lans?page=<?= $maxPage ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white"><?= $maxPage ?></a>
            <?php } ?>
            <a <?= $page < $maxPage ? 'href="/lans?page=' . ($page + 1) . '"' : '' ?> class="px-3 py-2 h-full flex flex-col justify-center focus:outline-none focus:text-white focus:bg-purple-500 <?= $page < $maxPage ? 'hover:bg-purple-500 hover:text-white' : 'bg-blueGray-100 text-gray-600' ?>">
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
