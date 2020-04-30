<h1>Themes</h1>

<? foreach ($themes as $key => $theme): ?>
    <p><a href="<?= $routerService->urlFor('theme', ['name' => $theme['name']]) ?>"><?= $theme['name'] ?></a></p>
<?php endforeach; ?>