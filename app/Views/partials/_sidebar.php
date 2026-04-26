<?php
    $currentUri = current_url(false);
    $isActive = function($route) use ($currentUri) {
        return strpos($currentUri, $route) !== false ? 'active' : '';
    };
?>
<!-- Sidebar Partial -->
<div class="sidebar" id="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="/dashboard" class="<?= $isActive('/dashboard') ?>">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= route_to('users', 'member') ?>" class="<?= $isActive('/users/member') ?>">
                <i class="fas fa-users"></i> Members
            </a>
        </li>
        <li>
            <a href="<?= route_to('users', 'trainer') ?>" class="<?= $isActive('/users/trainer') ?>">
                <i class="fas fa-user-tie"></i> Trainers
            </a>
        </li>
        <li>
            <a href="/plans" class="<?= $isActive('/plans') ?>">
                <i class="fas fa-list"></i> Plans
            </a>
        </li>
        <li>
            <a href="/attendance" class="<?= $isActive('/attendance') ?>">
                <i class="fas fa-clock"></i> Attendance
            </a>
        </li>
        <li>
            <a href="/subscriptions" class="<?= $isActive('/subscriptions') ?>">
                <i class="fas fa-credit-card"></i> Subscriptions
            </a>
        </li>
        <li>
            <a href="<?= route_to('settings') ?>" class="<?= $isActive('/settings') ?>">
                <i class="fas fa-cog"></i> Settings
            </a>
        </li>
    </ul>

    <!-- Sidebar Bottom Image -->
    <div style="margin-top: auto; padding: 15px 12px; text-align: center; border-top: 2px solid #333;">
        <img src="<?= base_url('default.png') ?>" alt="Sidebar" style="width: 100%; max-width: 200px; border-radius: 10px; box-shadow: 0 4px 15px rgba(204, 255, 0, 0.2); transition: all 0.3s ease; object-fit: cover;">
    </div>
</div>

<style>
    .sidebar {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    .sidebar-menu {
        flex-grow: 1;
    }

    .sidebar img:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(204, 255, 0, 0.4) !important;
    }
</style>
