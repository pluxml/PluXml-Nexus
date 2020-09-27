<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <? foreach ($plugins as $key => $plugin): ?>
            <div class="col sml-12 med-3 panel text-center">
                <a href="<?= $routerService->urlFor('plugin', ['name' => $plugin['name']]) ?>">
                    <div class="panel-content"><?= $plugin['name'] ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>