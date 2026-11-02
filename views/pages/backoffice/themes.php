<div class="content">
    <div class="page">
        <h2><?= e($h2) ?></h2>
        <p><a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;Themes</p>
        <h3><?= e($h3) ?></h3>

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
                            <td><?= e($theme['name']) ?></td>
                            <td><?= e($theme['description']) ?></td>
                            <td><?= e($theme['versionPlugin']) ?></td>
                            <td><?= e($theme['versionPluxml']) ?></td>
                            <td><a href="<?= e(safe_url($theme['website'])) ?>"><?= e($theme['website']) ?></a></td>
                            <td>
                                <a href="<?= e($routerService->urlFor('boeditplugin', ['name' => $theme['name']])) ?>">edit</a>&nbsp;
                                <a href="<?= e($routerService->urlFor('boeditplugin', ['name' => $theme['name']])) ?>">delete</a>&nbsp;
                                <a href="<?= e(safe_url($theme['link'])) ?>">download</a>
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
