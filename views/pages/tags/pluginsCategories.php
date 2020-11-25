<div class="text-center">
    <h2 class="h3">Categories</h2>
    <ul class="inline-list">
        <li><a href="<?= $routerService->urlFor('plugins') ?>">All</a></li>
        <? foreach ($categories as $category => $value): ?>
            <li>
                <a href="<?= $routerService->urlFor('category', ['name' => $value['name']]) ?>"><?= $value['name'] ?></a>
            </li>
        <? endforeach; ?>
    </ul>
</div>