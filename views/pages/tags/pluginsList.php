<?php foreach ($plugins as $key => $plugin): ?>
    <div class="col sml-12 med-3 panel">
        <a href="<?= e($routerService->urlFor('plugin', ['name' => $plugin['name']])) ?>">
            <div class="panel-content">
                <span class="panel-header text-center"><i class="<?= e($plugin['categoryIcon']) ?>"></i></span>
                <strong><?= e($plugin['name']) ?></strong>
                <ul class="unstyled-list">
                    <li><i class="icon-user"></i><em><a
                                href="<?= e($routerService->urlFor('profile', ['username' => $plugin['author']])) ?>"><?= e($plugin['author']) ?></a></em>
                    </li>
                    <li><i class="icon-tag"></i>Version : <?= e($plugin['versionPlugin']) ?></li>
                    <li><i class="icon-leaf"></i>PluXml version <?= e($plugin['versionPluxml']) ?></li>
                </ul>
                <a href=" <?= e($plugin['file']) ?>">
                    <button><i class="icon-download"></i>Download</button>
                </a>
            </div>
        </a>
    </div>
<?php endforeach; ?>
