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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

            <div class="wrapper">
                        <nav id="sidebar">
                                    <div class="sidebar-header">
                                                <h3>Dashboard App</h3>
                                    </div>
                                    <ul class="list-unstyled components">
                                                <li class="active">
                                                            <a href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                                                </li>
                                                <li>
                                                            <a href="#"><i class="bi bi-bar-chart-line me-2"></i> Analytics</a>
                                                </li>
                                                <li>
                                                            <a href="#"><i class="bi bi-box-seam me-2"></i> Products</a>
                                                </li>
                                                <li>
                                                            <a href="#"><i class="bi bi-people me-2"></i> Customers</a>
                                                </li>
                                                <li>
                                                            <a href="#"><i class="bi bi-gear me-2"></i> Settings</a>
                                                </li>
                                    </ul>
                        </nav>

                        <div id="content">
                                    <nav class="navbar navbar-expand-lg top-navbar">
                                                <div class="container-fluid">
                                                            <button type="button" id="sidebarCollapse" class="btn btn-light">
                                                                        <i class="bi bi-list"></i>
                                                            </button>
                                                            <div class="collapse navbar-collapse">
                                                                        <ul class="navbar-nav ms-auto">
                                                                                    <li class="nav-item dropdown">
                                                                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                                            <i class="bi bi-person-circle me-1"></i> Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>
                                                                                                </a>
                                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                                                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                                                                                            <li>
                                                                                                                        <hr class="dropdown-divider">
                                                                                                            </li>
                                                                                                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>logout.php">Logout</a></li>
                                                                                                </ul>
                                                                                    </li>
                                                                        </ul>
                                                            </div>
                                                </div>
                                    </nav>

                                    <div class="container-fluid">
                                                <div class="row g-4 mb-4">
                                                            <div class="col-md-6 col-lg-3">
                                                                        <div class="card p-3">
                                                                                    <div class="d-flex align-items-center">
                                                                                                <div class="p-3 bg-primary bg-opacity-10 rounded-3 me-3">
                                                                                                            <i class="bi bi-cash-coin fs-3 text-primary"></i>
                                                                                                </div>
                                                                                                <div>
                                                                                                            <p class="mb-0 text-muted">Revenue</p>
                                                                                                            <h5 class="mb-0 fw-bold">$3,468</h5>
                                                                                                </div>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                        <div class="card p-3">
                                                                                    <div class="d-flex align-items-center">
                                                                                                <div class="p-3 bg-success bg-opacity-10 rounded-3 me-3">
                                                                                                            <i class="bi bi-cart-check fs-3 text-success"></i>
                                                                                                </div>
                                                                                                <div>
                                                                                                            <p class="mb-0 text-muted">Orders</p>
                                                                                                            <h5 class="mb-0 fw-bold">1,250</h5>
                                                                                                </div>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                        <div class="card p-3">
                                                                                    <div class="d-flex align-items-center">
                                                                                                <div class="p-3 bg-warning bg-opacity-10 rounded-3 me-3">
                                                                                                            <i class="bi bi-people fs-3 text-warning"></i>
                                                                                                </div>
                                                                                                <div>
                                                                                                            <p class="mb-0 text-muted">Customers</p>
                                                                                                            <h5 class="mb-0 fw-bold">82</h5>
                                                                                                </div>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                        <div class="card p-3">
                                                                                    <div class="d-flex align-items-center">
                                                                                                <div class="p-3 bg-info bg-opacity-10 rounded-3 me-3">
                                                                                                            <i class="bi bi-graph-up-arrow fs-3 text-info"></i>
                                                                                                </div>
                                                                                                <div>
                                                                                                            <p class="mb-0 text-muted">Growth</p>
                                                                                                            <h5 class="mb-0 fw-bold">+15.7%</h5>
                                                                                                </div>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                </div>

                                                <div class="row g-4 mb-4">
                                                            <div class="col-lg-8">
                                                                        <div class="card h-100">
                                                                                    <div class="card-header">Sales Overview</div>
                                                                                    <div class="card-body">
                                                                                                <canvas id="salesChart"></canvas>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                        <div class="card h-100">
                                                                                    <div class="card-header">Traffic Source</div>
                                                                                    <div class="card-body d-flex justify-content-center align-items-center">
                                                                                                <canvas id="trafficChart" style="max-height: 250px;"></canvas>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                </div>

                                                <div class="row">
                                                            <div class="col-12">
                                                                        <div class="card">
                                                                                    <div class="card-header">Recent Orders</div>
                                                                                    <div class="card-body">
                                                                                                <div class="table-responsive">
                                                                                                            <table class="table table-hover">
                                                                                                                        <thead>
                                                                                                                                    <tr>
                                                                                                                                                <th>Invoice</th>
                                                                                                                                                <th>Customer</th>
                                                                                                                                                <th>From</th>
                                                                                                                                                <th>Price</th>
                                                                                                                                                <th>Status</th>
                                                                                                                                    </tr>
                                                                                                                        </thead>
                                                                                                                        <tbody>
                                                                                                                                    <tr>
                                                                                                                                                <td>#12345</td>
                                                                                                                                                <td>Charlie Puth</td>
                                                                                                                                                <td>USA</td>
                                                                                                                                                <td>$120.00</td>
                                                                                                                                                <td><span class="badge badge-success">Shipped</span></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                                <td>#12346</td>
                                                                                                                                                <td>Bright Vachirawit</td>
                                                                                                                                                <td>Thailand</td>
                                                                                                                                                <td>$89.50</td>
                                                                                                                                                <td><span class="badge badge-warning">Pending</span></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                                <td>#12347</td>
                                                                                                                                                <td>John Mayer</td>
                                                                                                                                                <td>USA</td>
                                                                                                                                                <td>$250.75</td>
                                                                                                                                                <td><span class="badge badge-success">Shipped</span></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                                <td>#12348</td>
                                                                                                                                                <td>Win Metawin</td>
                                                                                                                                                <td>Thailand</td>
                                                                                                                                                <td>$45.00</td>
                                                                                                                                                <td><span class="badge badge-danger">Cancelled</span></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                                <td>#12349</td>
                                                                                                                                                <td>Justin Bieber</td>
                                                                                                                                                <td>Canada</td>
                                                                                                                                                <td>$310.20</td>
                                                                                                                                                <td><span class="badge badge-info">Processing</span></td>
                                                                                                                                    </tr>
                                                                                                                        </tbody>
                                                                                                            </table>
                                                                                                </div>
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                </div>
                                    </div>
                        </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                        document.addEventListener("DOMContentLoaded", function() {
                                    const sidebarCollapse = document.getElementById('sidebarCollapse');
                                    const sidebar = document.getElementById('sidebar');

                                    if (sidebarCollapse) {
                                                sidebarCollapse.addEventListener('click', function() {
                                                            sidebar.classList.toggle('active');
                                                });
                                    }
                                    const salesChartCtx = document.getElementById('salesChart').getContext('2d');
                                    const salesChart = new Chart(salesChartCtx, {
                                                type: 'line',
                                                data: {
                                                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                                                            datasets: [{
                                                                        label: 'Sales',
                                                                        data: [1200, 1900, 3000, 5000, 2300, 3100, 4000],
                                                                        borderColor: 'rgba(123, 104, 238, 1)',
                                                                        backgroundColor: 'rgba(123, 104, 238, 0.1)',
                                                                        fill: true,
                                                                        tension: 0.4
                                                            }]
                                                },
                                                options: {
                                                            responsive: true,
                                                            scales: {
                                                                        y: {
                                                                                    beginAtZero: true
                                                                        }
                                                            }
                                                }
                                    });

                                    // 2. Traffic Chart (Doughnut)
                                    const trafficChartCtx = document.getElementById('trafficChart').getContext('2d');
                                    const trafficChart = new Chart(trafficChartCtx, {
                                                type: 'doughnut',
                                                data: {
                                                            labels: ['Direct', 'Referral', 'Social'],
                                                            datasets: [{
                                                                        label: 'Traffic Source',
                                                                        data: [55, 30, 15],
                                                                        backgroundColor: [
                                                                                    'rgba(123, 104, 238, 0.8)',
                                                                                    'rgba(54, 162, 235, 0.8)',
                                                                                    'rgba(255, 206, 86, 0.8)'
                                                                        ],
                                                                        borderColor: [
                                                                                    'rgba(123, 104, 238, 1)',
                                                                                    'rgba(54, 162, 235, 1)',
                                                                                    'rgba(255, 206, 86, 1)'
                                                                        ],
                                                                        borderWidth: 1
                                                            }]
                                                },
                                                options: {
                                                            responsive: true,
                                                }
                                    });
                        });
            </script>

</body>

</html>