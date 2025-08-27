<?php
require_once 'config.php';
if (!isset($_SESSION['verification_user_id'])) {
            redirect(BASE_URL . 'login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $user_id = $_SESSION['verification_user_id'];
            $query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);

            if ($token === $user['login_token']) {
                        $now = date("Y-m-d H:i:s");
                        if ($now < $user['token_expires_at']) {
                                    unset($_SESSION['verification_user_id']);
                                    $_SESSION['user_id'] = $user['id'];
                                    $_SESSION['username'] = $user['username'];
                                    $update_token_query = "UPDATE users SET login_token=NULL, token_expires_at=NULL WHERE id=" . $user['id'];
                                    mysqli_query($db, $update_token_query);
                                    redirect(BASE_URL . 'dashboard.php');
                        } else {
                                    $_SESSION['verify_error'] = "Token Anda sudah kedaluwarsa. Silakan login kembali untuk mendapatkan token baru.";
                                    redirect(BASE_URL . 'verify_token.php');
                        }
            } else {
                        $_SESSION['verify_error'] = "Token yang Anda masukkan salah.";
                        redirect(BASE_URL . 'verify_token.php');
            }
} else {
            redirect(BASE_URL . 'verify_token.php');
}
