<div class="grid">
    <div class="col sml-12 med-4">
        <div class="tab <? if ($activeTab == 1): ?>activeTab<? endif; ?>">
            <a href="<?= $routerService->urlFor('homepage') ?>">PluXml</a>
        </div>
    </div>
    <div class="col sml-12 med-4">
        <div class="tab <? if ($activeTab == 2): ?>activeTab<? endif; ?>">
            <a href="<?= $routerService->urlFor('themes') ?>">Themes</a>
        </div>
    </div>
    <div class="col sml-12 med-4">
        <div class="tab <? if ($activeTab == 3): ?>activeTab<? endif; ?>">
            <a href="<?= $routerService->urlFor('plugins') ?>">Plugins</a>
        </div>
    </div>
</div>