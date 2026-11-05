<?php

/** @var \App\Models\Report[] $reports */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1>Moje reporty</h1>

<p><a class="btn" href="<?= $link->url('report.create') ?>">Nový report</a></p>

<?php if (count($reports) === 0) { ?>
    <p>Zatiaľ nemáte žiadne reporty.</p>
<?php } else { ?>
    <table class="data-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Názov</th>
            <th>Rozmery</th>
            <th>Viditeľnosť</th>
            <th>Akcie</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($reports as $report) { ?>
            <tr>
                <td data-label="#"><?= (int)$report->id ?></td>
                <td data-label="Názov"><?= htmlspecialchars($report->name) ?></td>
                <td data-label="Rozmery"><?= (int)$report->width ?> × <?= (int)$report->height ?></td>
                <td data-label="Viditeľnosť"><?= $report->visibility === 'public' ? 'Verejný' : 'Súkromný' ?></td>
                <td class="actions" data-label="Akcie">
                    <a class="btn" href="<?= $link->url('report.editor', ['id' => $report->id]) ?>">Editor</a>
                    <a class="btn" href="<?= $link->url('report.edit', ['id' => $report->id]) ?>">Upraviť</a>
                    <form method="post" action="<?= $link->url('report.delete') ?>"
                          onsubmit="return confirm('Naozaj chcete zmazať report?');">
                        <input type="hidden" name="id" value="<?= (int)$report->id ?>">
                        <button type="submit" class="btn btn-danger">Zmazať</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
