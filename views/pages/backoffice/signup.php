<div class="content">
    <div class="page">
        <div class="auth">
            <h3>Sign up</h3>

            <?php if (isset($flash['success'])): ?>
                <div class="alert green">
                    <?= escape_html($flash['success'][0]) ?>
                </div>
            <?php elseif (isset($flash['error'])): ?>
                <div class="alert red">
                    <?= escape_html($flash['error'][0]) ?>
                </div>
            <?php endif; ?>

            <form action="<?= $routerService->urlFor('signupAction') ?>" method="post">
                <input type="hidden" name="<?= escape_html($csrf['nameKey']) ?>" value="<?= escape_html($csrf['name']) ?>">
                <input type="hidden" name="<?= escape_html($csrf['valueKey']) ?>" value="<?= escape_html($csrf['value']) ?>">
                <input type="hidden" name="timestamp" value="<?= escape_html($timestamp) ?>">
                <div <?php if (isset($flash['username'][0])): ?>style="color:red"<?php endif; ?>>
                    <label for="username">Username*: </label>
                    <input type="text" name="username" id="username"
                           <?php if (isset($formOldValues['username'])): ?>value="<?= escape_html($formOldValues['username']) ?>"<?php endif; ?>
                           required>
                    <?php if (isset($flash['username'][0])): ?><p><?= escape_html($flash['username'][0]) ?></p><?php endif; ?>
                </div>
                <div
                    <?php if (isset($flash['password'][0]) or isset($flash['password2'][0])): ?>style="color:red"<?php endif; ?>>
                    <label for="password">Password*: </label>
                    <input type="password" name="password" id="password"
                           <?php if (isset($formOldValues['password'])): ?>value="<?= escape_html($formOldValues['password']) ?>"<?php endif; ?>
                           required>
                    <?php if (isset($flash['password'][0])): ?><p><?= escape_html($flash['password'][0]) ?></p><?php endif; ?>
                </div>
                <div <?php if (isset($flash['password2'][0])): ?>style="color:red"<?php endif; ?>>
                    <label for="password2">Confirm password*: </label>
                    <input type="password" name="password2" id="password2" required>
                    <?php if (isset($flash['password2'][0])): ?><p><?= escape_html($flash['password2'][0]) ?></p><?php endif; ?>
                </div>
                <div <?php if (isset($flash['email'][0])): ?>style="color:red"<?php endif; ?>>
                    <label for="email">Email address*: </label>
                    <input type="email" name="email" id="email"
                           <?php if (isset($formOldValues['email'])): ?>value="<?= escape_html($formOldValues['email']) ?>"<?php endif; ?>
                           required>
                    <?php if (isset($flash['email'][0])): ?><p><?= escape_html($flash['email'][0]) ?></p><?php endif; ?>
                </div>
                <div>
                    <input type="submit" value="Sign up">
                </div>
            </form>
        </div>
    </div>
</div>
