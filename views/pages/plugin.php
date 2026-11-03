<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page">
        <h2>Plugin <?= escape_html($plugin['name']) ?></h2>
        <p>
            <i class="icon-user"></i>
            <em><a href="<?= escape_html($routerService->urlFor('profile', ['username' => $plugin['author']])) ?>"><?= escape_html($plugin['author']) ?></a></em>
            <i class="icon-link-1"></i>
            <em><a href="<?= escape_html(safe_url($plugin['link'])) ?>"><?= escape_html($plugin['link']) ?></a></em>
            <i class="<?= escape_html($plugin['categoryIcon']) ?>"></i>
            <em><a href="<?= escape_html($routerService->urlFor('category', ['name' => $plugin['categoryName']])) ?>"><?= escape_html($plugin['categoryName']) ?></a></em>
        </p>
        <p><?= escape_html($plugin['description']) ?></p>
        <ul class="unstyled-list">
            <li><i class="icon-tag"></i>Version : <?= escape_html($plugin['versionPlugin']) ?></li>
            <li><i class="icon-leaf"></i>PluXml version required : <?= escape_html($plugin['versionPluxml']) ?></li>
        </ul>
        <a href=" <?= escape_html($plugin['file']) ?>">
            <button><i class="icon-download"></i>Download</button>
        </a>
    </div>
</div>