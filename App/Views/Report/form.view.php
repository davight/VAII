<?php

/** @var \App\Models\Report $report */
/** @var string $title */
/** @var string $action */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($title) ?></h1>

<form method="post" action="<?= htmlspecialchars($action) ?>" class="report-form">
    <label for="name">Názov</label>
    <input type="text" id="name" name="name" maxlength="100" required
           value="<?= htmlspecialchars($report->name ?? '') ?>">

    <label for="width">Šírka (px)</label>
    <input type="number" id="width" name="width" min="1" required value="<?= (int)$report->width ?>">

    <label for="height">Výška (px)</label>
    <input type="number" id="height" name="height" min="1" required value="<?= (int)$report->height ?>">

    <label for="visibility">Viditeľnosť</label>
    <select id="visibility" name="visibility">
        <option value="private" <?= $report->visibility !== 'public' ? 'selected' : '' ?>>Súkromný</option>
        <option value="public" <?= $report->visibility === 'public' ? 'selected' : '' ?>>Verejný</option>
    </select>

    <div>
        <button type="submit" class="btn">Uložiť</button>
        <a class="btn" href="<?= $link->url('report.index') ?>">Zrušiť</a>
    </div>
</form>
