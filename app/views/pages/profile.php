<h1>Profile <?= $username ?></h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et leo
	et ex congue blandit. Sed vel eleifend lorem. Proin laoreet commodo
	libero non dictum. Vestibulum at bibendum nunc, a ullamcorper turpis.
	Vestibulum sed libero lacus. Nulla urna lectus, viverra id arcu ac,
	tempus aliquet elit. Donec aliquam et nisl eu rhoncus. Maecenas semper
	urna mauris, a aliquam orci sagittis vel. Cras neque neque, porta a
	sagittis ac, sodales id nisl. Interdum et malesuada fames ac ante ipsum
	primis in faucibus. Pellentesque habitant morbi tristique senectus et
	netus et malesuada fames ac turpis egestas. Nunc in erat augue.
	Vestibulum a ipsum eu massa finibus fringilla.</p>
<ul>
	<li>
		<?= $website ?>
	</li>
</ul>

<h2>Plugins :</h2>
<ul>
	<li><a href="<?= $routerService->urlFor('plugin', ['name' => $plugins[0]['name']]) ?>"><?= $plugins[0]['name'] ?></a></li>
	<li><a href="<?= $routerService->urlFor('plugin', ['name' => $plugins[1]['name']]) ?>"><?= $plugins[1]['name'] ?></a></li>
</ul>