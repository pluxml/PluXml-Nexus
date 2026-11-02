<div class="content">
    <div class="page">
        <div class="auth">
            <h3>Reset password</h3>

            <?php if (isset($flash['success'])): ?>
                <div class="alert green">
                    <?= e($flash['success'][0]) ?>
                </div>
            <?php elseif (isset($flash['error'])): ?>
                <div class="alert red">
                    <?= e($flash['error'][0]) ?>
                </div>
            <?php endif; ?>

            <form action="<?= $routerService->urlFor('resetPassword') ?>" method="post">
                <input type="hidden" name="<?= e($csrf['nameKey']) ?>" value="<?= e($csrf['name']) ?>">
                <input type="hidden" name="<?= e($csrf['valueKey']) ?>" value="<?= e($csrf['value']) ?>">
                <input type="hidden" name="username" value="<?= e($user['username']) ?>">
                <div <?php if (isset($flash['error'][2])): ?>style="color:red"<?php endif; ?>>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" required>
                    <?php if (isset($flash['error'][2])): ?><p><?= e($flash['error'][2]) ?></p><?php endif; ?>
                </div>
                <div>
                    <input type="submit" value="Change my password">
                </div>
            </form>
            <small><a href="<?= $routerService->urlFor('lostPassword') ?>">← Back to log in</a></small>
        </div>
    </div>
</div>