<?php

/** @var \App\Models\Location[] $locations */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1>Lokality</h1>

<p><a class="btn" href="<?= $link->url('location.create') ?>">Nová lokalita</a></p>

<?php if (count($locations) === 0) { ?>
    <p>Zatiaľ nie sú žiadne lokality.</p>
<?php } else { ?>
    <table class="data-table">
        <thead>
        <tr><th>#</th><th>Názov</th><th>Súradnice</th><th>Akcie</th></tr>
        </thead>
        <tbody>
        <?php foreach ($locations as $loc) { ?>
            <tr>
                <td data-label="#"><?= (int)$loc->id ?></td>
                <td data-label="Názov"><?= htmlspecialchars($loc->name) ?></td>
                <td data-label="Súradnice"><?= (float)$loc->latitude ?>, <?= (float)$loc->longitude ?></td>
                <td class="actions" data-label="Akcie">
                    <a class="btn" href="<?= $link->url('location.detail', ['id' => $loc->id]) ?>">Detail</a>
                    <a class="btn" href="<?= $link->url('location.edit', ['id' => $loc->id]) ?>">Upraviť</a>
                    <form method="post" action="<?= $link->url('location.delete') ?>"
                          onsubmit="return confirm('Zmazaním lokality sa zmažú aj jej senzory. Pokračovať?');">
                        <input type="hidden" name="id" value="<?= (int)$loc->id ?>">
                        <button type="submit" class="btn btn-danger">Zmazať</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
