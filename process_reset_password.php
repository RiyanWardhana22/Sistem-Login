<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                        $_SESSION['login_error'] = "Konfirmasi password tidak cocok!";
                        redirect(BASE_URL . 'reset_password.php?token=' . $token);
            }

            $query = "SELECT * FROM users WHERE reset_token='$token' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                        $now = date("Y-m-d H:i:s");
                        if ($now < $user['reset_token_expires_at']) {
                                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                    $user_id = $user['id'];

                                    $update_query = "UPDATE users SET 
                password='$hashed_password', 
                reset_token=NULL, 
                reset_token_expires_at=NULL, 
                failed_login_attempts=0 
                WHERE id=$user_id";

                                    if (mysqli_query($db, $update_query)) {
                                                $_SESSION['login_message'] = "Password Anda berhasil direset. Silakan login dengan password baru.";
                                                redirect(BASE_URL . 'login.php');
                                    } else {
                                                $_SESSION['login_error'] = "Gagal memperbarui password. Silakan coba lagi.";
                                                redirect(BASE_URL . 'reset_password.php?token=' . $token);
                                    }
                        } else {
                                    $_SESSION['login_error'] = "Link reset password ini sudah kedaluwarsa.";
                                    redirect(BASE_URL . 'login.php');
                        }
            } else {
                        $_SESSION['login_error'] = "Token tidak valid.";
                        redirect(BASE_URL . 'login.php');
            }
} else {
            redirect(BASE_URL . 'login.php');
}
