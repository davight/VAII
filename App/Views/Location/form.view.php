<?php

/** @var \App\Models\Location $location */
/** @var string $title */
/** @var string $action */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($title) ?></h1>

<form method="post" action="<?= htmlspecialchars($action) ?>" class="report-form">
    <label for="name">Názov</label>
    <input type="text" id="name" name="name" maxlength="100" required
           value="<?= htmlspecialchars($location->name ?? '') ?>">

    <label for="latitude">Zemepisná šírka</label>
    <input type="number" id="latitude" name="latitude" step="any" required value="<?= (float)$location->latitude ?>">

    <label for="longitude">Zemepisná dĺžka</label>
    <input type="number" id="longitude" name="longitude" step="any" required value="<?= (float)$location->longitude ?>">

    <div>
        <button type="submit" class="btn">Uložiť</button>
        <a class="btn" href="<?= $link->url('location.index') ?>">Zrušiť</a>
    </div>
</form>
