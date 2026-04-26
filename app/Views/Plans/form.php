<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-4">
    <h2 style="color: #ccff00; margin-bottom: 5px;"><?= $title ?></h2>
    <p style="color: #888;">
        <a href="/plans" style="color: #ccff00; text-decoration: none;">Plans</a> 
        <i class="fas fa-chevron-right"></i> <?= $title ?>
    </p>
</div>

<!-- Main Row: Form (left) and Info (right) -->
<div class="row">
    <!-- Form Column (col-md-8) -->
    <div class="col-md-8">
        <!-- Form Card -->
        <div class="dashboard-card">
            <form method="POST" action="<?= $action === 'update' ? '/plans/form/' . $plan['id'] : '/plans/form' ?>" novalidate>
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

                <!-- Plan Name -->
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #ccff00;">Plan Name <span style="color: #ff4444;">*</span></label>
                    <input 
                        type="text" 
                        class="form-control <?= session()->getFlashdata('errors.name') ? 'is-invalid' : '' ?>" 
                        id="name" 
                        name="name" 
                        placeholder="Enter plan name (e.g., Basic, Premium, Elite)"
                        value="<?= old('name', $plan['name'] ?? '') ?>"
                        required
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                    >
                    <?php if (session()->getFlashdata('errors.name')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.name') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="form-label" style="color: #ccff00;">Price ($) <span style="color: #ff4444;">*</span></label>
                    <input 
                        type="number" 
                        step="0.01"
                        class="form-control <?= session()->getFlashdata('errors.price') ? 'is-invalid' : '' ?>" 
                        id="price" 
                        name="price" 
                        placeholder="Enter price"
                        value="<?= old('price', $plan['price'] ?? '') ?>"
                        required
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                    >
                    <?php if (session()->getFlashdata('errors.price')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.price') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Duration -->
                <div class="mb-4">
                    <label for="duration" class="form-label" style="color: #ccff00;">Duration (Days) <span style="color: #ff4444;">*</span></label>
                    <input 
                        type="number" 
                        class="form-control <?= session()->getFlashdata('errors.duration') ? 'is-invalid' : '' ?>" 
                        id="duration" 
                        name="duration" 
                        placeholder="Enter duration in days"
                        value="<?= old('duration', $plan['duration'] ?? '') ?>"
                        required
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                    >
                    <?php if (session()->getFlashdata('errors.duration')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.duration') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Form Actions -->
                <div class="d-flex gap-2 justify-content-end">
                    <a href="/plans" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> <?= $action === 'update' ? 'Update Plan' : 'Create Plan' ?>
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
                <li>Plan name should be unique and descriptive</li>
                <li>Price should be in decimal format (e.g., 29.99)</li>
                <li>Duration is in days (e.g., 30, 90, 365)</li>
            </ul>
        </div>

        <!-- Tips Card -->
        <div class="dashboard-card">
            <h5 style="color: #ccff00; margin-bottom: 15px;">
                <i class="fas fa-lightbulb"></i> Tips
            </h5>
            <ul style="color: #aaa; padding-left: 20px; margin-bottom: 0;">
                <li>Offer multiple plan tiers (Basic, Premium, Elite)</li>
                <li>Use consistent pricing strategy</li>
                <li><strong style="color: #ccff00;">Day Pass:</strong> 1 day</li>
                <li><strong style="color: #ccff00;">Basic:</strong> 30 days</li>
                <li><strong style="color: #ccff00;">Premium:</strong> 90 days</li>
                <li><strong style="color: #ccff00;">Elite:</strong> 365 days</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
