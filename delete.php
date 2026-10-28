<?php
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/lang.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/config/database.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid()) {
    set_flash('error', 'err_csrf');
    redirect('index.php');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($id === false || $id === null) {
    set_flash('error', 'err_not_found');
    redirect('index.php');
}

$stmt = $pdo->prepare('DELETE FROM barang WHERE id = ?');
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    set_flash('success', 'msg_deleted');
} else {
    set_flash('error', 'err_not_found');
}

redirect('index.php');