<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

            <div class="auth-container">
                        <div class="auth-card">
                                    <div class="text-center mb-4">
                                                <h3>Selamat Datang!</h3>
                                                <p class="text-muted">Silahkan masukkan username dan password untuk login.</p>
                                    </div>

                                    <?php
                                    display_message('login_message');
                                    display_error('login_error');
                                    ?>
                                    <form action="<?php echo BASE_URL; ?>process_login.php" method="POST">
                                                <div class="mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                                                </div>

                                                <div class="mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <div class="input-group">
                                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                                                    <i class="bi bi-eye-fill"></i>
                                                                        </button>
                                                            </div>
                                                </div>

                                                <div class="d-grid mt-4">
                                                            <button type="submit" class="btn btn-primary">Login</button>
                                                </div>
                                    </form>

                                    <div class="text-center mt-4 auth-footer">
                                                <small>Belum punya akun? <a href="<?php echo BASE_URL; ?>register.php">Daftar disini</a></small>
                                    </div>
                        </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                        const togglePassword = document.querySelector('#togglePassword');
                        const password = document.querySelector('#password');
                        const icon = togglePassword.querySelector('i');

                        togglePassword.addEventListener('click', function() {
                                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                    password.setAttribute('type', type);
                                    icon.classList.toggle('bi-eye-slash-fill');
                        });
            </script>

</body>

</html>