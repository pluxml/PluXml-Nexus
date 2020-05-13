<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="apple-touch-icon" sizes="57x57"
          href="/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
          href="/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
          href="/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
          href="/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
          href="/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage"
          content="/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://www.pluxml.org/assets/plucss-min.css"
          rel="stylesheet">
    <link href="https://www.pluxml.org/assets/plx-common-min.css"
          rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
</head>

<body>

<nav class="plx-nav">
    <div class="container">
        <div class="grid">
            <div class="col sml-12 med-3">
                <ul class="menu text-center">
                    <li class="logo"><a href="https://www.pluxml.org" title="PluXml"><img
                                    class="float-left" src="/img/favicon/favicon-32x32.png"><strong>PluXml.org</strong></a>
                    </li>
                </ul>
            </div>
            <div class="col sml-12 med-9 lrg-6">
                <ul class="menu text-center">
                    <li><a href="https://wiki.pluxml.org" title="Documentation">Documentation</a></li>
                    <li><a href="https://ressources.pluxml.org" title="Ressources">Ressources</a></li>
                    <li><a href="https://forum.pluxml.org" title="Forum">Forum</a></li>
                    <li><a href="https://www.pluxml.org/blog" title="Blog">Blog</a></li>
                </ul>
            </div>
            <div class="col sml-hide med-hide lrg-3 lrg-show">
                <ul class="menu text-right">
                    <li><a href="http://plucss.pluxml.org/" title="PluCSS">PluCSS</a></li>
                    <li><a href="http://visualwizard.pluxml.org/"
                           title="Visual Wizard">Visual Wizard</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="header" role="banner">
    <div class="container">
        <div class="grid">
            <div class="col sml-12 med-8">
                <nav class="nav" role="navigation">
                    <ul class="inline-list">
                        <li><a href="<?= $routerService->urlFor('homepage') ?>">Home</a></li>
                        <li><a href="<?= $routerService->urlFor('plugins') ?>">Plugins</a></li>
                        <li><a href="<?= $routerService->urlFor('themes') ?>">Themes</a></li>
                        <li><a href="<?= $routerService->urlFor('profiles') ?>">Profiles</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col sml-12 med-4">
                <nav class="nav text-right" role="navigation">
                    <ul class="inline-list">
                        <?php if (!$isLogged): ?>
                            <li><a href="<?= $routerService->urlFor('signup') ?>">Sign up</a></li>
                            <li><a href="<?= $routerService->urlFor('auth') ?>">Log in</a></li>
                        <?php else: ?>
                            <li><a href="<?= $routerService->urlFor('backoffice') ?>"><?= $_SESSION['user'] ?></a></li>
                            <li><a href="<?= $routerService->urlFor('logoutAction') ?>">Log out</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<main id="main" role="main" class="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>

</body>

</html>