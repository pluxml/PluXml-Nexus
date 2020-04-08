<h1>Auth</h1>

<?php if (isset($flash['success'])): ?>
<div class="alert green">
	<?= $flash['success'][0] ?>
</div>
<?php elseif (isset($flash['error'])): ?>
<div class="alert red">
	<?= $flash['error'][0] ?>
</div>
<?php endif; ?>

<form action="<?= $routerService->urlFor('loginAction') ?>" method="post">
	<input type="hidden" name="<?= $csrf['nameKey'] ?>" value="<?= $csrf['name'] ?>">
	<input type="hidden" name="<?= $csrf['valueKey'] ?>" value="<?= $csrf['value'] ?>">
	<div <?php if (isset($flash['error'][1])): ?>style="color:red"<?php endif; ?>>
		<label for="username">Username: </label>
		<input type="text" name="username" id="username" <?php if (isset($formOldValues['username'])): ?>value="<?= $formOldValues['username'] ?>"<?php endif; ?> required>
		<?php if (isset($flash['error'][1])): ?><p><?= $flash['error'][1] ?></p><?php endif; ?>
	</div>
	<div  <?php if (isset($flash['error'][2])): ?>style="color:red"<?php endif; ?>>
		<label for="password">Password: </label>
		<input type="password" name="password" id="password" required>
		<?php if (isset($flash['error'][2])): ?><p><?= $flash['error'][2] ?></p><?php endif; ?>
	</div>
	<div>
		<input type="submit" value="Log in">
	</div>
</form>