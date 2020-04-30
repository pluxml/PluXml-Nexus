<h1><?= $h1 ?></h1>
<p>
    <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
    Plugins
</p>
<h2><?= $h2 ?></h2>

<div class="scrollable-table">
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
        <? foreach ($plugins as $key => $plugin): ?>
        <tr>
            <td><?= $plugin['name'] ?></td>
            <td><?= $plugin['description'] ?></td>
            <td><?= $plugin['versionPlugin'] ?></td>
            <td><?= $plugin['versionPluxml'] ?></td>
            <td><a href="<?= $plugin['website'] ?>"<a><?= $plugin['website'] ?></a></td>
            <td>
                <a href="<?= $routerService->urlFor('boeditplugin', ['name' => $plugin['name']]) ?>">edit</a>&nbsp;
                <a href="<?= $routerService->urlFor('boeditplugin', ['name' => $plugin['name']]) ?>">delete</a>&nbsp;
                <a href="<?= $plugin['link'] ?>">download</a></td>
            </td>
        </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>