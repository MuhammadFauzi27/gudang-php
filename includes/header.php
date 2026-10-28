<?php
$pageTitle = $pageTitle ?? 'app_name';
$hideNav   = $hideNav ?? false;
$flash     = get_flash();
$self      = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION['lang']) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e(t($pageTitle)) ?> | <?= e(t('app_name')) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
        <a href="index.php" class="brand"><?= e(t('app_name')) ?></a>

        <nav class="nav">
            <?php if (!$hideNav && is_logged_in()): ?>
                <a href="index.php" class="<?= $self === 'index.php' ? 'active' : '' ?>"><?= e(t('nav_items')) ?></a>
                <a href="create.php" class="<?= $self === 'create.php' ? 'active' : '' ?>"><?= e(t('nav_add')) ?></a>
            <?php endif; ?>

            <span class="lang-switch">
                <?= e(t('language')) ?>:
                <a href="set_lang.php?lang=id&amp;back=<?= e($self) ?>" class="<?= $_SESSION['lang'] === 'id' ? 'active' : '' ?>">ID</a> |
                <a href="set_lang.php?lang=en&amp;back=<?= e($self) ?>" class="<?= $_SESSION['lang'] === 'en' ? 'active' : '' ?>">EN</a>
            </span>

            <?php if (!$hideNav && is_logged_in()): ?>
                <span class="user"><?= e(t('welcome')) ?>, <?= e($_SESSION['nama']) ?></span>
                <a href="logout.php" class="btn btn-small btn-outline"><?= e(t('nav_logout')) ?></a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="container">
<?php if ($flash): ?>
    <div class="alert alert-<?= e($flash['type']) ?>"><?= e(t($flash['key'])) ?></div>
<?php endif; ?>