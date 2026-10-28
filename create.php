<?php
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/lang.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/validation.php';

require_login();

$errors = [];
$data = [
    'kode_barang' => '', 'nama_barang' => '', 'kategori' => '',
    'jumlah' => '0', 'satuan' => '', 'harga' => '0', 'lokasi_rak' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors['csrf'] = 'err_csrf';
    } else {
        [$data, $errors] = validate_barang($_POST, $pdo);

        if (count($errors) === 0) {
            $stmt = $pdo->prepare(
                'INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah, satuan, harga, lokasi_rak)
                 VALUES (:kode, :nama, :kategori, :jumlah, :satuan, :harga, :lokasi)'
            );
            $stmt->execute([
                ':kode'     => $data['kode_barang'],
                ':nama'     => $data['nama_barang'],
                ':kategori' => $data['kategori'],
                ':jumlah'   => $data['jumlah'],
                ':satuan'   => $data['satuan'],
                ':harga'    => $data['harga'],
                ':lokasi'   => $data['lokasi_rak'] !== '' ? $data['lokasi_rak'] : null,
            ]);

            set_flash('success', 'msg_created');
            redirect('index.php');
        }
    }
}

$pageTitle = 'title_add';
require __DIR__ . '/includes/header.php';
?>

    <section class="card">
        <h2><?= e(t('title_add')) ?></h2>

        <?php if (isset($errors['csrf'])): ?>
            <div class="alert alert-error"><?= e(t($errors['csrf'])) ?></div>
        <?php endif; ?>

        <form method="POST" action="create.php" class="form" novalidate>
            <?php
            $submitLabel = 'btn_save';
            require __DIR__ . '/includes/form_barang.php';
            ?>
        </form>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>