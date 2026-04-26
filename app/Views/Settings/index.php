<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-4">
    <h2 style="color: #ccff00; margin-bottom: 5px;">Settings</h2>
    <p style="color: #888;">Manage your account settings and preferences</p>
</div>

<!-- Settings Container -->
<div class="row">
    <!-- Sidebar Menu -->
    <div class="col-md-3">
        <div class="dashboard-card" style="padding: 0; border: 2px solid #333; border-radius: 8px;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li>
                    <a href="#password" class="settings-menu-item active" style="display: block; padding: 15px 20px; color: #ccff00; text-decoration: none; border-bottom: 1px solid #333; cursor: pointer; transition: all 0.3s;">
                        <i class="fas fa-lock" style="margin-right: 10px;"></i> Change Password
                    </a>
                </li>
                <li>
                    <a href="#profile" class="settings-menu-item" style="display: block; padding: 15px 20px; color: #aaa; text-decoration: none; border-bottom: 1px solid #333; cursor: pointer; transition: all 0.3s;">
                        <i class="fas fa-user" style="margin-right: 10px;"></i> Profile Information
                    </a>
                </li>
                <li>
                    <a href="#notifications" class="settings-menu-item" style="display: block; padding: 15px 20px; color: #aaa; text-decoration: none; cursor: pointer; transition: all 0.3s;">
                        <i class="fas fa-bell" style="margin-right: 10px;"></i> Notifications
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="col-md-9">
        
        <!-- Change Password Section -->
        <div id="password" class="settings-section">
            <div class="dashboard-card">
                <h4 style="color: #ccff00; margin-bottom: 20px;">
                    <i class="fas fa-lock"></i> Change Password
                </h4>

                <form method="POST" action="<?= route_to('settings.resetPassword') ?>" novalidate>
                    <?= csrf_field() ?>

                    <!-- Error Messages -->
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(255, 68, 68, 0.2); border: 1px solid #ff4444; color: #ff4444; margin-bottom: 20px;">
                            <i class="fas fa-exclamation-circle"></i> <strong>Validation Errors:</strong>
                            <ul class="mb-0 mt-2" style="padding-left: 20px;">
                                <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Current Password -->
                    <div class="mb-4">
                        <label for="current_password" class="form-label" style="color: #ccff00;">Current Password <span style="color: #ff4444;">*</span></label>
                        <input
                            type="password"
                            class="form-control <?= session()->getFlashdata('errors.current_password') ? 'is-invalid' : '' ?>"
                            id="current_password"
                            name="current_password"
                            value="<?= old('current_password') ?>"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <?php if (session()->getFlashdata('errors.current_password')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.current_password') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr style="border-color: #ccff00; margin: 30px 0;">

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="new_password" class="form-label" style="color: #ccff00;">New Password <span style="color: #ff4444;">*</span></label>
                        <input
                            type="password"
                            class="form-control <?= session()->getFlashdata('errors.new_password') ? 'is-invalid' : '' ?>"
                            id="new_password"
                            name="new_password"
                            value="<?= old('new_password') ?>"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <?php if (session()->getFlashdata('errors.new_password')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.new_password') ?>
                            </div>
                        <?php endif; ?>
                        <small style="color: #666; display: block; margin-top: 5px;">
                            <i class="fas fa-info-circle"></i> Must be at least 6 characters long
                        </small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label" style="color: #ccff00;">Confirm New Password <span style="color: #ff4444;">*</span></label>
                        <input
                            type="password"
                            class="form-control <?= session()->getFlashdata('errors.confirm_password') ? 'is-invalid' : '' ?>"
                            id="confirm_password"
                            name="confirm_password"
                            value="<?= old('confirm_password') ?>"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <?php if (session()->getFlashdata('errors.confirm_password')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.confirm_password') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 30px;">
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Clear
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div id="profile" class="settings-section" style="display: none;">
            <div class="dashboard-card">
                <h4 style="color: #ccff00; margin-bottom: 20px;">
                    <i class="fas fa-user"></i> Profile Information
                </h4>

                <div style="color: #aaa;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong style="color: #ccff00;">Full Name:</strong>
                            <p><?= esc($user['name']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong style="color: #ccff00;">Email:</strong>
                            <p><?= esc($user['email']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong style="color: #ccff00;">Role:</strong>
                            <p><?= ucfirst($user['role']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong style="color: #ccff00;">Status:</strong>
                            <p>
                                <?php
                                    $statusColor = $user['status'] === 'active' ? '#44ff44' : '#ffaa00';
                                ?>
                                <span style="background-color: <?= $statusColor ?>; color: #000; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600;">
                                    <?= ucfirst($user['status']) ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong style="color: #ccff00;">Joined Date:</strong>
                            <p><?= date('M d, Y', strtotime($user['joined_at'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong style="color: #ccff00;">Last Login:</strong>
                            <p><?= $user['last_login'] ? date('M d, Y H:i', strtotime($user['last_login'])) : 'Never' ?></p>
                        </div>
                    </div>

                    <p style="color: #666; font-size: 0.9rem; margin-top: 20px;">
                        <i class="fas fa-info-circle"></i> To update your profile information, please contact the administrator.
                    </p>
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div id="notifications" class="settings-section" style="display: none;">
            <div class="dashboard-card">
                <h4 style="color: #ccff00; margin-bottom: 20px;">
                    <i class="fas fa-bell"></i> Notifications
                </h4>

                <div style="color: #aaa;">
                    <p style="color: #666; font-style: italic;">
                        <i class="fas fa-info-circle"></i> Notification settings coming soon...
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.querySelectorAll('.settings-menu-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove active class from all items
        document.querySelectorAll('.settings-menu-item').forEach(i => {
            i.style.color = '#aaa';
        });

        // Add active class to clicked item
        this.style.color = '#ccff00';

        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show selected section
        const target = this.getAttribute('href');
        document.querySelector(target).style.display = 'block';
    });
});
</script>
<?= $this->endSection() ?>
