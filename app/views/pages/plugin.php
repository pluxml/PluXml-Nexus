<h1>Plugin <?= $name ?></h1>
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
	<li><?= $name ?></li>
	<li><?= $description ?></li>
	<li><?= $versionPlugin ?></li>
	<li><?= $versionPluxml ?></li>
	<li><a href="<?= $routerService->urlFor('profiles') ?><?= $author ?>"><?= $author ?></a></li>
	<li><?= $link ?></li>
</ul>