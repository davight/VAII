<?php

/** @var \App\Models\User $account */
/** @var \App\Models\Location[] $allLocations */
/** @var int[] $selectedIds */
/** @var string $title */
/** @var string $action */
/** @var \Framework\Support\LinkGenerator $link */
?>

<h1><?= htmlspecialchars($title) ?></h1>

<form method="post" action="<?= htmlspecialchars($action) ?>" class="report-form">
    <label for="username">Meno</label>
    <input type="text" id="username" name="username" maxlength="50" required
           value="<?= htmlspecialchars($account->username ?? '') ?>">

    <label for="role">Rola</label>
    <select id="role" name="role">
        <option value="user" <?= $account->role !== 'admin' ? 'selected' : '' ?>>Používateľ</option>
        <option value="admin" <?= $account->role === 'admin' ? 'selected' : '' ?>>Správca</option>
    </select>

    <fieldset>
        <legend>Lokality</legend>
        <?php foreach ($allLocations as $loc) { ?>
            <label>
                <input type="checkbox" name="locations[]" value="<?= (int)$loc->id ?>"
                    <?= in_array($loc->id, $selectedIds, true) ? 'checked' : '' ?>>
                <?= htmlspecialchars($loc->name) ?>
            </label>
        <?php } ?>
    </fieldset>

    <div>
        <button type="submit" class="btn">Uložiť</button>
        <a class="btn" href="<?= $link->url('user.index') ?>">Zrušiť</a>
    </div>
</form>
