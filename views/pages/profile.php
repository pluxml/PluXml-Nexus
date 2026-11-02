<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <h2><?= htmlspecialchars($username) ?></h2>
        <ul>
            <li>
                <?php if (preg_match('#^https?://#i', (string) $website)): ?>
                Website: <a href="<?= htmlspecialchars($website) ?>" target="_blank" rel="noopener noreferrer nofollow"><?= htmlspecialchars($website) ?></a></li>
                <?php else: ?>
                Website: <?= htmlspecialchars((string) $website) ?></li>
                <?php endif; ?>
            </li>
        </ul>

        <h3>Plugins:</h3>
        <?php if (!empty($plugins)): ?>
            <?php include 'tags/pluginsList.php'; ?>
        <?php else: ?>
            <div class="alert orange">No plugins found</div>
        <?php endif; ?>
    </div>
</div>