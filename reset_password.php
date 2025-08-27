<?php
require_once 'config.php';
$token = $_GET['token'] ?? null;
$error = '';
$token_valid = false;

if ($token) {
            $safe_token = mysqli_real_escape_string($db, $token);
            $query = "SELECT * FROM users WHERE reset_token='$safe_token' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                        $now = date("Y-m-d H:i:s");
                        if ($now < $user['reset_token_expires_at']) {
                                    $token_valid = true;
                        } else {
                                    $error = "This password reset link has expired.";
                        }
            } else {
                        $error = "This password reset link is not valid.";
            }
} else {
            $error = "Token not found. Please use the link provided in your email.";
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
            <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
            <div class="auth-container">
                        <div class="auth-card">
                                    <div class="text-center mb-4">
                                                <h3>Buat Password Baru</h3>
                                                <p class="text-muted">Kata sandi baru Anda harus berbeda dari yang sebelumnya.</p>
                                    </div>

                                    <?php if ($token_valid): ?>
                                                <form action="<?php echo BASE_URL; ?>process_reset_password.php" method="POST">
                                                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                                                            <div class="mb-3">
                                                                        <label for="password" class="form-label">Password Baru</label>
                                                                        <div class="input-group">
                                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" required>
                                                                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                                                                                                <i class="bi bi-eye-fill"></i>
                                                                                    </button>
                                                                        </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                                                        <div class="input-group">
                                                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password" required>
                                                                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#confirm_password">
                                                                                                <i class="bi bi-eye-fill"></i>
                                                                                    </button>
                                                                        </div>
                                                            </div>

                                                            <div class="d-grid mt-4">
                                                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                                            </div>
                                                </form>
                                    <?php else: ?>
                                                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                                                <div class="text-center mt-3 auth-footer">
                                                            <a href="<?php echo BASE_URL; ?>login.php">Kembali ke Login</a>
                                                </div>
                                    <?php endif; ?>
                        </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                        document.querySelectorAll('.toggle-password').forEach(button => {
                                    button.addEventListener('click', function() {
                                                const targetId = this.getAttribute('data-target');
                                                const passwordInput = document.querySelector(targetId);
                                                const icon = this.querySelector('i');
                                                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                                passwordInput.setAttribute('type', type);
                                                icon.classList.toggle('bi-eye-slash-fill');
                                    });
                        });
            </script>
</body>

</html>