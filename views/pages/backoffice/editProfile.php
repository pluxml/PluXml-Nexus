<div class="content">
    <div class="page">
        <h2><?= e($h2) ?></h2>
        <p>
            <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
            My profile
        </p>
        <h3><?= e($h3) ?></h3>

        <?php if (isset($flash['success'])): ?>
            <div class="alert green">
                <?= e($flash['success'][0]) ?>
            </div>
        <?php elseif (isset($flash['error'])): ?>
            <div class="alert red">
                <?= e($flash['error'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="<?= $routerService->urlFor('profileSaveAction') ?>" method="post">
            <input type="hidden" name="<?= e($csrf['nameKey']) ?>" value="<?= e($csrf['name']) ?>">
            <input type="hidden" name="<?= e($csrf['valueKey']) ?>" value="<?= e($csrf['value']) ?>">
            <input type="hidden" name="username" value="<?= e($username) ?>">
            <div <?php if (isset($flash['email'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="email">Email address*: </label>
                <input type="email" name="email" id="email"
                       <?php if (isset($formOldValues['email'])): ?>value="<?= e($formOldValues['email']) ?>"
                       <?php else: ?>value="<?= e($email) ?>"<?php endif; ?>
                       required>
                <?php if (isset($flash['email'][0])): ?><p><?= e($flash['email'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['website'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="website">Website: </label>
                <input type="url" name="website" id="website"
                       <?php if (isset($formOldValues['website'])): ?>value="<?= htmlspecialchars($formOldValues['website']) ?>"
                       <?php else: ?>value="<?= htmlspecialchars((string) $website) ?>"<?php endif; ?>>
                <?php if (isset($flash['website'][0])): ?><p><?= e($flash['website'][0]) ?></p><?php endif; ?>
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>

        <h4>Change password</h4>
        <form action="<?= $routerService->urlFor('profilePasswordAction') ?>" method="post">
            <input type="hidden" name="<?= e($csrf['nameKey']) ?>" value="<?= e($csrf['name']) ?>">
            <input type="hidden" name="<?= e($csrf['valueKey']) ?>" value="<?= e($csrf['value']) ?>">
            <input type="hidden" name="username" value="<?= e($username) ?>">
            <div <?php if (isset($flash['currentPassword'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="currentPassword">Current password*: </label>
                <input type="text" name="currentPassword" id="currentPassword" required>
            </div>
            <div>
                <label for="newPassword">New password*: </label>
                <input type="password" name="newPassword" id="newPassword" required>
            </div>
            <div>
                <label for="confirmPassword">Confirm password*: </label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
