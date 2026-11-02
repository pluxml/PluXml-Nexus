<div class="content">
    <div class="page">
        <h2><?= e($h2) ?></h2>
        <p>
            <a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;
            <a href="<?= $routerService->urlFor('boplugins') ?>">Plugins</a>&nbsp;/&nbsp;
            <?= e($plugin['name']) ?>
        </p>
        <h3><?= e($h3) ?></h3>

        <?php if (isset($flash['success'])): ?>
            <div class="alert green">
                <?= e($flash['success'][0]) ?>
            </div>
        <?php elseif (isset($flash['error'])): ?>
            <div class="alert red">
                <?= e($flash['error'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="<?= e($routerService->urlFor('pluginEditAction', ['name' => $plugin['name']])) ?>" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="<?= e($csrf['nameKey']) ?>" value="<?= e($csrf['name']) ?>">
            <input type="hidden" name="<?= e($csrf['valueKey']) ?>" value="<?= e($csrf['value']) ?>">
            <input type="hidden" name="name" value="<?= e($plugin['name']) ?>">
            <input type="hidden" name="author" value="<?= e($_SESSION['user']) ?>">
            <div
                <?php if (isset($flash['description'][0]) or isset($flash['description'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="description">Description*: </label>
                <input type="text" name="description" id="description"
                       <?php if (isset($formOldValues['description'])): ?>value="<?= e($formOldValues['description']) ?>"
                       <?php else: ?>value="<?= e($plugin['description']) ?>"<?php endif; ?>>
                <?php if (isset($flash['description'][0])): ?><p><?= e($flash['description'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['category'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="category">Category: </label>
                <select name="category" id="category" required>
                    <?php foreach ($categories as $category => $value): ?>
                        <option value="<?= e($value['id']) ?>" <?php if ($plugin['category'] == $value['id']):?>selected="selected"<?php endif; ?>><?= e($value['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($flash['category'][0])): ?><p><?= e($flash['category'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['versionPlugin'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="versionPlugin">Version*: </label>
                <input type="text" name="versionPlugin" id="versionPlugin"
                       <?php if (isset($formOldValues['versionPlugin'])): ?>value="<?= e($formOldValues['versionPlugin']) ?>"
                       <?php else: ?>value="<?= e($plugin['versionPlugin']) ?>"<?php endif; ?>>
                <?php if (isset($flash['versionPlugin'][0])): ?><p><?= e($flash['versionPlugin'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['versionPluxml'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="versionPluxml">PluXml version*: </label>
                <input type="text" name="versionPluxml" id="versionPluxml"
                       <?php if (isset($formOldValues['versionPluxml'])): ?>value="<?= e($formOldValues['versionPluxml']) ?>"
                       <?php else: ?>value="<?= e($plugin['versionPluxml']) ?>"<?php endif; ?>>
                <?php if (isset($flash['versionPluxml'][0])): ?><p><?= e($flash['versionPluxml'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['link'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="link">Link: </label>
                <input type="url" name="link" id="link"
                       <?php if (isset($formOldValues['link'])): ?>value="<?= e($formOldValues['link']) ?>"
                       <?php else: ?>value="<?= e($plugin['link']) ?>"<?php endif; ?>>
                <?php if (isset($flash['link'][0])): ?><p><?= e($flash['link'][0]) ?></p><?php endif; ?>
            </div>
            <div <?php if (isset($flash['file'][0])): ?>style="color:red"<?php endif; ?>>
                <label for="file">File (optionnal): </label>
                <input type="file" name="file" id="file">
                <?php if (isset($flash['file'][0])): ?><p><?= e($flash['file'][0]) ?></p><?php endif; ?>
            </div>
            <button type="submit"><i class="icon-floppy"></i>Save</button>&nbsp;
        </form>
        <hr>
        <form action="<?= e($routerService->urlFor('pluginDeleteAction', ['name' => $plugin['name']])) ?>" method="post">
            <input type="hidden" name="<?= e($csrf['nameKey']) ?>" value="<?= e($csrf['name']) ?>">
            <input type="hidden" name="<?= e($csrf['valueKey']) ?>" value="<?= e($csrf['value']) ?>">
            <button type="submit" class="blue"><i class="icon-trash"></i>Delete</button>
        </form>
    </div>
</div>
