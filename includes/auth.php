<?php
function is_logged_in(): bool
{
    return !empty($_SESSION['user_id']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        set_flash('error', 'msg_login_required');
        redirect('login.php');
    }
}

function login_user(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user_id']  = (int) $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama']     = $user['nama_lengkap'];
}

function logout_user(): void
{
    $lang = $_SESSION['lang'] ?? 'id';
    $_SESSION = [];
    session_regenerate_id(true);
    $_SESSION['lang'] = $lang;
}