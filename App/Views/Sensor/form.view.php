<?php

/** @var \App\Models\Sensor $sensor */
/** @var \App\Models\Location[] $locations */
/** @var string $title */
/** @var string $action */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($title) ?></h1>

<form method="post" action="<?= htmlspecialchars($action) ?>" class="report-form">
    <label for="locationId">Lokalita</label>
    <select id="locationId" name="locationId" required>
        <?php foreach ($locations as $loc) { ?>
            <option value="<?= (int)$loc->id ?>" <?= $sensor->locationId === $loc->id ? 'selected' : '' ?>>
                <?= htmlspecialchars($loc->name) ?>
            </option>
        <?php } ?>
    </select>

    <label for="metric">Veličina</label>
    <input type="text" id="metric" name="metric" maxlength="50" required
           value="<?= htmlspecialchars($sensor->metric ?? '') ?>">

    <label for="unit">Jednotka</label>
    <input type="text" id="unit" name="unit" maxlength="20" required
           value="<?= htmlspecialchars($sensor->unit ?? '') ?>">

    <div>
        <button type="submit" class="btn">Uložiť</button>
        <a class="btn" href="<?= $link->url('sensor.index') ?>">Zrušiť</a>
    </div>
</form>
