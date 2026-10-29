<?php
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/lang.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/config/database.php';

require_login();

$q = clean_string($_GET['q'] ?? '');

if ($q !== '') {
    $stmt = $pdo->prepare(
            'SELECT * FROM barang WHERE kode_barang LIKE :q_kode OR nama_barang LIKE :q_nama ORDER BY id DESC'
    );
    $like = '%' . $q . '%';
    $stmt->execute([':q_kode' => $like, ':q_nama' => $like]);
} else {
    $stmt = $pdo->query('SELECT * FROM barang ORDER BY id DESC');
}
$items = $stmt->fetchAll();

$stat = $pdo->query(
        'SELECT COUNT(*) AS jenis,
            COALESCE(SUM(jumlah), 0) AS total_stok,
            COALESCE(SUM(jumlah * harga), 0) AS nilai,
            COALESCE(SUM(jumlah < ' . STOK_MINIMUM . '), 0) AS menipis
     FROM barang'
)->fetch();

$pageTitle = 'title_list';
require __DIR__ . '/includes/header.php';
?>

    <section class="stats">
        <div class="stat-card"><span><?= e(t('stat_types')) ?></span><strong><?= e($stat['jenis']) ?></strong></div>
        <div class="stat-card"><span><?= e(t('stat_stock')) ?></span><strong><?= e(number_format((int) $stat['total_stok'], 0, ',', '.')) ?></strong></div>
        <div class="stat-card warn"><span><?= e(t('stat_low')) ?></span><strong><?= e($stat['menipis']) ?></strong></div>
        <div class="stat-card"><span><?= e(t('stat_value')) ?></span><strong><?= e(rupiah($stat['nilai'])) ?></strong></div>
    </section>

    <section class="card">
        <div class="card-head">
            <h2><?= e(t('title_list')) ?></h2>
            <a href="create.php" class="btn btn-primary">+ <?= e(t('nav_add')) ?></a>
        </div>

        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="q" value="<?= e($q) ?>" placeholder="<?= e(t('search_ph')) ?>">
            <button type="submit" class="btn btn-primary"><?= e(t('btn_search')) ?></button>
            <?php if ($q !== ''): ?>
                <a href="index.php" class="btn btn-outline"><?= e(t('btn_reset')) ?></a>
            <?php endif; ?>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th><?= e(t('col_no')) ?></th>
                    <th><?= e(t('col_code')) ?></th>
                    <th><?= e(t('col_name')) ?></th>
                    <th><?= e(t('col_category')) ?></th>
                    <th class="num"><?= e(t('col_qty')) ?></th>
                    <th><?= e(t('col_unit')) ?></th>
                    <th class="num"><?= e(t('col_price')) ?></th>
                    <th><?= e(t('col_location')) ?></th>
                    <th><?= e(t('col_action')) ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($items) === 0): ?>
                    <tr><td colspan="9" class="empty"><?= e(t('empty_data')) ?></td></tr>
                <?php else: ?>
                    <?php foreach ($items as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= e($row['kode_barang']) ?></td>
                            <td><?= e($row['nama_barang']) ?></td>
                            <td><?= e(t('cat_' . $row['kategori'])) ?></td>
                            <td class="num">
                                <?= e($row['jumlah']) ?>
                                <?php if ((int) $row['jumlah'] < STOK_MINIMUM): ?>
                                    <span class="badge badge-warn"><?= e(t('low_badge')) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= e($row['satuan']) ?></td>
                            <td class="num"><?= e(rupiah($row['harga'])) ?></td>
                            <td><?= e($row['lokasi_rak']) ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?= (int) $row['id'] ?>" class="btn btn-small btn-edit"><?= e(t('btn_edit')) ?></a>
                                <form method="POST" action="delete.php" class="inline-form"
                                      onsubmit="return confirm('<?= e(t('confirm_delete')) ?>');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                                    <button type="submit" class="btn btn-small btn-danger"><?= e(t('btn_delete')) ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>