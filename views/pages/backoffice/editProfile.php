<h1><?= $h1 ?></h1>
<p>
    <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
    My profile
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

<form action="<?= $routerService->urlFor('profileSaveAction') ?>" method="post">
    <input type="hidden" name="<?= $csrf['nameKey'] ?>" value="<?= $csrf['name'] ?>">
    <input type="hidden" name="<?= $csrf['valueKey'] ?>" value="<?= $csrf['value'] ?>">
    <input type="hidden" name="username" value="<?= $username ?>">
    <div <?php if (isset($flash['email'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="email">Email address*: </label>
        <input type="email" name="email" id="email"
               <?php if (isset($formOldValues['email'])): ?>value="<?= $formOldValues['email'] ?>"
               <?php else: ?>value="<?= $email ?>"<?php endif; ?>
               required>
        <?php if (isset($flash['email'][0])): ?><p><?= $flash['email'][0] ?></p><?php endif; ?>
    </div>
    <div <?php if (isset($flash['website'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="website">Website: </label>
        <input type="url" name="website" id="website"
               <?php if (isset($formOldValues['website'])): ?>value="<?= $formOldValues['website'] ?>"
               <?php else: ?>value="<?= $website ?>"<?php endif; ?>>
        <?php if (isset($flash['website'][0])): ?><p><?= $flash['website'][0] ?></p><?php endif; ?>
    </div>
    <div>
        <input type="submit" value="Save">
    </div>
</form>

<form action="<?= $routerService->urlFor('profilePasswordAction') ?>" method="post">
    <input type="hidden" name="<?= $csrf['nameKey'] ?>" value="<?= $csrf['name'] ?>">
    <input type="hidden" name="<?= $csrf['valueKey'] ?>" value="<?= $csrf['value'] ?>">
    <input type="hidden" name="<?= $username ?>" value="<?= $username ?>">
    <div <?php if (isset($flash['password'][0]) or isset($flash['password2'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="password">Password*: </label>
        <input type="password" name="password" id="password"
               <?php if (isset($formOldValues['password'])): ?>value="<?= $formOldValues['password'] ?>"<?php endif; ?>
               required>
        <?php if (isset($flash['password'][0])): ?><p><?= $flash['password'][0] ?></p><?php endif; ?>
    </div>
    <div <?php if (isset($flash['password2'][0])): ?>style="color:red"<?php endif; ?>>
        <label for="password2">Confirm password*: </label>
        <input type="password" name="password2" id="password2" required>
        <?php if (isset($flash['password2'][0])): ?><p><?= $flash['password2'][0] ?></p><?php endif; ?>
    </div>
    <div>
        <input disabled type="submit" value="Change password">
    </div>
</form>
