<?php
function field_error(array $errors, string $field): string
{
    return isset($errors[$field])
        ? '<small class="field-error">' . e(t($errors[$field])) . '</small>'
        : '';
}
?>
<?= csrf_field() ?>

<div class="form-row">
    <div class="form-group">
        <label for="kode_barang"><?= e(t('col_code')) ?></label>
        <input type="text" id="kode_barang" name="kode_barang" maxlength="20"
               value="<?= e($data['kode_barang']) ?>" placeholder="BRG-006">
        <?= field_error($errors, 'kode_barang') ?>
    </div>

    <div class="form-group">
        <label for="nama_barang"><?= e(t('col_name')) ?></label>
        <input type="text" id="nama_barang" name="nama_barang" maxlength="100"
               value="<?= e($data['nama_barang']) ?>">
        <?= field_error($errors, 'nama_barang') ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="kategori"><?= e(t('col_category')) ?></label>
        <select id="kategori" name="kategori">
            <option value=""><?= e(t('choose_category')) ?></option>
            <?php foreach (KATEGORI_LIST as $kat): ?>
                <option value="<?= e($kat) ?>" <?= $data['kategori'] === $kat ? 'selected' : '' ?>>
                    <?= e(t('cat_' . $kat)) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?= field_error($errors, 'kategori') ?>
    </div>

    <div class="form-group">
        <label for="satuan"><?= e(t('col_unit')) ?></label>
        <select id="satuan" name="satuan">
            <option value=""><?= e(t('choose_unit')) ?></option>
            <?php foreach (SATUAN_LIST as $sat): ?>
                <option value="<?= e($sat) ?>" <?= $data['satuan'] === $sat ? 'selected' : '' ?>>
                    <?= e($sat) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?= field_error($errors, 'satuan') ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="jumlah"><?= e(t('col_qty')) ?></label>
        <input type="number" id="jumlah" name="jumlah" min="0" step="1"
               value="<?= e($data['jumlah']) ?>">
        <?= field_error($errors, 'jumlah') ?>
    </div>

    <div class="form-group">
        <label for="harga"><?= e(t('col_price')) ?> (Rp)</label>
        <input type="number" id="harga" name="harga" min="0" step="0.01"
               value="<?= e($data['harga']) ?>">
        <?= field_error($errors, 'harga') ?>
    </div>

    <div class="form-group">
        <label for="lokasi_rak"><?= e(t('col_location')) ?></label>
        <input type="text" id="lokasi_rak" name="lokasi_rak" maxlength="30"
               value="<?= e($data['lokasi_rak']) ?>" placeholder="A-01">
        <?= field_error($errors, 'lokasi_rak') ?>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary"><?= e(t($submitLabel)) ?></button>
    <a href="index.php" class="btn btn-outline"><?= e(t('btn_cancel')) ?></a>
</div>