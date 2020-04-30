<h1><?= $h1 ?></h1>

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
    <div class="col sml-6 med-3 panel text-center">
        <div class="panel-content">
            <img src="/img/favicon/favicon-32x32.png" alt="edit a plugin picto"/>
            <h2 class="no-margin h4">Edit a plugin</h2>
            <p>Modify an existing plugin</p>
            <p>
                <a href="<?= $routerService->urlFor('boplugins') ?>" class="button blue">Edit</a>
            </p>
        </div>
    </div>
    <div class="col sml-6 med-3 panel text-center">
        <div class="panel-content">
            <img src="/img/favicon/favicon-32x32.png" alt="add a plugin picto"/>
            <h2 class="no-margin h4">Add a plugin</h2>
            <p>Upload a new plugin</p>
            <p>
                <a href="<?= $routerService->urlFor('boaddplugin') ?>" class="button blue">Add a plugin</a>
            </p>
        </div>
    </div>
    <div class="col sml-6 med-3 panel text-center">
        <div class="panel-content">
            <img src="/img/favicon/favicon-32x32.png" alt="edit a theme picto"/>
            <h2 class="no-margin h4">Edit a themes</h2>
            <p>Modify an existing theme</p>
            <p>
                <a href="<?= $routerService->urlFor('bothemes') ?>" class="button blue">Edit</a>
            </p>
        </div>
    </div>
    <div class="col sml-6 med-3 panel text-center">
        <div class="panel-content">
            <img src="/img/favicon/favicon-32x32.png" alt="add a theme picto"/>
            <h2 class="no-margin h4">Add a theme</h2>
            <p>Add a new theme</p>
            <p>
                <a href="<?= $routerService->urlFor('boaddtheme') ?>" class="button blue">Add a theme</a>
            </p>
        </div>
    </div>
    <div class="col sml-6 med-3 panel text-center">
        <div class="panel-content">
            <img src="/img/favicon/favicon-32x32.png" alt="edit your profile picto"/>
            <h2 class="no-margin h4">My profile</h2>
            <p>Edit my profile</p>
            <p>
                <a href="<?= $routerService->urlFor('boeditprofile') ?>" class="button blue">Edit</a>
            </p>
        </div>
    </div>
</div>