<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="/css/knacss.css" media="all">
</head>

<body>
<div class="website">
  <header class="header" role="banner">
    <nav class="navigation" role="navigation">
      <ul class="navigation-list">
        <li class="navigation-item"><a class="navigation-link" href="/">home</a></li>
        <li class="navigation-item"><a class="navigation-link" href="/plugins">plugins</a></li>
        <li class="navigation-item"><a class="navigation-link" href="/themes">themes</a></li>
        <li class="navigation-item"><a class="navigation-link" href="/profiles">profiles</a></li>
      </ul>
    </nav>
  </header>
  
  <main id="main" role="main" class="main">
    <?= $content ?>
  </main>
</div>
</body>

</html>