<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gym App' ?> - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 25%, #111827 50%, #0f1219 100%);
            background-attachment: fixed;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Navbar */
        .navbar {
            background: rgba(15, 18, 25, 0.95);
            border-bottom: 2px solid #ccff00;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1030;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ccff00 !important;
        }

        .navbar-brand i {
            margin-right: 10px;
        }

        .nav-link {
            color: #aaa !important;
            transition: all 0.3s ease;
            margin-left: 20px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ccff00 !important;
        }

        .nav-link.active {
            color: #ccff00 !important;
            border-bottom: 2px solid #ccff00;
            padding-bottom: 5px;
        }

        /* Sidebar */
        .sidebar {
            background: rgba(20, 25, 40, 0.9);
            border-right: 2px solid #333;
            min-height: calc(100vh - 80px);
            padding: 30px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 80px;
            z-index: 1020;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #aaa;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover {
            background: rgba(204, 255, 0, 0.1);
            color: #ccff00;
            border-left: 3px solid #ccff00;
            padding-left: 22px;
        }

        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.1rem;
            width: 25px;
            text-align: center;
        }

        .sidebar-menu a.active {
            background: rgba(204, 255, 0, 0.15);
            color: #ccff00;
            border-left: 3px solid #ccff00;
            padding-left: 22px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            min-height: calc(100vh - 80px);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #ccff00;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #888;
        }

        /* Dashboard Cards */
        .dashboard-card {
            background: rgba(30, 35, 50, 0.8);
            border: 2px solid #333;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .dashboard-card:hover {
            border-color: #ccff00;
            box-shadow: 0 8px 25px rgba(204, 255, 0, 0.2);
            transform: translateY(-5px);
        }

        .dashboard-card h3 {
            color: #ccff00;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .dashboard-card p {
            color: #aaa;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ccff00;
            margin: 15px 0;
        }

        .stat-label {
            color: #888;
            font-size: 0.9rem;
        }

        /* Button Styles */
        .btn-primary {
            background: #ccff00;
            color: #000;
            border: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #e0ff1a;
            color: #000;
            box-shadow: 0 5px 20px rgba(204, 255, 0, 0.5);
        }

        .btn-outline-yellow {
            border: 2px solid #ccff00;
            color: #ccff00;
            background: transparent;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-outline-yellow:hover {
            background: #ccff00;
            color: #000;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, rgba(204, 255, 0, 0.1) 0%, rgba(30, 35, 50, 0.8) 100%);
            border: 2px solid #ccff00;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .welcome-section h2 {
            color: #ccff00;
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #aaa;
            margin-bottom: 0;
        }

        /* User Info Section */
        .user-info {
            background: rgba(30, 35, 50, 0.8);
            border: 2px solid #333;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .user-info p {
            color: #aaa;
            margin-bottom: 8px;
        }

        .user-info strong {
            color: #ccff00;
        }

        /* Logout button in navbar */
        .btn-logout {
            background: #ff4444;
            color: white;
            border: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #ff0000;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 20px;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                position: absolute;
                width: 100%;
                left: -100%;
                top: 80px;
                z-index: 999;
                transition: left 0.3s ease;
                width: 100%;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .stat-number {
                font-size: 1.8rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-card {
            animation: fadeIn 0.6s ease-out;
        }

        .dashboard-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .dashboard-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .dashboard-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        /* Chart Container Styling */
        .dashboard-card canvas {
            margin-top: 15px;
        }

        /* Chart Tooltip Styling */
        .chartjs-tooltip {
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid #ccff00;
            border-radius: 5px;
            padding: 10px;
            color: #ccff00;
            font-weight: 600;
        }

        /* Alerts */
        .alert {
            background: rgba(30, 35, 50, 0.8);
            border: 2px solid;
            border-radius: 10px;
        }

        .alert-success {
            border-color: #44ff44;
            color: #44ff44;
        }

        .alert-danger {
            border-color: #ff4444;
            color: #ff4444;
        }

        .alert-success i,
        .alert-danger i {
            margin-right: 10px;
        }

        .alert-success .btn-close,
        .alert-danger .btn-close {
            filter: invert(1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?= $this->include('partials/_navbar') ?>

    <!-- Flash Messages -->
    <div class="container-fluid" style="padding: 20px 30px 0 30px;">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <div style="display: flex;">
        <!-- Sidebar -->
        <?= $this->include('partials/_sidebar') ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Welcome, <?= $user_name ?? 'User' ?>!</h1>
                <p>Manage your gym efficiently with our dashboard</p>
            </div>

            <!-- Content Section -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const sidebar = document.getElementById('sidebar');

            if (navbarToggler) {
                navbarToggler.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });
    </script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
