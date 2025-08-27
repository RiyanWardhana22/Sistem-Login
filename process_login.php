<?php
require_once 'config.php';
require_once 'send_email.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = $_POST['password'];

            // Cari user berdasarkan username
            $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) == 1) {
                        $user = mysqli_fetch_assoc($result);
                        $user_id = $user['id'];

                        // Verifikasi Password
                        if (password_verify($password, $user['password'])) {
                                    // ---- JIKA LOGIN BERHASIL ----

                                    // 1. Reset penghitung kegagalan login ke 0
                                    $reset_attempts_query = "UPDATE users SET failed_login_attempts=0 WHERE id=$user_id";
                                    mysqli_query($db, $reset_attempts_query);

                                    // 2. Lanjutkan ke proses verifikasi token 2FA (alur yang sudah ada)
                                    $token = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                                    $expires_at = date("Y-m-d H:i:s", strtotime('+15 minutes'));

                                    $update_query = "UPDATE users SET login_token='$token', token_expires_at='$expires_at' WHERE id=$user_id";
                                    if (mysqli_query($db, $update_query)) {
                                                sendVerificationEmail($user['email'], $token);
                                                $_SESSION['verification_user_id'] = $user_id;
                                                redirect(BASE_URL . 'verify_token.php');
                                    } else {
                                                $_SESSION['login_error'] = "Terjadi kesalahan sistem. Coba lagi.";
                                                redirect(BASE_URL . 'login.php');
                                    }
                        } else {
                                    // ---- JIKA PASSWORD SALAH ----

                                    // 1. Tambah hitungan kegagalan login
                                    $new_attempts = $user['failed_login_attempts'] + 1;
                                    $update_attempts_query = "UPDATE users SET failed_login_attempts=$new_attempts WHERE id=$user_id";
                                    mysqli_query($db, $update_attempts_query);

                                    // 2. Cek apakah sudah mencapai batas (3 kali)
                                    if ($new_attempts >= 3) {
                                                // Batas tercapai, mulai proses reset password
                                                // a. Buat token reset yang aman dan unik
                                                $reset_token = bin2hex(random_bytes(32));
                                                $reset_expires_at = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token reset berlaku 1 jam

                                                // b. Simpan token ke database
                                                $set_token_query = "UPDATE users SET reset_token='$reset_token', reset_token_expires_at='$reset_expires_at' WHERE id=$user_id";
                                                mysqli_query($db, $set_token_query);

                                                // c. Kirim email reset password
                                                sendPasswordResetEmail($user['email'], $reset_token);

                                                // d. Beri pesan khusus ke pengguna
                                                $_SESSION['login_error'] = "Anda telah 3 kali salah memasukkan password. Link untuk reset password telah dikirimkan ke email Anda.";
                                                redirect(BASE_URL . 'login.php');
                                    } else {
                                                // Jika belum mencapai batas, beri pesan error biasa
                                                $_SESSION['login_error'] = "Username atau password salah.";
                                                redirect(BASE_URL . 'login.php');
                                    }
                        }
            } else {
                        // Jika username tidak ditemukan
                        $_SESSION['login_error'] = "Username atau password salah.";
                        redirect(BASE_URL . 'login.php');
            }
} else {
            redirect(BASE_URL . 'login.php');
}
