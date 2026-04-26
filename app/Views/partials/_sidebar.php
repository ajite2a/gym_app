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
            <a href="/members" class="<?= $isActive('/members') ?>">
                <i class="fas fa-users"></i> Members
            </a>
        </li>
        <li>
            <a href="/trainers" class="<?= $isActive('/trainers') ?>">
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
