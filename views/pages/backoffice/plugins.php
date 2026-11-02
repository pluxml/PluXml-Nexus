<div class="content">
    <div class="page">
        <h2><?= escape_html($h2) ?></h2>
        <p><a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;Plugins</p>
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

        <a href="<?= $routerService->urlFor('boaddplugin') ?>">
            <button>Add a plugin</button>
        </a>

        <div class="scrollable-table">
            <?php if (!empty($plugins)): ?>
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
                    <?php foreach ($plugins as $key => $plugin): ?>
                        <tr>
                            <td>
                                <a href="<?= escape_html($routerService->urlFor('plugin', ['name' => $plugin['name']])) ?>"><?= escape_html($plugin['name']) ?></a>
                            </td>
                            <td><?= escape_html($plugin['description']) ?></td>
                            <td><?= escape_html($plugin['versionPlugin']) ?></td>
                            <td><?= escape_html($plugin['versionPluxml']) ?></td>
                            <td><a href="<?= escape_html(safe_url($plugin['link'])) ?>"><?= escape_html($plugin['link']) ?></a></td>
                            <td>
                                <a href="<?= escape_html($routerService->urlFor('boeditplugin', ['name' => $plugin['name']])) ?>"><i
                                            class="icon-pencil"></i></a>
                                <a href="<?= escape_html($plugin['file']) ?>"><i class="icon-download"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No plugins to edit</p>
            <?php endif; ?>
        </div>
    </div>
</div>
