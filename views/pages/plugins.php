<h1>Plugins</h1>

<? foreach ($plugins as $key => $plugin): ?>
    <p><a href="<?= $routerService->urlFor('plugin', ['name' => $plugin['name']]) ?>"><?= $plugin['name'] ?></a></p>
<?php endforeach; ?>