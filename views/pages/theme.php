<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page">
        <h2>Theme <?= escape_html($name) ?></h2>
        <p>
            <i class="icon-user"></i>
            <em><a href="<?= escape_html($routerService->urlFor('profile', ['username' => $author])) ?>"><?= escape_html($author) ?></a></em>
            <?php if (!empty($link)): ?>
                <i class="icon-link-1"></i>
                <em><a href="<?= escape_html(safe_url($link)) ?>"><?= escape_html($link) ?></a></em>
            <?php endif; ?>
        </p>
        <?php if (!empty($image)): ?>
            <p><img src="<?= escape_html($image) ?>" alt="<?= escape_html($name) ?>" class="theme-image-detail"></p>
        <?php endif; ?>
        <?php if (!empty($description)): ?>
            <p><?= escape_html($description) ?></p>
        <?php endif; ?>
        <ul class="unstyled-list">
            <?php if (!empty($versionTheme)): ?>
                <li><i class="icon-tag"></i>Version : <?= escape_html($versionTheme) ?></li>
            <?php endif; ?>
            <?php if (!empty($versionPluxml)): ?>
                <li><i class="icon-leaf"></i>PluXml version required : <?= escape_html($versionPluxml) ?></li>
            <?php endif; ?>
        </ul>
        <a href="<?= escape_html($file) ?>">
            <button><i class="icon-download"></i>Download</button>
        </a>
    </div>
</div>