<?php
require_once 'config.php';
if (!isset($_SESSION['user_id'])) {
            redirect(BASE_URL . 'login.php');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container">
                                    <a class="navbar-brand" href="#">Dashboard</a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                                <ul class="navbar-nav ms-auto">
                                                            <li class="nav-item">
                                                                        <a class="nav-link" href="#">
                                                                                    Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>
                                                                        </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                        <a class="nav-link" href="<?php echo BASE_URL; ?>logout.php">Logout</a>
                                                            </li>
                                                </ul>
                                    </div>
                        </div>
            </nav>

            <div class="container mt-4">
                        <div class="p-5 mb-4 bg-light rounded-3">
                                    <div class="container-fluid py-5">
                                                <h1 class="display-5 fw-bold">Selamat Datang!</h1>
                                                <p class="col-md-8 fs-4">Anda telah berhasil login ke sistem.</p>
                                                <p>Ini adalah halaman dashboard sederhana yang dilindungi.</p>
                                    </div>
                        </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>