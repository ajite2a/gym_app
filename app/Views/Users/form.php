<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-4">
    <h2 style="color: #ccff00; margin-bottom: 5px;"><?= $title ?></h2>
    <p style="color: #888;">
        <a href="<?= route_to('users', $role) ?>" style="color: #ccff00; text-decoration: none;"><?= ucfirst($role) ?>s</a> 
        <i class="fas fa-chevron-right"></i> <?= $title ?>
    </p>
</div>

<!-- Main Row: Form (left) and Info (right) -->
<div class="row">
    <!-- Form Column (col-md-8) -->
    <div class="col-md-8">
        <!-- Form Card -->
        <div class="dashboard-card">
            <form method="POST" action="<?= $action === 'update' ? route_to('users.form.edit', $role, $user['id']) : route_to('users.form.create', $role) ?>" novalidate>
                <?= csrf_field() ?>
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <strong>Validation Errors:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
                    </div>
                <?php endif; ?>

                <!-- Name & Email Row -->
                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label" style="color: #ccff00;">Full Name <span style="color: #ff4444;">*</span></label>
                        <input 
                            type="text" 
                            class="form-control <?= session()->getFlashdata('errors.name') ? 'is-invalid' : '' ?>" 
                            id="name" 
                            name="name" 
                            placeholder="Enter full name"
                            value="<?= old('name', $user['name'] ?? '') ?>"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                        <?php if (session()->getFlashdata('errors.name')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.name') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-4">
                        <label for="email" class="form-label" style="color: #ccff00;">Email <span style="color: #ff4444;">*</span></label>
                        <input 
                            type="email" 
                            class="form-control <?= session()->getFlashdata('errors.email') ? 'is-invalid' : '' ?>" 
                            id="email" 
                            name="email" 
                            placeholder="Enter email address"
                            value="<?= old('email', $user['email'] ?? '') ?>"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                        <?php if (session()->getFlashdata('errors.email')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.email') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Password & Confirm Password Row (only on create) -->
                <?php if ($action === 'create'): ?>
                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label" style="color: #ccff00;">Password <span style="color: #ff4444;">*</span></label>
                        <input 
                            type="password" 
                            class="form-control <?= session()->getFlashdata('errors.password') ? 'is-invalid' : '' ?>" 
                            id="password" 
                            name="password" 
                            placeholder="Enter password (min. 6 characters)"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                        <?php if (session()->getFlashdata('errors.password')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.password') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6 mb-4">
                        <label for="confirm_password" class="form-label" style="color: #ccff00;">Confirm Password <span style="color: #ff4444;">*</span></label>
                        <input 
                            type="password" 
                            class="form-control <?= session()->getFlashdata('errors.confirm_password') ? 'is-invalid' : '' ?>" 
                            id="confirm_password" 
                            name="confirm_password" 
                            placeholder="Confirm password"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                        <?php if (session()->getFlashdata('errors.confirm_password')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.confirm_password') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Phone, Gender, Status Row -->
                <div class="row">
                    <!-- Phone -->
                    <div class="col-md-4 mb-4">
                        <label for="phone" class="form-label" style="color: #ccff00;">Phone</label>
                        <input 
                            type="tel" 
                            class="form-control" 
                            id="phone" 
                            name="phone" 
                            placeholder="Enter phone number"
                            value="<?= old('phone', $user['phone'] ?? '') ?>"
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                    </div>

                    <!-- Gender -->
                    <div class="col-md-4 mb-4">
                        <label for="gender" class="form-label" style="color: #ccff00;">Gender</label>
                        <select 
                            class="form-select" 
                            id="gender" 
                            name="gender"
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                            <option value="" selected>Select gender</option>
                            <option value="male" <?= old('gender', $user['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= old('gender', $user['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= old('gender', $user['gender'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4 mb-4">
                        <label for="status" class="form-label" style="color: #ccff00;">Status <span style="color: #ff4444;">*</span></label>
                        <select 
                            class="form-select" 
                            id="status" 
                            name="status"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                            <option value="active" <?= old('status', $user['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= old('status', $user['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="form-label" style="color: #ccff00;">Address</label>
                    <textarea 
                        class="form-control" 
                        id="address" 
                        name="address" 
                        rows="3"
                        placeholder="Enter address"
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                    ><?= old('address', $user['address'] ?? '') ?></textarea>
                </div>

                <!-- Form Actions -->
                <div class="d-flex gap-2 justify-content-end">
                    <a href="<?= route_to('users', $role) ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> <?= $action === 'update' ? 'Update ' . ucfirst($role) : 'Create ' . ucfirst($role) ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Column (col-md-4) -->
    <div class="col-md-4">
        <!-- Information Card -->
        <div class="dashboard-card" style="margin-bottom: 20px;">
            <h5 style="color: #ccff00; margin-bottom: 15px;">
                <i class="fas fa-info-circle"></i> Information
            </h5>
            <ul style="color: #aaa; padding-left: 20px; margin-bottom: 0;">
                <li>Fields marked with <span style="color: #ff4444;">*</span> are required</li>
                <li>Email must be unique and valid</li>
                <li>Password is only set during creation</li>
                <li>Status determines if user can access the system</li>
                <li>All personal details are optional</li>
            </ul>
        </div>

        <!-- Requirements Card -->
        <div class="dashboard-card">
            <h5 style="color: #ccff00; margin-bottom: 15px;">
                <i class="fas fa-check-circle"></i> Requirements
            </h5>
            <ul style="color: #aaa; padding-left: 20px; margin-bottom: 0;">
                <li><strong style="color: #ccff00;">Name:</strong> 2-255 characters</li>
                <li><strong style="color: #ccff00;">Email:</strong> Valid email format</li>
                <li><strong style="color: #ccff00;">Password:</strong> Minimum 6 characters (create only)</li>
                <li><strong style="color: #ccff00;">Phone:</strong> Optional, numeric only</li>
                <li><strong style="color: #ccff00;">Status:</strong> Active or Inactive</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
