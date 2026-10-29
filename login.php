<?php
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/lang.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/config/database.php';

// Sudah login? langsung ke halaman utama.
if (is_logged_in()) {
    redirect('index.php');
}

$errors   = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_string($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if (!csrf_valid()) {
        $errors['general'] = 'err_csrf';
    } else {
        // Validasi kelengkapan (if-else)
        if ($username === '') {
            $errors['username'] = 'err_username_required';
        }
        if ($password === '') {
            $errors['password'] = 'err_password_required';
        }

        // Verifikasi kredensial
        if (count($errors) === 0) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && $password === $user['password']) {
                login_user($user);
                redirect('index.php');
            } else {
                $errors['general'] = 'err_login_failed';
            }
        }
    }
}

$pageTitle = 'login_title';
$hideNav   = true;
require __DIR__ . '/includes/header.php';
?>

    <section class="card login-card">
        <h2><?= e(t('login_title')) ?></h2>
        <p class="muted"><?= e(t('app_tagline')) ?></p>

        <?php if (isset($errors['general'])): ?>
            <div class="alert alert-error"><?= e(t($errors['general'])) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="form" novalidate>
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username"><?= e(t('username')) ?></label>
                <input type="text" id="username" name="username" value="<?= e($username) ?>" autofocus>
                <?php if (isset($errors['username'])): ?>
                    <small class="field-error"><?= e(t($errors['username'])) ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password"><?= e(t('password')) ?></label>
                <input type="password" id="password" name="password">
                <?php if (isset($errors['password'])): ?>
                    <small class="field-error"><?= e(t($errors['password'])) ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block"><?= e(t('btn_login')) ?></button>
        </form>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>