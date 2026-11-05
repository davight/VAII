<?php

/** @var \App\Models\Report[] $reports */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1>Galéria</h1>

<?php if (count($reports) === 0) { ?>
    <p>Zatiaľ nie sú žiadne verejné reporty.</p>
<?php } else { ?>
    <section class="gallery" aria-label="Verejné reporty">
        <?php foreach ($reports as $report) { ?>
            <article class="gallery-card">
                <h2><?= htmlspecialchars($report->name) ?></h2>
                <p><?= (int)$report->width ?> × <?= (int)$report->height ?></p>
            </article>
        <?php } ?>
    </section>
<?php } ?>
