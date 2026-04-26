<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="color: #ccff00; margin-bottom: 5px;">Welcome back, <?= $user_name ?? 'User' ?>!</h2>
        <p style="color: #888;">Here's what's happening at your gym today.</p>
    </div>
    <div style="display: flex; gap: 15px; align-items: center;">
        <div style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; border-radius: 6px; padding: 8px 15px; color: #aaa;">
            <i class="fas fa-calendar"></i> <span id="currentDate">21 May 2025</span>
        </div>
        <div style="position: relative;">
            <i class="fas fa-bell" style="color: #ccff00; font-size: 20px; cursor: pointer;"></i>
            <span style="position: absolute; top: -5px; right: -5px; background: #ff4444; color: #fff; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px;">0</span>
        </div>
        <div style="width: 40px; height: 40px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; cursor: pointer;">
            <?= strtoupper(substr($user_name ?? 'U', 0, 2)) ?>
        </div>
    </div>
</div>

<!-- Stats Cards Row -->
<div class="row mb-4">
    <!-- Total Members -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="border-left: 4px solid #ccff00;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: #888; margin-bottom: 10px; font-size: 14px;">Total Members</p>
                    <h3 style="color: #ccff00; margin: 0; font-size: 32px;">256</h3>
                    <p style="color: #44ff44; margin-top: 10px; font-size: 12px;">↑ 18 this month</p>
                </div>
                <div style="width: 50px; height: 50px; background: rgba(204, 255, 0, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ccff00;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Trainers -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="border-left: 4px solid #ccff00;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: #888; margin-bottom: 10px; font-size: 14px;">Total Trainers</p>
                    <h3 style="color: #ccff00; margin: 0; font-size: 32px;">18</h3>
                    <p style="color: #44ff44; margin-top: 10px; font-size: 12px;">↑ 2 this month</p>
                </div>
                <div style="width: 50px; height: 50px; background: rgba(204, 255, 0, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ccff00;">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Subscriptions -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="border-left: 4px solid #ccff00;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: #888; margin-bottom: 10px; font-size: 14px;">Active Subscriptions</p>
                    <h3 style="color: #ccff00; margin: 0; font-size: 32px;">214</h3>
                    <p style="color: #44ff44; margin-top: 10px; font-size: 12px;">↑ 16 this month</p>
                </div>
                <div style="width: 50px; height: 50px; background: rgba(204, 255, 0, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ccff00;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Attendance -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="border-left: 4px solid #ccff00;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: #888; margin-bottom: 10px; font-size: 14px;">Today's Attendance</p>
                    <h3 style="color: #ccff00; margin: 0; font-size: 32px;">146</h3>
                    <p style="color: #44ff44; margin-top: 10px; font-size: 12px;">57% of members</p>
                </div>
                <div style="width: 50px; height: 50px; background: rgba(204, 255, 0, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ccff00;">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Additional Stats Row -->
