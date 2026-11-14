<?php

/** @var \App\Models\Sensor $sensor */
/** @var \App\Models\Location|null $location */
/** @var \App\Models\SensorData[] $data */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($sensor->metric) ?> (<?= htmlspecialchars($sensor->unit) ?>)</h1>

<p>Lokalita:
    <?php if ($location !== null) { ?>
        <a href="<?= $link->url('location.detail', ['id' => $location->id]) ?>"><?= htmlspecialchars($location->name) ?></a>
    <?php } else { ?>-<?php } ?>
</p>

<h2>Namerané hodnoty</h2>

<form method="post" action="<?= $link->url('sensor.addData', ['id' => $sensor->id]) ?>" class="report-form">
    <label for="value">Hodnota</label>
    <input type="number" id="value" name="value" step="any" required>

    <label for="measuredAt">Čas (voliteľné)</label>
    <input type="datetime-local" id="measuredAt" name="measuredAt">

    <div><button type="submit" class="btn">Pridať hodnotu</button></div>
</form>

<?php if (count($data) === 0) { ?>
    <p>Zatiaľ žiadne hodnoty.</p>
<?php } else { ?>
    <table class="data-table">
        <thead>
        <tr><th>Čas</th><th>Hodnota</th><th>Akcie</th></tr>
        </thead>
        <tbody>
        <?php foreach ($data as $d) { ?>
            <tr>
                <td data-label="Čas"><?= htmlspecialchars($d->measuredAt) ?></td>
                <td data-label="Hodnota"><?= (float)$d->value ?> <?= htmlspecialchars($sensor->unit) ?></td>
                <td class="actions" data-label="Akcie">
                    <form method="post" action="<?= $link->url('sensor.deleteData', ['id' => $sensor->id]) ?>"
                          onsubmit="return confirm('Zmazať hodnotu?');">
                        <input type="hidden" name="dataId" value="<?= (int)$d->id ?>">
                        <button type="submit" class="btn btn-danger">Zmazať</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>

<p>
    <a class="btn" href="<?= $link->url('sensor.edit', ['id' => $sensor->id]) ?>">Upraviť</a>
    <a class="btn" href="<?= $link->url('sensor.index') ?>">Späť</a>
</p>
