<?php
require_once 'config.php';
if (!isset($_SESSION['verification_user_id'])) {
            redirect(BASE_URL . 'login.php');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Verifikasi Token</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

            <div class="auth-container">
                        <div class="auth-card">
                                    <div class="text-center mb-4">
                                                <h3>Cek Email Kamu!</h3>
                                                <p class="text-muted">Kami telah mengirimkan kode verifikasi ke alamat email anda yang telah terdaftar.</p>
                                    </div>

                                    <?php display_error('verify_error'); ?>

                                    <form action="<?php echo BASE_URL; ?>process_verification.php" method="POST">
                                                <div class="mb-3">
                                                            <label for="token" class="form-label">Verification Code</label>
                                                            <input type="text" class="form-control text-center" id="token" name="token" placeholder="Masukkan 8 digit code" required maxlength="8"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                </div>
                                                <div class="d-grid mt-4">
                                                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                                                </div>
                                    </form>
                                    <div class="text-center mt-4 auth-footer">
                                                <small>Not you? <a href="<?php echo BASE_URL; ?>logout.php">Return to Login</a></small>
                                    </div>
                        </div>
            </div>

</body>

</html>