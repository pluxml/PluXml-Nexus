<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page">
        <h2>Profiles</h2>
        <p>
            <a href="<?= $routerService->urlFor('profile', ['username' => $profiles[0]['username']]) ?>"><?= $profiles[0]['username'] ?></a>
        </p>
        <p>
            <a href="<?= $routerService->urlFor('profile', ['username' => $profiles[1]['username']]) ?>"><?= $profiles[1]['username'] ?></a>
        </p>
    </div>
</div>