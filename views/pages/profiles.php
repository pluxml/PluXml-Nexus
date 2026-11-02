<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page">
        <h2>Profiles</h2>
        <ul>
            <?php foreach ($profiles as $profile): ?>
                <li>
                    <a href="<?= e($routerService->urlFor('profile', ['username' => $profile['username']])) ?>"><?= e($profile['username']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>