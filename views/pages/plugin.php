<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page">
        <h2>Plugin <?= e($plugin['name']) ?></h2>
        <p>
            <i class="icon-user"></i>
            <em><a href="<?= e($routerService->urlFor('profile', ['username' => $plugin['author']])) ?>"><?= e($plugin['author']) ?></a></em>
            <i class="icon-link-1"></i>
            <em><a href="<?= e(safe_url($plugin['link'])) ?>"><?= e($plugin['link']) ?></a></em>
            <i class="<?= e($plugin['categoryIcon']) ?>"></i>
            <em><a href="<?= e($routerService->urlFor('category', ['name' => $plugin['categoryName']])) ?>"><?= e($plugin['categoryName']) ?></a></em>
        </p>
        <p><?= e($plugin['description']) ?></p>
        <ul class="unstyled-list">
            <li><i class="icon-tag"></i>Version : <?= e($plugin['versionPlugin']) ?></li>
            <li><i class="icon-leaf"></i>PluXml version required : <?= e($plugin['versionPluxml']) ?></li>
        </ul>
        <a href=" <?= e($plugin['file']) ?>">
            <button><i class="icon-download"></i>Download</button>
        </a>
    </div>
</div>