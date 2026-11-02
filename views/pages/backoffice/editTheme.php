<h1><?= e($h1) ?></h1>
<h2><?= e($h2) ?></h2>

<?php if (isset($flash['success'])): ?>
	<div class="alert green">
		<?= e($flash['success'][0]) ?>
	</div>
<?php elseif (isset($flash['error'])): ?>
	<div class="alert red">
		<?= e($flash['error'][0]) ?>
	</div>
<?php endif; ?>

<form action="<?= $routerService->urlFor('signupAction') ?>" method="post">
	<input type="hidden" name="<?= e($csrf['nameKey']) ?>" value="<?= e($csrf['name']) ?>">
	<input type="hidden" name="<?= e($csrf['valueKey']) ?>" value="<?= e($csrf['value']) ?>">
	<div <?php if (isset($flash['username'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="username">Username*: </label>
		<input type="text" name="username" id="username" <?php if (isset($formOldValues['username'])): ?>value="<?= e($formOldValues['username']) ?>"<?php endif; ?> required>
		<?php if (isset($flash['username'][0])): ?><p><?= e($flash['username'][0]) ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['password'][0]) or isset($flash['password2'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="password">Password*: </label>
		<input type="password" name="password" id="password" <?php if (isset($formOldValues['password'])): ?>value="<?= e($formOldValues['password']) ?>"<?php endif; ?> required>
		<?php if (isset($flash['password'][0])): ?><p><?= e($flash['password'][0]) ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['password2'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="password2">Confirm password*: </label>
		<input type="password" name="password2" id="password2" required>
		<?php if (isset($flash['password2'][0])): ?><p><?= e($flash['password2'][0]) ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['email'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="email">Email address*: </label>
		<input type="email" name="email" id="email" <?php if (isset($formOldValues['email'])): ?>value="<?= e($formOldValues['email']) ?>"<?php endif; ?> required>
		<?php if (isset($flash['email'][0])): ?><p><?= e($flash['email'][0]) ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['website'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="website">Website: </label>
		<input type="url" name="website" id="website" <?php if (isset($formOldValues['website'])): ?>value="<?= e($formOldValues['website']) ?>"<?php endif; ?>>
		<?php if (isset($flash['website'][0])): ?><p><?= e($flash['website'][0]) ?></p><?php endif; ?>
	</div>
	<div>
		<input type="submit" value="Sign up">
	</div>
</form>