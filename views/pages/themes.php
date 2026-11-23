<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <?php if (!empty($themes)): ?>
            <?php require 'tags/themesList.php' ?>
        <?php else: ?>
            <div class="alert orange">No themes found</div>
        <?php endif; ?>
    </div>
</div>
