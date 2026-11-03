<?php foreach ($plugins as $key => $plugin): ?>
    <div class="col sml-12 med-3 panel">
        <a href="<?= escape_html($routerService->urlFor('plugin', ['name' => $plugin['name']])) ?>">
            <div class="panel-content">
                <span class="panel-header text-center"><i class="<?= escape_html($plugin['categoryIcon']) ?>"></i></span>
                <strong><?= escape_html($plugin['name']) ?></strong>
                <ul class="unstyled-list">
                    <li><i class="icon-user"></i><em><a
                                href="<?= escape_html($routerService->urlFor('profile', ['username' => $plugin['author']])) ?>"><?= escape_html($plugin['author']) ?></a></em>
                    </li>
                    <li><i class="icon-tag"></i>Version : <?= escape_html($plugin['versionPlugin']) ?></li>
                    <li><i class="icon-leaf"></i>PluXml version <?= escape_html($plugin['versionPluxml']) ?></li>
                </ul>
                <a href=" <?= escape_html($plugin['file']) ?>">
                    <button><i class="icon-download"></i>Download</button>
                </a>
            </div>
        </a>
    </div>
<?php endforeach; ?>
