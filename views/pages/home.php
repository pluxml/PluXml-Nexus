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
        <h2>PluXml <?= $pluxmlCurrentVersion ?></h2>
        <p><a href="https://www.pluxml.org/download/pluxml-latest.zip"
              title="Download PluXml"><button><i class="icon-download"></i>Download</button></a></p>
        <p><small><a href="https://www.pluxml.org/download/changelog.txt">Changelog</a> - <a
                        href="https://github.com/pluxml/PluXml/releases" target="_blank">Previous versions</a></small></p>
        <h2>Installation</h2>
        <p>Although PluXml is very easy to install, documentation is <a
                    href="https://wiki.pluxml.org/installer/installation/">available here</a> <em>(french)</em>.</p>
    </div>
</div>
