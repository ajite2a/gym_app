<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <h1>Welcome, <?= $user_name ?? 'User' ?>!</h1>
    <p>Manage your gym efficiently with our dashboard</p>
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
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
</script>
<?= $this->endSection() ?>