<div class="row mb-4">
    <!-- Membership Overview Chart -->
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 style="color: #ccff00; margin: 0; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                    <i class="fas fa-chart-line"></i> Membership Overview
                </h5>
                <select style="background: rgba(20, 25, 40, 0.8); border: 1px solid #333; color: #aaa; padding: 6px 10px; border-radius: 4px; cursor: pointer;">
                    <option>This Month</option>
                    <option>Last Month</option>
                    <option>This Year</option>
                </select>
            </div>
            <canvas id="membershipChart"></canvas>
        </div>
    </div>

    <!-- Subscription Status Chart -->
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 style="color: #ccff00; margin: 0; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                    <i class="fas fa-pie-chart"></i> Subscription Status
                </h5>
            </div>
            <div style="display: flex; align-items: center; gap: 30px;">
                <div style="flex: 1; display: flex; justify-content: center;">
                    <canvas id="subscriptionChart" style="max-width: 200px;"></canvas>
                </div>
                <div style="flex: 1;">
                    <div style="margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span style="color: #44ff44; font-weight: 600;">Active</span>
                            <span style="color: #aaa;">214 (84%)</span>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span style="color: #ffaa00; font-weight: 600;">Expiring Soon</span>
                            <span style="color: #aaa;">28 (11%)</span>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span style="color: #ff4444; font-weight: 600;">Expired</span>
                            <span style="color: #aaa;">14 (5%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Cards Row -->
<div class="row mb-4">
    <!-- New Members -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="text-align: center; border: 1px solid #44ff44;">
            <div style="font-size: 28px; color: #44ff44; margin-bottom: 10px;">
                <i class="fas fa-user-plus"></i>
            </div>
            <p style="color: #888; margin-bottom: 5px; font-size: 13px;">New Members</p>
            <h3 style="color: #44ff44; margin: 0;">42</h3>
        </div>
    </div>

    <!-- Expired Members -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="text-align: center; border: 1px solid #ffaa00;">
            <div style="font-size: 28px; color: #ffaa00; margin-bottom: 10px;">
                <i class="fas fa-user-times"></i>
            </div>
            <p style="color: #888; margin-bottom: 5px; font-size: 13px;">Expired Members</p>
            <h3 style="color: #ffaa00; margin: 0;">12</h3>
        </div>
    </div>

    <!-- Expiring Soon -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="text-align: center; border: 1px solid #ffaa00;">
            <div style="font-size: 28px; color: #ffaa00; margin-bottom: 10px;">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <p style="color: #888; margin-bottom: 5px; font-size: 13px;">Expiring Soon</p>
            <h3 style="color: #ffaa00; margin: 0;">28</h3>
        </div>
    </div>

    <!-- Expired Subscriptions -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="dashboard-card" style="text-align: center; border: 1px solid #ff4444;">
            <div style="font-size: 28px; color: #ff4444; margin-bottom: 10px;">
                <i class="fas fa-times-circle"></i>
            </div>
            <p style="color: #888; margin-bottom: 5px; font-size: 13px;">Expired Subscriptions</p>
            <h3 style="color: #ff4444; margin: 0;">14</h3>
        </div>
    </div>
</div>

<!-- Recent Members & Subscriptions Row -->
<div class="row">
    <!-- Recent Members -->
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 style="color: #ccff00; margin: 0; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                    <i class="fas fa-users"></i> Recent Members
                </h5>
                <a href="<?= route_to('users', 'member') ?>" style="color: #ccff00; text-decoration: none; font-size: 12px;">View All →</a>
            </div>
            <div class="table-responsive">
                <table style="width: 100%; color: #aaa; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 1px solid #333;">
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Name</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Plan</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Joined On</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">RS</div>
                                    <span>Rahul Sharma</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Power Pack</td>
                            <td style="padding: 12px 0;">21 May 2025</td>
                            <td style="padding: 12px 0; text-align: center;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">AM</div>
                                    <span>Anjali Mehta</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Fit Plus</td>
                            <td style="padding: 12px 0;">20 May 2025</td>
                            <td style="padding: 12px 0; text-align: center;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">VS</div>
                                    <span>Vikram Singh</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Basic Plan</td>
                            <td style="padding: 12px 0;">19 May 2025</td>
                            <td style="padding: 12px 0; text-align: center;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">SK</div>
                                    <span>Sneha Kapoor</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Power Pack</td>
                            <td style="padding: 12px 0;">18 May 2025</td>
                            <td style="padding: 12px 0; text-align: center;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Subscriptions -->
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 style="color: #ccff00; margin: 0; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                    <i class="fas fa-credit-card"></i> Recent Subscriptions
                </h5>
                <a href="<?= route_to('subscriptions') ?>" style="color: #ccff00; text-decoration: none; font-size: 12px;">View All →</a>
            </div>
            <div class="table-responsive">
                <table style="width: 100%; color: #aaa; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 1px solid #333;">
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Member</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Plan</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Amount</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">Status</th>
                            <th style="color: #ccff00; padding: 10px 0; text-align: left;">End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">RS</div>
                                    <span>Rahul Sharma</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Power Pack</td>
                            <td style="padding: 12px 0;">₹4,999</td>
                            <td style="padding: 12px 0;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                            <td style="padding: 12px 0;">21 Jun 2025</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">AM</div>
                                    <span>Anjali Mehta</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Fit Plus</td>
                            <td style="padding: 12px 0;">₹3,499</td>
                            <td style="padding: 12px 0;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                            <td style="padding: 12px 0;">20 Jun 2025</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">VS</div>
                                    <span>Vikram Singh</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Basic Plan</td>
                            <td style="padding: 12px 0;">₹1,999</td>
                            <td style="padding: 12px 0;"><span style="background: rgba(68, 255, 68, 0.2); color: #44ff44; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Active</span></td>
                            <td style="padding: 12px 0;">19 Jun 2025</td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 0;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ccff00; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold; font-size: 12px;">SK</div>
                                    <span>Sneha Kapoor</span>
                                </div>
                            </td>
                            <td style="padding: 12px 0;">Power Pack</td>
                            <td style="padding: 12px 0;">₹4,999</td>
                            <td style="padding: 12px 0;"><span style="background: rgba(255, 170, 0, 0.2); color: #ffaa00; padding: 4px 8px; border-radius: 3px; font-size: 11px;">Expiring Soon</span></td>
                            <td style="padding: 12px 0;">05 Jun 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Update current date
    document.getElementById('currentDate').textContent = new Date().toLocaleDateString('en-GB', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });

    // Membership Overview Chart
    const membershipCtx = document.getElementById('membershipChart').getContext('2d');
    new Chart(membershipCtx, {
        type: 'line',
        data: {
            labels: ['1 May', '7 May', '13 May', '19 May', '25 May', '31 May'],
            datasets: [
                {
                    label: 'New Members',
                    data: [25, 38, 35, 40, 50, 35],
                    borderColor: '#ccff00',
                    backgroundColor: 'rgba(204, 255, 0, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ccff00',
                    pointBorderColor: '#ccff00',
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Expired Members',
                    data: [8, 12, 10, 15, 18, 20],
                    borderColor: '#aaa',
                    backgroundColor: 'rgba(170, 170, 170, 0.05)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4,
                    pointBackgroundColor: '#aaa',
                    pointBorderColor: '#aaa',
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: '#aaa', font: { size: 12 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(255, 255, 255, 0.05)' },
                    ticks: { color: '#666', font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#666', font: { size: 11 } }
                }
            }
        }
    });

    // Subscription Status Chart (Doughnut)
    const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
    new Chart(subscriptionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Expiring Soon', 'Expired'],
            datasets: [{
                data: [214, 28, 14],
                backgroundColor: ['#ccff00', '#ffaa00', '#ff4444'],
                borderColor: 'rgba(20, 25, 40, 0.8)',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
<?= $this->endSection() ?>
