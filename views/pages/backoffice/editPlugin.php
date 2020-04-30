<h1><?= $h1 ?></h1>
<p>
    <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
    <a href="<?= $routerService->urlFor('boplugins') ?>">Plugins</a>&nbsp;/&nbsp;
    <?= $name ?>
</p>
<h2><?= $h2 ?></h2>

<?php if (isset($flash['success'])): ?>
    <div class="alert green">
        <?= $flash['success'][0] ?>
    </div>
<?php elseif (isset($flash['error'])): ?>
    <div class="alert red">
        <?= $flash['error'][0] ?>
    </div>
<?php endif; ?>

<p><a href="#" class="button">Upload new file</a></p>

<form action="<?= $routerService->urlFor('pluginEditAction', ['name' => $name]) ?>" method="post">
    <input type="hidden" name="<?= $csrf['nameKey'] ?>" value="<?= $csrf['name'] ?>">
    <input type="hidden" name="<?= $csrf['valueKey'] ?>" value="<?= $csrf['value'] ?>">
    <input type="hidden" name="name" value="<?= $name ?>">
    <input type="hidden" name="author" value="<?= $_SESSION['user'] ?>">
    <div
        <?php if (isset($flash['description'][0]) or isset($flash['description'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="description">Description*: </label>
        <input type="text" name="description" id="description"
               <?php if (isset($formOldValues['description'])): ?>value="<?= $formOldValues['description'] ?>"
               <?php else: ?>value="<?= $description ?>"<?php endif; ?>>
        <?php if (isset($flash['description'][0])): ?><p><?= $flash['description'][0] ?></p><?php endif; ?>
    </div>
    <div <?php if (isset($flash['versionPlugin'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="versionPlugin">Version*: </label>
        <input type="text" name="versionPlugin" id="versionPlugin"
               <?php if (isset($formOldValues['versionPlugin'])): ?>value="<?= $formOldValues['versionPlugin'] ?>"
               <?php else: ?>value="<?= $versionPlugin ?>"<?php endif; ?>>
        <?php if (isset($flash['versionPlugin'][0])): ?><p><?= $flash['versionPlugin'][0] ?></p><?php endif; ?>
    </div>
    <div <?php if (isset($flash['versionPluxml'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="versionPluxml">PluXml version*: </label>
        <input type="text" name="versionPluxml" id="versionPluxml"
               <?php if (isset($formOldValues['versionPluxml'])): ?>value="<?= $formOldValues['versionPluxml'] ?>"
               <?php else: ?>value="<?= $versionPluxml ?>"<?php endif; ?>>
        <?php if (isset($flash['versionPluxml'][0])): ?><p><?= $flash['versionPluxml'][0] ?></p><?php endif; ?>
    </div>
    <div <?php if (isset($flash['link'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="link">Link: </label>
        <input type="url" name="link" id="link"
               <?php if (isset($formOldValues['link'])): ?>value="<?= $formOldValues['link'] ?>"
               <?php else: ?>value="<?= $link ?>"<?php endif; ?>>
        <?php if (isset($flash['link'][0])): ?><p><?= $flash['link'][0] ?></p><?php endif; ?>
    </div>
    <div>
        <p><input type="submit" class="blue" value="Save">&nbsp;<a href="#" class="button red">Delete</a></p>
    </div>
</form>