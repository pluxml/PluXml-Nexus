<div class="content">
    <div class="page">
        <h2><?= escape_html($h2) ?></h2>
        <p><a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;Themes</p>
        <h3><?= escape_html($h3) ?></h3>

        <p><a href="<?= $routerService->urlFor('boaddtheme') ?>" class="button blue">Add a theme</a></p>

        <div class="scrollable-table">
            <?php if (!empty($themes)): ?>
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Version</th>
                        <th>PluXml</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($themes as $key => $theme): ?>
                        <tr>
                            <td><?= escape_html($theme['name']) ?></td>
                            <td><?= escape_html($theme['description']) ?></td>
                            <td><?= escape_html($theme['versionPlugin']) ?></td>
                            <td><?= escape_html($theme['versionPluxml']) ?></td>
                            <td><a href="<?= escape_html(safe_url($theme['website'])) ?>"><?= escape_html($theme['website']) ?></a></td>
                            <td>
                                <a href="<?= escape_html($routerService->urlFor('boeditplugin', ['name' => $theme['name']])) ?>">edit</a>&nbsp;
                                <a href="<?= escape_html($routerService->urlFor('boeditplugin', ['name' => $theme['name']])) ?>">delete</a>&nbsp;
                                <a href="<?= escape_html(safe_url($theme['link'])) ?>">download</a>
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
