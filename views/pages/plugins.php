<div class="content">
    <?php require_once 'tags/tabs.php' ?>

    <div class="page grid">
        <? include 'tags/pluginsCategories.php'; ?>

        <? if (!empty($plugins)): ?>
            <? include 'tags/pluginsList.php'; ?>
        <? else: ?>
            <div class="alert orange">No plugins found</div>
        <? endif; ?>
    </div>
</div>