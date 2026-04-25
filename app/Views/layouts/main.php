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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-dumbbell"></i> Gym App
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/members">Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/plans">Plans</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/settings">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-logout btn-sm" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container-fluid" style="margin-left: 250px; padding: 20px 30px 0 30px;">
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
        <div class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li>
                    <a href="/dashboard" class="active">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/members">
                        <i class="fas fa-users"></i> Members
                    </a>
                </li>
                <li>
                    <a href="/trainers">
                        <i class="fas fa-user-tie"></i> Trainers
                    </a>
                </li>
                <li>
                    <a href="/plans">
                        <i class="fas fa-list"></i> Plans
                    </a>
                </li>
                <li>
                    <a href="/attendance">
                        <i class="fas fa-clock"></i> Attendance
                    </a>
                </li>
                <li>
                    <a href="/subscriptions">
                        <i class="fas fa-credit-card"></i> Subscriptions
                    </a>
                </li>
                <li>
                    <a href="/settings">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Welcome, <?= $user_name ?? 'User' ?>!</h1>
                <p>Manage your gym efficiently with our dashboard</p>
            </div>

            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2><i class="fas fa-info-circle"></i> Quick Stats</h2>
                <p>Monitor your gym's key metrics at a glance</p>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-users"></i> Members</h3>
                        <div class="stat-number">0</div>
                        <p class="stat-label">Total Members</p>
                        <a href="/members" class="btn btn-outline-yellow btn-sm">View Details</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-dumbbell"></i> Plans</h3>
                        <div class="stat-number">0</div>
                        <p class="stat-label">Active Plans</p>
                        <a href="/plans" class="btn btn-outline-yellow btn-sm">View Details</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-credit-card"></i> Revenue</h3>
                        <div class="stat-number">$0</div>
                        <p class="stat-label">This Month</p>
                        <a href="/subscriptions" class="btn btn-outline-yellow btn-sm">View Details</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-clock"></i> Today's Attendance</h3>
                        <div class="stat-number">0</div>
                        <p class="stat-label">Check-ins</p>
                        <a href="/attendance" class="btn btn-outline-yellow btn-sm">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-chart-bar"></i> Monthly Revenue</h3>
                        <canvas id="revenueChart" height="80"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-chart-line"></i> Member Growth</h3>
                        <canvas id="memberGrowthChart" height="80"></canvas>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-chart-pie"></i> Membership Distribution</h3>
                        <canvas id="membershipChart" height="100"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <h3><i class="fas fa-chart-area"></i> Attendance Trend</h3>
                        <canvas id="attendanceChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="user-info">
                        <h5 style="color: #ccff00; margin-bottom: 15px;"><i class="fas fa-user-circle"></i> Your Profile</h5>
                        <p><strong>Name:</strong> <?= $user_name ?? 'N/A' ?></p>
                        <p><strong>Email:</strong> <?= $user_email ?? 'N/A' ?></p>
                        <p><strong>Role:</strong> <span style="color: #ccff00;">Admin</span></p>
                        <a href="/settings" class="btn btn-primary btn-sm mt-3">Edit Profile</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="user-info">
                        <h5 style="color: #ccff00; margin-bottom: 15px;"><i class="fas fa-bell"></i> Quick Actions</h5>
                        <p>
                            <a href="/members/new" class="btn btn-primary btn-sm">Add Member</a>
                            <a href="/plans/new" class="btn btn-outline-yellow btn-sm">Add Plan</a>
                        </p>
                        <p>
                            <a href="/trainers/new" class="btn btn-primary btn-sm mt-2">Add Trainer</a>
                            <a href="/attendance" class="btn btn-outline-yellow btn-sm mt-2">Mark Attendance</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script>
        // Chart.js default options for dark theme
        Chart.defaults.color = '#aaa';
        Chart.defaults.borderColor = '#333';

        // Monthly Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: [5000, 6500, 7200, 8100, 9500, 10200, 11500, 12300, 13100, 14500, 15200, 16800],
                    backgroundColor: '#ccff00',
                    borderColor: '#e0ff1a',
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: '#e0ff1a',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#aaa',
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 600
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#222',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#888',
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    }
                }
            }
        });

        // Member Growth Chart
        const memberGrowthCtx = document.getElementById('memberGrowthChart').getContext('2d');
        new Chart(memberGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
                datasets: [{
                    label: 'New Members',
                    data: [12, 19, 25, 32, 28, 35, 42, 38],
                    borderColor: '#ccff00',
                    backgroundColor: 'rgba(204, 255, 0, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ccff00',
                    pointBorderColor: '#e0ff1a',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    hoverBorderColor: '#e0ff1a',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#aaa',
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 600
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#222',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    }
                }
            }
        });

        // Membership Distribution Chart
        const membershipCtx = document.getElementById('membershipChart').getContext('2d');
        new Chart(membershipCtx, {
            type: 'doughnut',
            data: {
                labels: ['Basic Plan', 'Premium Plan', 'Elite Plan', 'Trial Members'],
                datasets: [{
                    data: [35, 28, 22, 15],
                    backgroundColor: [
                        '#ccff00',
                        '#99cc00',
                        '#ffaa00',
                        '#ff6600'
                    ],
                    borderColor: '#1a1f3a',
                    borderWidth: 3,
                    hoverOffset: 10,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#aaa',
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 600
                            }
                        }
                    }
                }
            }
        });

        // Attendance Trend Chart
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(attendanceCtx, {
            type: 'area',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Daily Attendance',
                    data: [65, 78, 92, 88, 95, 110, 75],
                    borderColor: '#ccff00',
                    backgroundColor: 'rgba(204, 255, 0, 0.15)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ccff00',
                    pointBorderColor: '#e0ff1a',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#aaa',
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 600
                            }
                        }
                    },
                    filler: {
                        propagate: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#222',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    }
                }
            }
        });

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
</body>
</html>
