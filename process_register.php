<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                        $_SESSION['register_error'] = "Konfirmasi password tidak cocok!";
                        redirect(BASE_URL . 'register.php');
            }

            $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
            $result = mysqli_query($db, $check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                        if ($user['username'] === $username) {
                                    $_SESSION['register_error'] = "Username sudah terdaftar.";
                        }
                        if ($user['email'] === $email) {
                                    $_SESSION['register_error'] = "Email sudah terdaftar.";
                        }
                        redirect(BASE_URL . 'register.php');
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$hashed_password')";
            if (mysqli_query($db, $query)) {
                        $_SESSION['login_message'] = "Pendaftaran berhasil! Silakan login.";
                        redirect(BASE_URL . 'login.php');
            } else {
                        $_SESSION['register_error'] = "Terjadi kesalahan saat mendaftar.";
                        redirect(BASE_URL . 'register.php');
            }
} else {
            redirect(BASE_URL . 'register.php');
}
