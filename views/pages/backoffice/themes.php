<div class="content">
    <div class="page">
        <h2><?= escape_html($h2) ?></h2>
        <p><a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;Themes</p>
        <h3><?= escape_html($h3) ?></h3>

        <?php if (isset($flash['success'])): ?>
            <div class="alert green">
                <?= escape_html($flash['success'][0]) ?>
            </div>
        <?php elseif (isset($flash['error'])): ?>
            <div class="alert red">
                <?= escape_html($flash['error'][0]) ?>
            </div>
        <?php endif; ?>

        <a href="<?= $routerService->urlFor('boaddtheme') ?>">
            <button>Add a theme</button>
        </a>

        <div class="scrollable-table">
            <?php if (!empty($themes)): ?>
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Version</th>
                        <th>PluXml</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($themes as $key => $theme): ?>
                        <tr>
                            <td>
                                <a href="<?= escape_html($routerService->urlFor('theme', ['name' => $theme['name']])) ?>"><?= escape_html($theme['name']) ?></a>
                            </td>
                            <td><?= escape_html($theme['description']) ?></td>
                            <td><?= escape_html($theme['versionTheme']) ?></td>
                            <td><?= escape_html($theme['versionPluxml']) ?></td>
                            <td><a href="<?= escape_html(safe_url($theme['link'])) ?>"><?= escape_html($theme['link']) ?></a></td>
                            <td>
                                <a href="<?= escape_html($routerService->urlFor('boedittheme', ['name' => $theme['name']])) ?>"><i class="icon-pencil"></i></a>
                                <a href="<?= escape_html($theme['file']) ?>"><i class="icon-download"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No themes to edit</p>
            <?php endif; ?>
        </div>
    </div>
</div>
