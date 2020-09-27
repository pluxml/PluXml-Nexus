<h1><?= $h1 ?></h1>
<p>Hello <?= $_SESSION['user'] ?> !</p>
<?php if (isset($flash['success'])): ?>
    <div class="alert green">
        <?= $flash['success'][0] ?>
    </div>
<?php elseif (isset($flash['error'])): ?>
    <div class="alert red">
        <?= $flash['error'][0] ?>
    </div>
<?php endif; ?>

<div class="grid">
    <div class="col sml-12 med-3 panel text-center">
        <a href="<?= $routerService->urlFor('boplugins') ?>">
            <div class="panel-content">
                <img src="/img/favicon/favicon-32x32.png" alt="add or edit a plugin picto"/>
                <h2 class="no-margin h4">Plugins</h2>
                <p>Add or edit a plugin</p>
            </div>
        </a>
    </div>
    <div class="col sml-12 med-3 panel text-center">
        <a href="<?= $routerService->urlFor('bothemes') ?>">
            <div class="panel-content">
                <img src="/img/favicon/favicon-32x32.png" alt="add or edit a theme picto"/>
                <h2 class="no-margin h4">Themes</h2>
                <p>Add or edit a theme</p>
            </div>
        </a>
    </div>
    <div class="col sml-12 med-3 panel text-center">
        <a href="<?= $routerService->urlFor('boeditprofile') ?>">
            <div class="panel-content">
                <img src="/img/favicon/favicon-32x32.png" alt="edit your profile picto"/>
                <h2 class="no-margin h4">My profile</h2>
                <p>Edit my profile</p>
            </div>
        </a>
    </div>
</div>