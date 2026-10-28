<?php
return [
        'app_name'        => 'Inventaris Gudang',
        'app_tagline'     => 'Sistem Informasi Manajemen Stok Barang',

        // Navigasi
        'nav_items'       => 'Data Barang',
        'nav_add'         => 'Tambah Barang',
        'nav_logout'      => 'Keluar',
        'welcome'         => 'Halo',
        'language'        => 'Bahasa',

        // Login
        'login_title'     => 'Masuk ke Sistem',
        'username'        => 'Nama Pengguna',
        'password'        => 'Kata Sandi',
        'btn_login'       => 'Masuk',
        'err_username_required' => 'Nama pengguna wajib diisi.',
        'err_password_required' => 'Kata sandi wajib diisi.',
        'err_login_failed'      => 'Nama pengguna atau kata sandi salah.',
        'msg_logout'      => 'Anda berhasil keluar.',
        'msg_login_required' => 'Silakan login terlebih dahulu.',

        // Dashboard
        'stat_types'      => 'Jenis Barang',
        'stat_stock'      => 'Total Stok',
        'stat_low'        => 'Stok Menipis',
        'stat_value'      => 'Nilai Persediaan',

        // Tabel
        'title_list'      => 'Daftar Barang Gudang',
        'search_ph'       => 'Cari kode / nama barang...',
        'btn_search'      => 'Cari',
        'btn_reset'       => 'Reset',
        'col_no'          => 'No',
        'col_code'        => 'Kode',
        'col_name'        => 'Nama Barang',
        'col_category'    => 'Kategori',
        'col_qty'         => 'Jumlah',
        'col_unit'        => 'Satuan',
        'col_price'       => 'Harga Satuan',
        'col_location'    => 'Lokasi Rak',
        'col_action'      => 'Aksi',
        'empty_data'      => 'Belum ada data barang.',
        'low_badge'       => 'Menipis',

        // Kategori
        'cat_elektronik'  => 'Elektronik',
        'cat_makanan'     => 'Makanan',
        'cat_kemasan'     => 'Kemasan',
        'cat_kebersihan'  => 'Kebersihan',
        'cat_lainnya'     => 'Lainnya',
        'choose_category' => '-- Pilih Kategori --',
        'choose_unit'     => '-- Pilih Satuan --',

        // Form
        'title_add'       => 'Tambah Barang Baru',
        'title_edit'      => 'Ubah Data Barang',
        'btn_save'        => 'Simpan',
        'btn_update'      => 'Perbarui',
        'btn_cancel'      => 'Batal',
        'btn_edit'        => 'Ubah',
        'btn_delete'      => 'Hapus',
        'confirm_delete'  => 'Yakin ingin menghapus barang ini?',

        // Validasi
        'err_csrf'        => 'Sesi form tidak valid. Muat ulang halaman.',
        'err_code_required'   => 'Kode barang wajib diisi.',
        'err_code_format'     => 'Kode barang hanya boleh huruf, angka, dan tanda minus (maks. 20 karakter).',
        'err_code_exists'     => 'Kode barang sudah digunakan.',
        'err_name_required'   => 'Nama barang wajib diisi.',
        'err_name_length'     => 'Nama barang maksimal 100 karakter.',
        'err_category_invalid'=> 'Kategori tidak valid / belum dipilih.',
        'err_qty_invalid'     => 'Jumlah harus berupa bilangan bulat 0 atau lebih.',
        'err_unit_invalid'    => 'Satuan tidak valid / belum dipilih.',
        'err_price_invalid'   => 'Harga harus berupa angka 0 atau lebih.',
        'err_location_length' => 'Lokasi rak maksimal 30 karakter.',
        'err_not_found'       => 'Data barang tidak ditemukan.',

        // Pesan sukses
        'msg_created'     => 'Data barang berhasil ditambahkan.',
        'msg_updated'     => 'Data barang berhasil diperbarui.',
        'msg_deleted'     => 'Data barang berhasil dihapus.',

        'footer'          => 'Tugas Pemrograman Web - PHP & MySQL',
];