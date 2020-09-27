<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <? foreach ($themes as $key => $theme): ?>
            <div class="col sml-12 med-3 panel text-center">
                <a href="<?= $routerService->urlFor('theme', ['name' => $theme['name']]) ?>">
                    <div class="panel-content"><?= $theme['name'] ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>