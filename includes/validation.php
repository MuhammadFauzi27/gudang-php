<?php
function validate_barang(array $input, PDO $pdo, int $ignoreId = 0): array
{
    $errors = [];

    // Sanitasi
    $data = [
        'kode_barang' => strtoupper(clean_string($input['kode_barang'] ?? '')),
        'nama_barang' => clean_string($input['nama_barang'] ?? ''),
        'kategori'    => clean_string($input['kategori'] ?? ''),
        'jumlah'      => clean_string($input['jumlah'] ?? ''),
        'satuan'      => clean_string($input['satuan'] ?? ''),
        'harga'       => clean_string($input['harga'] ?? ''),
        'lokasi_rak'  => clean_string($input['lokasi_rak'] ?? ''),
    ];

    // Kode barang
    if ($data['kode_barang'] === '') {
        $errors['kode_barang'] = 'err_code_required';
    } elseif (!preg_match('/^[A-Z0-9-]{1,20}$/', $data['kode_barang'])) {
        $errors['kode_barang'] = 'err_code_format';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM barang WHERE kode_barang = ? AND id <> ?');
        $stmt->execute([$data['kode_barang'], $ignoreId]);
        if ($stmt->fetch()) {
            $errors['kode_barang'] = 'err_code_exists';
        }
    }

    // Nama barang
    if ($data['nama_barang'] === '') {
        $errors['nama_barang'] = 'err_name_required';
    } elseif (mb_strlen($data['nama_barang']) > 100) {
        $errors['nama_barang'] = 'err_name_length';
    }

    // Kategori
    switch ($data['kategori']) {
        case 'elektronik':
        case 'makanan':
        case 'kemasan':
        case 'kebersihan':
        case 'lainnya':
            break; // valid
        default:
            $errors['kategori'] = 'err_category_invalid';
    }

    // Jumlah
    $qty = filter_var($data['jumlah'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
    if ($qty === false) {
        $errors['jumlah'] = 'err_qty_invalid';
    } else {
        $data['jumlah'] = $qty;
    }

    // Satuan
    if (!in_array($data['satuan'], SATUAN_LIST, true)) {
        $errors['satuan'] = 'err_unit_invalid';
    }

    // Harga
    $price = filter_var($data['harga'], FILTER_VALIDATE_FLOAT);
    if ($price === false || $price < 0) {
        $errors['harga'] = 'err_price_invalid';
    } else {
        $data['harga'] = $price;
    }

    // Lokasi rak
    if (mb_strlen($data['lokasi_rak']) > 30) {
        $errors['lokasi_rak'] = 'err_location_length';
    }

    return [$data, $errors];
}