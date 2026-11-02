<div class="content">
    <div class="page">
        <h2><?= escape_html($h2) ?></h2>
        <p>
            <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
            My profile
        </p>
        <h3><?= escape_html($h3) ?></h3>

        <?php if (isset($flash['success'])): ?>
            <div class="alert green">
                <?= escape_html($flash['success'][0]) ?>
            </div>
        <?php elseif (isset($flash['error'])): ?>
            <div class="alert red">
                <?= escape_html($flash['error'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="<?= $routerService->urlFor('profileSaveAction') ?>" method="post">
            <input type="hidden" name="<?= escape_html($csrf['nameKey']) ?>" value="<?= escape_html($csrf['name']) ?>">
            <input type="hidden" name="<?= escape_html($csrf['valueKey']) ?>" value="<?= escape_html($csrf['value']) ?>">
            <input type="hidden" name="username" value="<?= escape_html($username) ?>">
            <div <?php if (isset($flash['email'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="email">Email address*: </label>
                <input type="email" name="email" id="email"
                       <?php if (isset($formOldValues['email'])): ?>value="<?= escape_html($formOldValues['email']) ?>"
                       <?php else: ?>value="<?= escape_html($email) ?>"<?php endif; ?>
                       required>
                <?php if (isset($flash['email'][0])): ?><p><?= escape_html($flash['email'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['website'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="website">Website: </label>
                <input type="url" name="website" id="website"
                       <?php if (isset($formOldValues['website'])): ?>value="<?= htmlspecialchars($formOldValues['website']) ?>"
                       <?php else: ?>value="<?= htmlspecialchars((string) $website) ?>"<?php endif; ?>>
                <?php if (isset($flash['website'][0])): ?><p><?= escape_html($flash['website'][0]) ?></p><?php endif; ?>
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>

        <h4>Change password</h4>
        <form action="<?= $routerService->urlFor('profilePasswordAction') ?>" method="post">
            <input type="hidden" name="<?= escape_html($csrf['nameKey']) ?>" value="<?= escape_html($csrf['name']) ?>">
            <input type="hidden" name="<?= escape_html($csrf['valueKey']) ?>" value="<?= escape_html($csrf['value']) ?>">
            <input type="hidden" name="username" value="<?= escape_html($username) ?>">
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
