<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page">
        <h2><?= $username ?></h2>
        <ul>
            <li>
                <a href="<?= $website ?>" target="_blank"><?= $website ?></a></li>
            </li>
        </ul>

        <h3>Plugins :</h3>
        <ul>
            <li>
                <a href="<?= $routerService->urlFor('plugin', ['name' => $plugins[0]['name']]) ?>"><?= $plugins[0]['name'] ?></a>
            </li>
            <li>
                <a href="<?= $routerService->urlFor('plugin', ['name' => $plugins[1]['name']]) ?>"><?= $plugins[1]['name'] ?></a>
            </li>
        </ul>
    </div>
</div>