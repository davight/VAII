<?php

/** @var \App\Models\User $account */
/** @var \App\Models\Location[] $locations */
/** @var \App\Models\Report[] $reports */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($account->username) ?></h1>

<p>Rola: <?= $account->role === 'admin' ? 'Správca' : 'Používateľ' ?></p>

<h2>Lokality</h2>
<?php if (count($locations) === 0) { ?>
    <p>Žiadne lokality.</p>
<?php } else { ?>
    <ul>
        <?php foreach ($locations as $loc) { ?>
            <li><a href="<?= $link->url('location.detail', ['id' => $loc->id]) ?>"><?= htmlspecialchars($loc->name) ?></a></li>
        <?php } ?>
    </ul>
<?php } ?>

<h2>Reporty</h2>
<?php if (count($reports) === 0) { ?>
    <p>Žiadne reporty.</p>
<?php } else { ?>
    <ul>
        <?php foreach ($reports as $r) { ?>
            <li><a href="<?= $link->url('report.editor', ['id' => $r->id]) ?>"><?= htmlspecialchars($r->name) ?></a></li>
        <?php } ?>
    </ul>
<?php } ?>

<p>
    <a class="btn" href="<?= $link->url('user.edit', ['id' => $account->id]) ?>">Upraviť</a>
    <a class="btn" href="<?= $link->url('user.index') ?>">Späť</a>
</p>
