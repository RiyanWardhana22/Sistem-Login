<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendVerificationEmail($recipientEmail, $token)
{
            $mail = new PHPMailer(true);

            try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'riyanwardhana2@gmail.com';
                        $mail->Password   = 'tzwx ijrr oasl cfdl';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        // ---- PENERIMA EMAIL ----
                        $mail->setFrom('riyanwardhana2@gmail.com', 'Sistem Login');
                        $mail->addAddress($recipientEmail);

                        // ---- KONTEN EMAIL ----
                        $mail->isHTML(true);
                        $mail->Subject = 'Token Verifikasi Login Anda';
                        $mail->Body    = "Halo,<br><br>Gunakan token berikut untuk menyelesaikan proses login Anda: <h2>$token</h2><br>Token ini akan kedaluwarsa dalam 15 menit.<br><br>Terima kasih.";
                        $mail->AltBody = "Token verifikasi Anda adalah: $token";

                        $mail->send();
                        return true;
            } catch (Exception $e) {
                        error_log("Email gagal dikirim. Mailer Error: {$mail->ErrorInfo}");
                        return false;
            }
}

function sendPasswordResetEmail($recipientEmail, $token)
{
            $mail = new PHPMailer(true);
            $resetLink = BASE_URL . 'reset_password.php?token=' . $token;

            try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'riyanwardhana2@gmail.com';
                        $mail->Password   = 'tzwx ijrr oasl cfdl';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        // ---- PENERIMA EMAIL ----
                        $mail->setFrom('riyanwardhana2@gmail.com', 'Sistem Login');
                        $mail->addAddress($recipientEmail);

                        // Konten Email
                        $mail->isHTML(true);
                        $mail->Subject = 'Permintaan Reset Password';
                        $mail->Body    = "Halo,<br><br>Kami mendeteksi 3 kali percobaan login yang gagal ke akun Anda. Jika ini bukan Anda, mohon abaikan email ini.<br><br>Untuk mereset password Anda, silakan klik tombol di bawah ini:<br><br>"
                                    . "<a href='{$resetLink}' style='background-color: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Reset Password</a>"
                                    . "<br><br>Link ini akan kedaluwarsa dalam 1 jam.<br><br>Terima kasih.";
                        $mail->AltBody = "Untuk mereset password Anda, silakan kunjungi link berikut: " . $resetLink;

                        $mail->send();
                        return true;
            } catch (Exception $e) {
                        error_log("Email reset password gagal dikirim. Mailer Error: {$mail->ErrorInfo}");
                        return false;
            }
}
