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
</head>

<body class="bg-light">

            <div class="container">
                        <div class="row justify-content-center" style="margin-top: 100px;">
                                    <div class="col-md-5">
                                                <div class="card">
                                                            <div class="card-header text-center">
                                                                        <h3>Verifikasi Login Anda</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                        <div class="alert alert-info">
                                                                                    Sebuah token verifikasi telah dikirim ke email Anda yang terdaftar. Silakan periksa dan masukkan token di bawah ini.
                                                                        </div>
                                                                        <?php display_error('verify_error'); ?>

                                                                        <form action="<?php echo BASE_URL; ?>process_verification.php" method="POST">
                                                                                    <div class="mb-3">
                                                                                                <label for="token" class="form-label">Token Verifikasi</label>
                                                                                                <input type="text" class="form-control" id="token" name="token" placeholder="Masukkan 8 digit token" required>
                                                                                    </div>
                                                                                    <div class="d-grid">
                                                                                                <button type="submit" class="btn btn-primary">Verifikasi</button>
                                                                                    </div>
                                                                        </form>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                        <small>Bukan Anda? <a href="<?php echo BASE_URL; ?>logout.php">Kembali ke login</a></small>
                                                            </div>
                                                </div>
                                    </div>
                        </div>
            </div>

</body>

</html>