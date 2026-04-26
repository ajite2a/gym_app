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
            <a href="/settings" class="<?= $isActive('/settings') ?>">
                <i class="fas fa-cog"></i> Settings
            </a>
        </li>
    </ul>
</div>
