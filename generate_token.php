<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $query = "SELECT id FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                        $token = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                        $expires_at = date("Y-m-d H:i:s", strtotime('+15 minutes'));

                        $user = mysqli_fetch_assoc($result);
                        $user_id = $user['id'];
                        $update_query = "UPDATE users SET login_token='$token', token_expires_at='$expires_at' WHERE id=$user_id";

                        if (mysqli_query($db, $update_query)) {
                                    $_SESSION['token_info'] = "Token berhasil dibuat untuk email <strong>$email</strong>. Gunakan token ini untuk login: <br><h2>$token</h2>";
                        } else {
                                    $_SESSION['token_error'] = "Gagal membuat token. Coba lagi.";
                        }
            } else {
                        $_SESSION['token_error'] = "Email tidak ditemukan di sistem kami.";
            }
            redirect(BASE_URL . 'generate_token.php');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Minta Token Login</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

            <div class="container">
                        <div class="row justify-content-center" style="margin-top: 100px;">
                                    <div class="col-md-5">
                                                <div class="card">
                                                            <div class="card-header text-center">
                                                                        <h3>Minta Token Baru</h3>
                                                                        <p class="text-muted">Masukkan email Anda untuk mendapatkan token login.</p>
                                                            </div>
                                                            <div class="card-body">
                                                                        <?php
                                                                        if (isset($_SESSION['token_info'])) {
                                                                                    echo '<div class="alert alert-success text-center">' . $_SESSION['token_info'] . '</div>';
                                                                                    unset($_SESSION['token_info']);
                                                                        }
                                                                        display_error('token_error');
                                                                        ?>
                                                                        <form action="" method="POST">
                                                                                    <div class="mb-3">
                                                                                                <label for="email" class="form-label">Alamat Email Terdaftar</label>
                                                                                                <input type="email" class="form-control" id="email" name="email" required>
                                                                                    </div>
                                                                                    <div class="d-grid">
                                                                                                <button type="submit" class="btn btn-primary">Kirim Token</button>
                                                                                    </div>
                                                                        </form>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                        <small>Sudah punya token? <a href="<?php echo BASE_URL; ?>login.php">Kembali ke halaman Login</a></small>
                                                            </div>
                                                </div>
                                    </div>
                        </div>
            </div>

</body>

</html>