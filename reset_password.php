<?php
require_once 'config.php';

$token = $_GET['token'] ?? null;
$error = '';
$token_valid = false;

if ($token) {
            $query = "SELECT * FROM users WHERE reset_token='$token' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                        $now = date("Y-m-d H:i:s");
                        if ($now < $user['reset_token_expires_at']) {
                                    $token_valid = true;
                        } else {
                                    $error = "Link reset password ini sudah kedaluwarsa.";
                        }
            } else {
                        $error = "Link reset password tidak valid.";
            }
} else {
            $error = "Token tidak ditemukan. Pastikan Anda menggunakan link yang benar.";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
            <div class="container">
                        <div class="row justify-content-center" style="margin-top: 100px;">
                                    <div class="col-md-5">
                                                <div class="card">
                                                            <div class="card-header text-center">
                                                                        <h3>Buat Password Baru</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                        <?php if ($token_valid): ?>
                                                                                    <form action="<?php echo BASE_URL; ?>process_reset_password.php" method="POST">
                                                                                                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                                                                                                <div class="mb-3">
                                                                                                            <label for="password" class="form-label">Password Baru</label>
                                                                                                            <input type="password" class="form-control" name="password" required>
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                                                                                                            <input type="password" class="form-control" name="confirm_password" required>
                                                                                                </div>
                                                                                                <div class="d-grid">
                                                                                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                                                                                </div>
                                                                                    </form>
                                                                        <?php else: ?>
                                                                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                                                                    <a href="<?php echo BASE_URL; ?>login.php">Kembali ke halaman Login</a>
                                                                        <?php endif; ?>
                                                            </div>
                                                </div>
                                    </div>
                        </div>
            </div>
</body>

</html>