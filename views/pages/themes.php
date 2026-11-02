<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <?php if (!empty($themes)): ?>
            <?php foreach ($themes as $key => $theme): ?>
                <div class="col sml-12 med-3 panel text-center">
                    <a href="<?= e($routerService->urlFor('theme', ['name' => $theme['name']])) ?>">
                        <div class="panel-content"><?= e($theme['name']) ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert orange">No themes found</div>
        <?php endif; ?>
    </div>
</div>
