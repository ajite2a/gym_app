<?php
    $currentUri = current_url(false);
    $isActive = function($route) use ($currentUri) {
        return strpos($currentUri, $route) !== false ? 'active' : '';
    };
?>
<!-- Navbar Partial -->
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
                    <a class="nav-link <?= $isActive('/dashboard') ?>" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $isActive('/users/member') ?>" href="<?= route_to('users', 'member') ?>">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $isActive('/users/trainer') ?>" href="<?= route_to('users', 'trainer') ?>">Trainers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $isActive('/plans') ?>" href="/plans">Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $isActive('/subscriptions') ?>" href="<?= route_to('subscriptions') ?>">Subscriptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $isActive('/settings') ?>" href="/settings">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
