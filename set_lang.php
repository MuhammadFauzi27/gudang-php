<?php
require __DIR__ . '/includes/helpers.php';

$lang = $_GET['lang'] ?? 'id';

switch ($lang) {
    case 'id':
    case 'en':
        $_SESSION['lang'] = $lang;
        break;
    default:
        $_SESSION['lang'] = 'id';
}

// Whitelist halaman tujuan (cegah open redirect)
$allowed = ['index.php', 'create.php', 'edit.php', 'login.php'];
$back    = basename($_GET['back'] ?? 'index.php');

// edit.php butuh id, jadi kembali ke daftar saja
if ($back === 'edit.php' || !in_array($back, $allowed, true)) {
    $back = 'index.php';
}

redirect($back);