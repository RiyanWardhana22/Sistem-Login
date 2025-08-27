<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Daftar Akun Baru</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

            <div class="container">
                        <div class="row justify-content-center" style="margin-top: 100px;">
                                    <div class="col-md-6">
                                                <div class="card">
                                                            <div class="card-header text-center">
                                                                        <h3>Daftar Akun Baru</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                        <?php display_error('register_error'); ?>
                                                                        <form action="<?php echo BASE_URL; ?>process_register.php" method="POST">
                                                                                    <div class="mb-3">
                                                                                                <label for="email" class="form-label">Alamat Email</label>
                                                                                                <input type="email" class="form-control" id="email" name="email" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                                <label for="username" class="form-label">Username</label>
                                                                                                <input type="text" class="form-control" id="username" name="username" required>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                                <label for="password" class="form-label">Password</label>
                                                                                                <div class="input-group">
                                                                                                            <input type="password" class="form-control" id="password" name="password" required>
                                                                                                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                                                                                                                        <i class="bi bi-eye-fill"></i>
                                                                                                            </button>
                                                                                                </div>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                                                                                <div class="input-group">
                                                                                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                                                                                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#confirm_password">
                                                                                                                        <i class="bi bi-eye-fill"></i>
                                                                                                            </button>
                                                                                                </div>
                                                                                    </div>

                                                                                    <div class="d-grid">
                                                                                                <button type="submit" class="btn btn-primary">Daftar</button>
                                                                                    </div>
                                                                        </form>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                        <small>Sudah punya akun? <a href="<?php echo BASE_URL; ?>login.php">Login di sini</a></small>
                                                            </div>
                                                </div>
                                    </div>
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