<?php

/**
 * Displays a list of Teams
 * @param array $teams teams to be displayed
 * @param int $page current page for pagination
 * @param int $maxPage max page for pagination
 * @return void
 */
function viewTeamsList($teams, $page, $maxPage, $canCreate = false)
{
    $title = "Teams";

    ob_start();
?>
    <?php if ($canCreate) { ?>
        <div class="flex justify-end w-full px-2 my-2">
            <a href="/createTeam" class="w-full px-4 py-2 space-x-2 text-center text-white bg-purple-500 rounded-md md:w-auto hover:bg-purple-700">Créer une équipe</a>
        </div>
    <?php } ?>
    <?php /* Search */ ?>
    <div class="flex justify-center">
        <form x-data="search" @click.outside="results = []" x-init="url = '/api/teams/search'" @submit="$event.preventDefault()" action="/team/search" method="POST" class="flex flex-col w-full max-w-lg px-2 my-2">
            <label for="query">Rechercher</label>
            <div class="relative">
                <input @input.debounce="post([{name:'query',value:$el.value}])" type="text" id="query" name="query" placeholder="..." autocomplete="off" class="w-full border-2 rounded-md border-blueGray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button type="submit" class="absolute inset-y-0 right-0 flex flex-col items-center justify-center px-2 focus:outline-none focus:border-none hover:text-purple-500 focus:text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
            <div class="relative w-full" :class="results.length == 0 ? 'hidden': ''">
                <div class="absolute z-10 flex flex-col w-full px-2 py-1 space-y-1 bg-white rounded-b-md filter drop-shadow-md">
                    <template x-for="result in results">
                        <a :href="`/teams/${result.name}`" class="px-2 py-1 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500 hover:bg-purple-200 focus:bg-purple-200">
                            <p x-text="result.name"></p>
                        </a>
                    </template>
                </div>
            </div>
        </form>
    </div>
    <?php /* List */ ?>
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
                    <div class="flex flex-col items-center flex-grow space-y-2 md:items-start">
                        <h1 class="text-xl font-medium"><?= $team["name"] ?></h1>
                        <p class="text-base"><?= $team["abbreviation"] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php /* Pagination */ ?>
    <div class="flex flex-row justify-center">
        <div role="pagination" class="flex flex-row items-center justify-center mt-3 overflow-hidden bg-white border-2 divide-x-2 rounded-md border-blueGray-200 w-min filter drop-shadow">
            <a <?= $page > 1 ? 'href="/teams?page=' . ($page - 1) . '"' : '' ?> class="px-3 py-2 h-full flex flex-col justify-center focus:outline-none focus:text-white focus:bg-purple-500 <?= $page > 1 ? 'hover:bg-purple-500 hover:text-white' : 'bg-blueGray-100 text-gray-600' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <?php if ($maxPage <= 7) {
                // all
                for ($i = 1; $i <= $maxPage; $i++) { ?>
                    <a href="/teams?page=<?= $i ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php }
            } else if ($page <= 4) {
                // early
                for ($i = 1; $i <= 5; $i++) { ?>
                    <a href="/teams?page=<?= $i ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php } ?>
                <div class="px-3 py-2">...</div>
                <a href="/teams?page=<?= $maxPage ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white"><?= $maxPage ?></a>
            <?php
            } else if (($maxPage - $page) < 4) {
                // late
            ?>
                <a href="/teams?page=1" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white">1</a>
                <div class="px-3 py-2">...</div>
                <?php for ($i = $maxPage - 4; $i <= $maxPage; $i++) { ?>
                    <a href="/teams?page=<?= $i ?>" class="py-2 px-3 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php }
            } else {
                // middle
                ?>
                <a href="/teams?page=1" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white">1</a>
                <div class="px-3 py-2">...</div>
                <?php for ($i = $page - 1; $i <= $page + 1; $i++) {  ?>
                    <a href="/teams?page=<?= $i ?>" class="py-2 px-3 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white<?= ($page == $i) ? " bg-purple-100" : "" ?>"><?= $i ?></a>
                <?php } ?>
                <div class="px-3 py-2">...</div>
                <a href="/teams?page=<?= $maxPage ?>" class="px-3 py-2 hover:bg-purple-500 hover:text-white focus:outline-none focus:bg-purple-500 focus:text-white"><?= $maxPage ?></a>
            <?php } ?>
            <a <?= $page < $maxPage ? 'href="/teams?page=' . ($page + 1) . '"' : '' ?> class="px-3 py-2 h-full flex flex-col justify-center focus:outline-none focus:text-white focus:bg-purple-500 <?= $page < $maxPage ? 'hover:bg-purple-500 hover:text-white' : 'bg-blueGray-100 text-gray-600' ?>">
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
