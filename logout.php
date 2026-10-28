<?php
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/lang.php';
require __DIR__ . '/includes/auth.php';

logout_user();
set_flash('success', 'msg_logout');
redirect('login.php');