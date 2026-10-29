<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validator
const KATEGORI_LIST = ['elektronik', 'makanan', 'kemasan', 'kebersihan', 'lainnya'];
const SATUAN_LIST   = ['pcs', 'box', 'kg', 'liter', 'unit'];
const STOK_MINIMUM  = 10;

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}


function clean_string($value): string
{
    return trim(strip_tags((string) $value));
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function set_flash(string $type, string $langKey): void
{
    $_SESSION['flash'] = ['type' => $type, 'key' => $langKey];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    $token = $_POST['csrf_token'] ?? '';
    return is_string($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

function rupiah($number): string
{
    return 'Rp ' . number_format((float) $number, 0, ',', '.');
}
