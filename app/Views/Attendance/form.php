<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-4">
    <h2 style="color: #ccff00; margin-bottom: 5px;"><?= $title ?></h2>
    <p style="color: #888;">
        <a href="<?= route_to('attendance') ?>" style="color: #ccff00; text-decoration: none;">Attendance</a>
        <i class="fas fa-chevron-right"></i> <?= $title ?>
    </p>
</div>

<!-- Main Row: Form (left) and Info (right) -->
<div class="row">
    <!-- Form Column (col-md-8) -->
    <div class="col-md-8">
        <!-- Form Card -->
        <div class="dashboard-card">
            <form method="POST" action="<?= $action === 'update' ? route_to('attendance.form.edit', $attendance['id']) : route_to('attendance.form') ?>" novalidate>
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

                <!-- Member -->
                <div class="mb-4">
                    <label for="user_id" class="form-label" style="color: #ccff00;">Member <span style="color: #ff4444;">*</span></label>
                    <select
                        class="form-select <?= session()->getFlashdata('errors.user_id') ? 'is-invalid' : '' ?>"
                        id="user_id"
                        name="user_id"
                        required
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <option value="">Select a member</option>
                        <?php foreach ($members as $member): ?>
                            <option value="<?= $member['id'] ?>" <?= old('user_id', $attendance['user_id'] ?? '') == $member['id'] ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">
                                <?= $member['name'] ?> (<?= $member['email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (session()->getFlashdata('errors.user_id')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.user_id') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Attendance Date -->
                <div class="mb-4">
                    <label for="attendance_date" class="form-label" style="color: #ccff00;">Attendance Date <span style="color: #ff4444;">*</span></label>
                    <div style="position: relative;">
                        <input
                            type="date"
                            class="form-control <?= session()->getFlashdata('errors.attendance_date') ? 'is-invalid' : '' ?>"
                            id="attendance_date"
                            name="attendance_date"
                            value="<?= old('attendance_date', $attendance['attendance_date'] ?? date('Y-m-d')) ?>"
                            required
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa; appearance: none; -webkit-appearance: none; -moz-appearance: none;">
                        <i class="fas fa-calendar-alt" onclick="document.getElementById('attendance_date').focus(); document.getElementById('attendance_date').click();" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #ccff00; cursor: pointer;"></i>
                    </div>
                    <?php if (session()->getFlashdata('errors.attendance_date')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.attendance_date') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Check In & Check Out Row -->
                <div class="row">
                    <!-- Check In Time -->
                    <div class="col-md-6 mb-4">
                        <label for="check_in_time" class="form-label" style="color: #ccff00;">Check In Time</label>
                        <input
                            type="time"
                            class="form-control <?= session()->getFlashdata('errors.check_in_time') ? 'is-invalid' : '' ?>"
                            id="check_in_time"
                            name="check_in_time"
                            value="<?= old('check_in_time', $attendance['check_in_time'] ?? '') ?>"
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <?php if (session()->getFlashdata('errors.check_in_time')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.check_in_time') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Check Out Time -->
                    <div class="col-md-6 mb-4">
                        <label for="check_out_time" class="form-label" style="color: #ccff00;">Check Out Time</label>
                        <input
                            type="time"
                            class="form-control <?= session()->getFlashdata('errors.check_out_time') ? 'is-invalid' : '' ?>"
                            id="check_out_time"
                            name="check_out_time"
                            value="<?= old('check_out_time', $attendance['check_out_time'] ?? '') ?>"
                            style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <?php if (session()->getFlashdata('errors.check_out_time')): ?>
                            <div class="invalid-feedback" style="display: block; color: #ff4444;">
                                <?= session()->getFlashdata('errors.check_out_time') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label" style="color: #ccff00;">Status <span style="color: #ff4444;">*</span></label>
                    <select
                        class="form-select <?= session()->getFlashdata('errors.status') ? 'is-invalid' : '' ?>"
                        id="status"
                        name="status"
                        required
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;">
                        <option value="">Select status</option>
                        <option value="present" <?= old('status', $attendance['status'] ?? '') === 'present' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Present</option>
                        <option value="absent" <?= old('status', $attendance['status'] ?? '') === 'absent' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Absent</option>
                        <option value="late" <?= old('status', $attendance['status'] ?? '') === 'late' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Late</option>
                        <option value="early_leave" <?= old('status', $attendance['status'] ?? '') === 'early_leave' ? 'selected' : '' ?> style="background: #1a1f2e; color: #aaa;">Early Leave</option>
                    </select>
                    <?php if (session()->getFlashdata('errors.status')): ?>
                        <div class="invalid-feedback" style="display: block; color: #ff4444;">
                            <?= session()->getFlashdata('errors.status') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label for="notes" class="form-label" style="color: #ccff00;">Notes</label>
                    <textarea
                        class="form-control"
                        id="notes"
                        name="notes"
                        rows="3"
                        placeholder="Add any notes or remarks"
                        style="background: rgba(20, 25, 40, 0.8); border: 2px solid #333; color: #aaa;"><?= old('notes', $attendance['notes'] ?? '') ?></textarea>
                </div>

                <!-- Form Actions -->
                <div class="d-flex gap-2 justify-content-end">
                    <a href="<?= route_to('attendance') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> <?= $action === 'update' ? 'Update Record' : 'Record Attendance' ?>
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
                <li>Select a member and attendance date</li>
                <li>Check In and Check Out times are optional</li>
                <li>Status is required to categorize attendance</li>
                <li>Add notes for any special circumstances</li>
            </ul>
        </div>

        <!-- Requirements Card -->
        <div class="dashboard-card">
            <h5 style="color: #ccff00; margin-bottom: 15px;">
                <i class="fas fa-check-circle"></i> Status Types
            </h5>
            <ul style="color: #aaa; padding-left: 20px; margin-bottom: 0;">
                <li><strong style="color: #44ff44;">Present:</strong> Member attended</li>
                <li><strong style="color: #ff4444;">Absent:</strong> Member did not attend</li>
                <li><strong style="color: #ffaa00;">Late:</strong> Member arrived late</li>
                <li><strong style="color: #ffaa00;">Early Leave:</strong> Member left early</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
