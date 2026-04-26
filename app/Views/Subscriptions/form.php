<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <h1><i class="fas fa-credit-card"></i> <?= $action === 'create' ? 'Add New Subscription' : 'Edit Subscription' ?></h1>
    <p><?= $action === 'create' ? 'Create a new gym subscription' : 'Update subscription details' ?></p>
</div>

<div class="row">
    <!-- Form Column -->
    <div class="col-md-8">
        <div class="form-card" style="background: rgba(20, 25, 40, 0.8); border-radius: 8px; padding: 20px; border: 2px solid #333;">
            <!-- Error Messages -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert" style="background: #ff4444; color: #fff; padding: 12px 16px; border-radius: 4px; margin-bottom: 20px;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <div><?= $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" style="display: flex; flex-direction: column;">
                <?= csrf_field() ?>

                <!-- User & Plan Row -->
                <div class="row">
                    <!-- User -->
                    <div class="col-md-6 mb-4">
                        <label for="user_id" class="form-label" style="color: #ccff00;">Member <span style="color: #ff4444;">*</span></label>
                        <select 
                            class="form-control <?= session()->getFlashdata('errors.user_id') ? 'is-invalid' : '' ?>" 
                            id="user_id" 
                            name="user_id" 
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                            <option value="">Select a member</option>
                            <?php foreach ($users as $user): ?>
                                <?php if ($user['role'] !== 'admin'): ?>
                                    <option value="<?= $user['id'] ?>" <?= old('user_id', $subscription['user_id'] ?? '') == $user['id'] ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">
                                        <?= $user['name'] ?> (<?= $user['email'] ?>)
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session()->getFlashdata('errors.user_id')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.user_id') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Plan -->
                    <div class="col-md-6 mb-4">
                        <label for="plan_id" class="form-label" style="color: #ccff00;">Plan <span style="color: #ff4444;">*</span></label>
                        <select 
                            class="form-control <?= session()->getFlashdata('errors.plan_id') ? 'is-invalid' : '' ?>" 
                            id="plan_id" 
                            name="plan_id" 
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                        >
                            <option value="">Select a plan</option>
                            <?php foreach ($plans as $plan): ?>
                                <option value="<?= $plan['id'] ?>" <?= old('plan_id', $subscription['plan_id'] ?? '') == $plan['id'] ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">
                                    <?= $plan['name'] ?> - $<?= number_format($plan['price'], 2) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session()->getFlashdata('errors.plan_id')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.plan_id') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Start Date & End Date Row -->
                <div class="row">
                    <!-- Start Date -->
                    <div class="col-md-6 mb-4">
                        <label for="start_date" class="form-label" style="color: #ccff00;">Start Date <span style="color: #ff4444;">*</span></label>
                        <div style="position: relative;">
                            <input 
                                type="date" 
                                class="form-control <?= session()->getFlashdata('errors.start_date') ? 'is-invalid' : '' ?>" 
                                id="start_date" 
                                name="start_date" 
                                value="<?= old('start_date', $subscription['start_date'] ?? '') ?>"
                                required
                                style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            >
                            <i class="fas fa-calendar-alt" onclick="document.getElementById('start_date').focus(); document.getElementById('start_date').click();" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #ccff00; cursor: pointer; pointer-events: auto;"></i>
                        </div>
                        <?php if (session()->getFlashdata('errors.start_date')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.start_date') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6 mb-4">
                        <label for="end_date" class="form-label" style="color: #ccff00;">End Date <span style="color: #ff4444;">*</span></label>
                        <div style="position: relative;">
                            <input 
                                type="date" 
                                class="form-control <?= session()->getFlashdata('errors.end_date') ? 'is-invalid' : '' ?>" 
                                id="end_date" 
                                name="end_date" 
                                value="<?= old('end_date', $subscription['end_date'] ?? '') ?>"
                                required
                                style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            >
                            <i class="fas fa-calendar-alt" onclick="document.getElementById('end_date').focus(); document.getElementById('end_date').click();" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #ccff00; cursor: pointer; pointer-events: auto;"></i>
                        </div>
                        <?php if (session()->getFlashdata('errors.end_date')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.end_date') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label" style="color: #ccff00;">Status <span style="color: #ff4444;">*</span></label>
                    <select 
                        class="form-control <?= session()->getFlashdata('errors.status') ? 'is-invalid' : '' ?>" 
                        id="status" 
                        name="status" 
                        required
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"
                    >
                        <option value="">Select status</option>
                        <option value="active" <?= old('status', $subscription['status'] ?? '') == 'active' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Active</option>
                        <option value="inactive" <?= old('status', $subscription['status'] ?? '') == 'inactive' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Inactive</option>
                        <option value="expired" <?= old('status', $subscription['status'] ?? '') == 'expired' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Expired</option>
                        <option value="cancelled" <?= old('status', $subscription['status'] ?? '') == 'cancelled' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Cancelled</option>
                    </select>
                    <?php if (session()->getFlashdata('errors.status')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.status') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn" style="background: #ccff00; color: #000; padding: 10px 20px; border: none; border-radius: 4px; font-weight: 600; cursor: pointer; flex: 1;">
                        <i class="fas fa-save"></i> <?= $action === 'create' ? 'Create Subscription' : 'Update Subscription' ?>
                    </button>
                    <a href="<?= route_to('subscriptions') ?>" class="btn" style="background: #333; color: #aaa; padding: 10px 20px; border: 1px solid #666; border-radius: 4px; text-decoration: none; flex: 1; text-align: center;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Column -->
    <div class="col-md-4">
        <!-- Information Card -->
        <div style="background: rgba(20, 25, 40, 0.8); border-radius: 8px; padding: 20px; border: 2px solid #333; margin-bottom: 20px;">
            <h5 style="color: #ccff00; margin-bottom: 15px;">
                <i class="fas fa-info-circle"></i> Information
            </h5>
            <p style="color: #aaa; font-size: 14px; line-height: 1.6;">
                Create and manage gym subscriptions for members. Choose a member, select a plan, and set the subscription dates.
            </p>
        </div>

        <!-- Requirements Card -->
        <div style="background: rgba(20, 25, 40, 0.8); border-radius: 8px; padding: 20px; border: 2px solid #333;">
            <h5 style="color: #ccff00; margin-bottom: 15px;">
                <i class="fas fa-list-check"></i> Requirements
            </h5>
            <ul style="color: #aaa; font-size: 14px; padding-left: 20px; line-height: 1.8;">
                <li>Member must be selected</li>
                <li>Plan must be selected</li>
                <li>Start date must be before end date</li>
                <li>Status indicates subscription state</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
