<?php

/** @var \App\Models\Location $location */
/** @var \App\Models\Sensor[] $sensors */
/** @var \App\Models\User[] $users */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($location->name) ?></h1>

<p>Súradnice: <?= (float)$location->latitude ?>, <?= (float)$location->longitude ?></p>

<h2>Senzory</h2>
<?php if (count($sensors) === 0) { ?>
    <p>Žiadne senzory.</p>
<?php } else { ?>
    <ul>
        <?php foreach ($sensors as $s) { ?>
            <li><a href="<?= $link->url('sensor.detail', ['id' => $s->id]) ?>"><?= htmlspecialchars($s->metric) ?> (<?= htmlspecialchars($s->unit) ?>)</a></li>
        <?php } ?>
    </ul>
<?php } ?>

<h2>Používatelia</h2>
<?php if (count($users) === 0) { ?>
    <p>Žiadni používatelia.</p>
<?php } else { ?>
    <ul>
        <?php foreach ($users as $u) { ?>
            <li><a href="<?= $link->url('user.detail', ['id' => $u->id]) ?>"><?= htmlspecialchars($u->username) ?></a></li>
        <?php } ?>
    </ul>
<?php } ?>

<p>
    <a class="btn" href="<?= $link->url('location.edit', ['id' => $location->id]) ?>">Upraviť</a>
    <a class="btn" href="<?= $link->url('location.index') ?>">Späť</a>
</p>
