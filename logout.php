<?php
require_once 'config.php';
session_unset();
session_destroy();

$_SESSION['login_message'] = "Anda telah berhasil logout.";
redirect(BASE_URL . 'login.php');
