<?php

/** @var \App\Models\User[] $users */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1>Používatelia</h1>

<p><a class="btn" href="<?= $link->url('user.create') ?>">Nový používateľ</a></p>

<?php if (count($users) === 0) { ?>
    <p>Zatiaľ nie sú žiadni používatelia.</p>
<?php } else { ?>
    <table class="data-table">
        <thead>
        <tr><th>#</th><th>Meno</th><th>Rola</th><th>Akcie</th></tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u) { ?>
            <tr>
                <td data-label="#"><?= (int)$u->id ?></td>
                <td data-label="Meno"><?= htmlspecialchars($u->username) ?></td>
                <td data-label="Rola"><?= $u->role === 'admin' ? 'Správca' : 'Používateľ' ?></td>
                <td class="actions" data-label="Akcie">
                    <a class="btn" href="<?= $link->url('user.detail', ['id' => $u->id]) ?>">Detail</a>
                    <a class="btn" href="<?= $link->url('user.edit', ['id' => $u->id]) ?>">Upraviť</a>
                    <form method="post" action="<?= $link->url('user.delete') ?>"
                          onsubmit="return confirm('Naozaj chcete zmazať používateľa?');">
                        <input type="hidden" name="id" value="<?= (int)$u->id ?>">
                        <button type="submit" class="btn btn-danger">Zmazať</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
