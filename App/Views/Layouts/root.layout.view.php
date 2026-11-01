<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= App\Configuration::APP_NAME ?></title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $link->asset('favicons/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $link->asset('favicons/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $link->asset('favicons/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= $link->asset('favicons/site.webmanifest') ?>">
    <link rel="shortcut icon" href="<?= $link->asset('favicons/favicon.ico') ?>">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>

<header>
    <div class="header-inner">

        <a class="brand" href="<?= $link->url('home.index') ?>">
            <span class="logo-box" aria-hidden="true">
                <img src="<?= $link->asset('images/logo.png') ?>" alt="Logo">
            </span>
            <span class="web-name"><?= App\Configuration::APP_NAME ?></span>
        </a>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-btn" aria-label="Otvoriť menu">☰</label>

        <nav class="main-nav" aria-label="Hlavná navigácia">
            <ul>
                <li><a href="<?= $link->url('home.index') ?>">Galéria</a></li>
                <li><a href="<?= $link->url('report.editor') ?>">Editor</a></li>
            </ul>
        </nav>

        <div class="auth">
            <?php if ($user->isLoggedIn()) { ?>
                <div class="user">
                    <span><?= $user->getName() ?></span>
                    <span class="avatar" aria-hidden="true"></span>
                </div>
                <a href="<?= $link->url('auth.logout') ?>" class="btn">Odhlásiť sa</a>
            <?php } else { ?>
                <a href="<?= App\Configuration::LOGIN_URL ?>" class="btn">Prihlásiť sa</a>
                <a href="#" class="btn">Registrovať sa</a>
            <?php } ?>
        </div>

    </div>
</header>

<main>
    <?= $contentHTML ?>
</main>

<footer>
    <p>© <?= date('Y') ?> <?= App\Configuration::APP_NAME ?> - semestrálny projekt</p>
</footer>

</body>
</html>
