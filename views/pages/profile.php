<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <h2><?= escape_html($username) ?></h2>
        <?php if (!empty($website)): ?>
        <ul>
            <li>
                <?php if (safe_url($website) !== ''): ?>
                Website: <a href="<?= escape_html(safe_url($website)) ?>" target="_blank" rel="noopener noreferrer nofollow"><?= escape_html($website) ?></a>
                <?php else: ?>
                Website: <?= escape_html($website) ?>
                <?php endif; ?>
            </li>
        </ul>
        <?php endif; ?>

        <h3>Plugins:</h3>
        <?php if (!empty($plugins)): ?>
            <?php include 'tags/pluginsList.php'; ?>
        <?php else: ?>
            <div class="alert orange">No plugins found</div>
        <?php endif; ?>
    </div>
</div>