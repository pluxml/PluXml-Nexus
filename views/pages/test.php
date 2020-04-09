<p>Hello <?= $name ?></p>

<?php if (isset($flash['success'])): ?>
<div class="alert--primary">
	<?= $flash['success'][0] ?>
</div>
<?php elseif (isset($flash['error'])): ?>
<div class="alert--danger">
	<?= $flash['error'][0] ?>
</div>
<?php endif; ?>

<form action="" method="post">
	<input type="hidden" name="<?= $csrf['nameKey'] ?>" value="<?= $csrf['name'] ?>">
	<input type="hidden" name="<?= $csrf['valueKey'] ?>" value="<?= $csrf['value'] ?>">
	<div <?php if (isset($flash['error'][1])): ?>style="color:red"<?php endif; ?>>
		<label for="name">Enter your name: </label>
		<input type="text" name="name" id="name" <?php if (isset($formOldValues['name'])): ?>value="<?= $formOldValues['name'] ?>"<?php endif; ?> required>
		<?php if (isset($flash['error'][1])): ?><p><?= $flash['error'][1] ?></p><?php endif; ?>
	</div>
	<div  <?php if (isset($flash['error'][2])): ?>style="color:red"<?php endif; ?>>
		<label for="email">Enter your email: </label>
		<input type="email" name="email" id="email" <?php if (isset($formOldValues['email'])): ?>value="<?= $formOldValues['email'] ?>"<?php endif; ?> required>
		<?php if (isset($flash['error'][2])): ?><p><?= $flash['error'][2] ?></p><?php endif; ?>
	</div>
	<div>
		<input type="submit" value="Subscribe!">
	</div>
</form>

<?php echo 'test : '; print_r($result); ?>