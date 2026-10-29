<?php
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/lang.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/validation.php';

require_login();

$id = filter_var($_GET['id'] ?? ($_POST['id'] ?? null), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    set_flash('error', 'err_not_found');
    redirect('index.php');
}

$stmt = $pdo->prepare('SELECT * FROM barang WHERE id = ?');
$stmt->execute([$id]);
$existing = $stmt->fetch();

if (!$existing) {
    set_flash('error', 'err_not_found');
    redirect('index.php');
}

$errors = [];
$data = [
    'kode_barang' => $existing['kode_barang'],
    'nama_barang' => $existing['nama_barang'],
    'kategori'    => $existing['kategori'],
    'jumlah'      => $existing['jumlah'],
    'satuan'      => $existing['satuan'],
    'harga'       => $existing['harga'],
    'lokasi_rak'  => (string) $existing['lokasi_rak'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors['csrf'] = 'err_csrf';
    } else {
        [$data, $errors] = validate_barang($_POST, $pdo, $id);

        if (count($errors) === 0) {
            $stmt = $pdo->prepare(
                'UPDATE barang SET kode_barang = :kode, nama_barang = :nama, kategori = :kategori,
                        jumlah = :jumlah, satuan = :satuan, harga = :harga, lokasi_rak = :lokasi
                 WHERE id = :id'
            );
            $stmt->execute([
                ':kode'     => $data['kode_barang'],
                ':nama'     => $data['nama_barang'],
                ':kategori' => $data['kategori'],
                ':jumlah'   => $data['jumlah'],
                ':satuan'   => $data['satuan'],
                ':harga'    => $data['harga'],
                ':lokasi'   => $data['lokasi_rak'] !== '' ? $data['lokasi_rak'] : null,
                ':id'       => $id,
            ]);

            set_flash('success', 'msg_updated');
            redirect('index.php');
        }
    }
}

$pageTitle = 'title_edit';
require __DIR__ . '/includes/header.php';
?>

    <section class="card">
        <h2><?= e(t('title_edit')) ?></h2>

        <?php if (isset($errors['csrf'])): ?>
            <div class="alert alert-error"><?= e(t($errors['csrf'])) ?></div>
        <?php endif; ?>

        <form method="POST" action="edit.php?id=<?= (int) $id ?>" class="form" novalidate>
            <input type="hidden" name="id" value="<?= (int) $id ?>">
            <?php
            $submitLabel = 'btn_update';
            require __DIR__ . '/includes/form_barang.php';
            ?>
        </form>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>