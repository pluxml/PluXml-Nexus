<div class="content">
    <div class="page">
        <h2><?= $h2 ?></h2>
        <p><a href="<?= $routerService->urlFor('backoffice') ?>">Backoffice</a>&nbsp;/&nbsp;Plugins</p>
        <h3><?= $h3 ?></h3>

        <?php if (isset($flash['success'])): ?>
            <div class="alert green">
                <?= $flash['success'][0] ?>
            </div>
        <?php elseif (isset($flash['error'])): ?>
            <div class="alert red">
                <?= $flash['error'][0] ?>
            </div>
        <?php endif; ?>

        <div class="scrollable-table">
            <?php if (!empty($profiles)): ?>
                <table>
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Had plugins</th>
                        <th>Validated</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($profiles as $key => $profile): ?>
                        <tr>
                            <td>
                                <a href="<?= $routerService->urlFor('profile', ['username' => $profile['username']]) ?>"><?= $profile['username'] ?></a>
                            </td>
                            <td><?= $profile['email'] ?></td>
                            <td><?= $profile['website'] ?></td>
                            <td><?= $profile['website'] ?></td>
                            <td>
                                <? if($profile['tokenexpire'] == '0000-00-00 00:00:00'): ?>
                                    Yes
                                <? else: ?>
                                    No (<?= $profile['tokenexpire'] ?>)
                                <? endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No users found</p>
            <?php endif; ?>
        </div>
    </div>
</div>
