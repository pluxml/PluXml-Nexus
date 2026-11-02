<div class="text-center">
    <ul class="inline-list">
        <?php foreach ($categories as $category => $value): ?>
            <li>
            <a href="<?= e($routerService->urlFor('category', ['name' => $value['name']])) ?>" <?php if (!empty($activeCategory) && $value['name'] == $activeCategory): ?>class="activeCategory"<?php endif; ?>>
                    <?= e($value['name']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
