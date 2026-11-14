<?php

/** @var \App\Models\Sensor[] $sensors */
/** @var \App\Models\Location[] $locations indexed by id */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1>Senzory</h1>

<p><a class="btn" href="<?= $link->url('sensor.create') ?>">Nový senzor</a></p>

<?php if (count($sensors) === 0) { ?>
    <p>Zatiaľ nie sú žiadne senzory.</p>
<?php } else { ?>
    <table class="data-table">
        <thead>
        <tr><th>#</th><th>Lokalita</th><th>Veličina</th><th>Jednotka</th><th>Akcie</th></tr>
        </thead>
        <tbody>
        <?php foreach ($sensors as $s) { ?>
            <tr>
                <td data-label="#"><?= (int)$s->id ?></td>
                <td data-label="Lokalita"><?= isset($locations[$s->locationId]) ? htmlspecialchars($locations[$s->locationId]->name) : '-' ?></td>
                <td data-label="Veličina"><?= htmlspecialchars($s->metric) ?></td>
                <td data-label="Jednotka"><?= htmlspecialchars($s->unit) ?></td>
                <td class="actions" data-label="Akcie">
                    <a class="btn" href="<?= $link->url('sensor.detail', ['id' => $s->id]) ?>">Detail</a>
                    <a class="btn" href="<?= $link->url('sensor.edit', ['id' => $s->id]) ?>">Upraviť</a>
                    <form method="post" action="<?= $link->url('sensor.delete') ?>"
                          onsubmit="return confirm('Naozaj chcete zmazať senzor?');">
                        <input type="hidden" name="id" value="<?= (int)$s->id ?>">
                        <button type="submit" class="btn btn-danger">Zmazať</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
