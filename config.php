<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sistem-login');

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$db) {
            die("Koneksi database gagal: " . mysqli_connect_error());
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$path = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

define('BASE_URL', $protocol . $host . $path);

function redirect($url)
{
            header("Location: " . $url);
            exit();
}

function display_message($key)
{
            if (isset($_SESSION[$key])) {
                        echo '<div class="alert alert-info">' . $_SESSION[$key] . '</div>';
                        unset($_SESSION[$key]);
            }
}

function display_error($key)
{
            if (isset($_SESSION[$key])) {
                        echo '<div class="alert alert-danger">' . $_SESSION[$key] . '</div>';
                        unset($_SESSION[$key]);
            }
}
