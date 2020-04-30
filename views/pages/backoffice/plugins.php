<h1><?= $h1 ?></h1>
<p>
    <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
    Plugins
</p>
<h2><?= $h2 ?></h2>

<p>
    <a href="<?= $routerService->urlFor('boeditplugin', ['name' => $plugins[0]['name']]) ?>"><?= $plugins[0]['name'] ?></a>
</p>
<p>
    <a href="<?= $routerService->urlFor('boeditplugin', ['name' => $plugins[1]['name']]) ?>"><?= $plugins[1]['name'] ?></a>
</p>
<p>
    <a href="<?= $routerService->urlFor('boeditplugin', ['name' => $plugins[2]['name']]) ?>"><?= $plugins[2]['name'] ?></a>
</p>