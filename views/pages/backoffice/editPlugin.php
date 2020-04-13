<h1><?= $h1 ?></h1>
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

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et leo et ex congue blandit. Sed vel eleifend lorem. Proin laoreet commodo libero non dictum. Vestibulum at bibendum nunc, a ullamcorper turpis. Vestibulum sed libero lacus. Nulla urna lectus, viverra id arcu ac, tempus aliquet elit. Donec aliquam et nisl eu rhoncus. Maecenas semper urna mauris, a aliquam orci sagittis vel. Cras neque neque, porta a sagittis ac, sodales id nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc in erat augue. Vestibulum a ipsum eu massa finibus fringilla.</p>

<p><a href="#" class="button">Upload new file</a></p>

<form action="<?= $routerService->urlFor('pluginAction') ?><?= '/'.$name ?>" method="post">
	<input type="hidden" name="<?= $csrf['nameKey'] ?>" value="<?= $csrf['name'] ?>">
	<input type="hidden" name="<?= $csrf['valueKey'] ?>" value="<?= $csrf['value'] ?>">
	<div <?php if (isset($flash['description'][0]) or isset($flash['versionPlugin'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="description">Description*: </label>
		<input type="description" name="description" id="description" <?php if (isset($formOldValues['description'])): ?>value="<?= $formOldValues['description'] ?>"<?php else: ?>value="<?= $description ?>"<?php endif; ?>>
		<?php if (isset($flash['description'][0])): ?><p><?= $flash['description'][0] ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['versionPlugin'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="versionPlugin">Version*: </label>
		<input type="versionPlugin" name="versionPlugin" id="versionPlugin" <?php if (isset($formOldValues['versionPlugin'])): ?>value="<?= $formOldValues['versionPlugin'] ?>"<?php else: ?>value="<?= $versionPlugin ?>"<?php endif; ?>>
		<?php if (isset($flash['versionPlugin'][0])): ?><p><?= $flash['versionPlugin'][0] ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['versionPluxml'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="versionPluxml">PluXml version*: </label>
		<input type="versionPluxml" name="versionPluxml" id="versionPluxml" <?php if (isset($formOldValues['versionPluxml'])): ?>value="<?= $formOldValues['versionPluxml'] ?>"<?php else: ?>value="<?= $versionPluxml ?>"<?php endif; ?>>
		<?php if (isset($flash['versionPluxml'][0])): ?><p><?= $flash['versionPluxml'][0] ?></p><?php endif; ?>
	</div>
	<div <?php if (isset($flash['link'][0])): ?>style="color:red"<?php endif; ?>>
		<label for="link">Link: </label>
		<input type="url" name="link" id="link" <?php if (isset($formOldValues['link'])): ?>value="<?= $formOldValues['link'] ?>"<?php else: ?>value="<?= $link ?>"<?php endif; ?>>
		<?php if (isset($flash['link'][0])): ?><p><?= $flash['link'][0] ?></p><?php endif; ?>
	</div>
	<div>
		<p><input type="submit" class="blue" value="Save">&nbsp;<a href="#" class="button red">Delete</a></p>
	</div>
</form>