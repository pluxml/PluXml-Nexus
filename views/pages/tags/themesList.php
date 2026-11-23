<?php foreach ($themes as $key => $theme): ?>
    <div class="col sml-12 med-3 panel">
        <a href="<?= escape_html($routerService->urlFor('theme', ['name' => $theme['name']])) ?>">
            <div class="panel-content">
                <strong><?= escape_html($theme['name']) ?></strong>
                <?php if (!empty($theme['description'])): ?>
                    <p><?= escape_html($theme['description']) ?></p>
                <?php endif; ?>
                <ul class="unstyled-list">
                    <li><i class="icon-user"></i><em><a href="<?= escape_html($routerService->urlFor('profile', ['username' => $theme['author']])) ?>"><?= escape_html($theme['author']) ?></a></em></li>
                    <?php if (!empty($theme['versionTheme'])): ?>
                        <li><i class="icon-tag"></i>Version : <?= escape_html($theme['versionTheme']) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($theme['versionPluxml'])): ?>
                        <li><i class="icon-leaf"></i>PluXml version <?= escape_html($theme['versionPluxml']) ?></li>
                    <?php endif; ?>
                </ul>
                <a href="<?= escape_html($theme['file']) ?>">
                    <button><i class="icon-download"></i>Download</button>
                </a>
            </div>
        </a>
    </div>
<?php endforeach; ?>
