<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <h2><?= $username ?></h2>
        <ul>
            <li>
                <a href="<?= $website ?>" target="_blank">Website: <?= $website ?></a></li>
            </li>
        </ul>

        <h3>Plugins :</h3>
        <?php if (!empty($plugins)): ?>
            <?php include 'tags/pluginsList.php'; ?>
        <?php else: ?>
            <div class="alert orange">No plugins found</div>
        <?php endif; ?>
    </div>
</div>