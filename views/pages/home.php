<?php if (isset($flash['success'])): ?>
    <div class="alert green">
        <?= $flash['success'][0] ?>
    </div>
<?php elseif (isset($flash['error'])): ?>
    <div class="alert red">
        <?= $flash['error'][0] ?>
    </div>
<?php endif; ?>

<div class="content">
    <?php require_once 'tags/tabs.php' ?>
    <div class="page text-center">
        <h2>Télécharger PluXml</h2>
        <p><a class="button blue" href="https://www.pluxml.org/download/pluxml-latest.zip"
              title="Télécharger PluXml">PluXml</a></p>
        <p><small><a href="https://www.pluxml.org/download/changelog.txt">Changelog</a> - <a
                        href="https://github.com/pluxml/PluXml/releases" target="_blank">Versions
                    précédentes</a></small></p>
        <h2>Installation</h2>
        <p>Bien que PluXml soit très simple à installer, une documentation est <a
                    href="https://wiki.pluxml.org/installer/installation/">accessible ici</a>.</p>
    </div>
</div>
