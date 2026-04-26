<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="color: #ccff00; margin-bottom: 5px;">Subscriptions Management</h2>
        <p style="color: #888;">Manage all gym subscriptions</p>
    </div>
    <a href="<?= route_to('subscriptions.form.create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Subscription
    </a>
</div>

<!-- Subscriptions DataTable -->
<div class="dashboard-card">
    <?php if (empty($subscriptions)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No subscriptions found. 
            <a href="<?= route_to('subscriptions.form.create') ?>" class="btn btn-primary btn-sm">Create one now</a>
        </div>
    <?php else: ?>
        <table id="subscriptionsTable" class="table table-hover" style="color: #aaa; width: 100%; margin-bottom: 0;">
            <thead>
                <tr style="border-bottom: 2px solid #ccff00;">
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">ID</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Member</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Plan</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Start Date</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">End Date</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Status</th>
                    <th style="background-color: #ccff00; color: #000; text-align: center; padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscriptions as $sub): ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $sub['id'] ?></td>
                        <td>
                            <strong><?= esc($sub['user_name']) ?></strong><br>
                            <small style="color: #666;"><?= esc($sub['user_email']) ?></small>
                        </td>
                        <td>
                            <strong><?= esc($sub['plan_name']) ?></strong><br>
                            <small style="color: #666;">$<?= number_format($sub['plan_price'], 2) ?></small>
                        </td>
                        <td><?= date('M d, Y', strtotime($sub['start_date'])) ?></td>
                        <td><?= date('M d, Y', strtotime($sub['end_date'])) ?></td>
                        <td>
                            <?php
                                $statusColor = match($sub['status']) {
                                    'active' => '#44ff44',
                                    'inactive' => '#ffaa00',
                                    'expired' => '#ff4444',
                                    'cancelled' => '#ff4444',
                                    default => '#aaa'
                                };
                            ?>
                            <span class="badge" style="background-color: <?= $statusColor ?>; color: #000; padding: 8px 12px;">
                                <?= ucfirst($sub['status']) ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= route_to('subscriptions.form.edit', $sub['id']) ?>" class="btn btn-outline-yellow" style="color: #000;" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-outline-danger" onclick="confirmDelete(<?= $sub['id'] ?>, '<?= addslashes($sub['user_name']) ?>')" title="Delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(30, 35, 50, 0.95); border: 2px solid #333;">
            <div class="modal-header" style="border-bottom: 2px solid #ccff00;">
                <h5 class="modal-title" style="color: #ccff00;">
                    <i class="fas fa-trash"></i> Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body" style="color: #aaa;">
                <p>Are you sure you want to delete subscription for <strong id="memberName" style="color: #ccff00;"></strong>?</p>
                <p style="color: #666; font-size: 0.9rem;"><i class="fas fa-warning"></i> This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#subscriptionsTable').DataTable({
        "ordering": true,
        "paging": true,
        "pageLength": 10,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "columnDefs": [{"targets": -1, "orderable": false}],
        "language": {
            "search": "Search subscriptions:",
            "paginate": {
                "first": "First",
                "previous": "Prev",
                "next": "Next",
                "last": "Last"
            },
            "info": "Showing _START_ to _END_ of _TOTAL_ subscriptions",
            "infoEmpty": "No subscriptions found"
        },
        "dom": '<"top"lf>rt<"bottom"ip>'
    });
});

function confirmDelete(id, memberName) {
    document.getElementById('memberName').textContent = memberName;
    document.getElementById('deleteForm').action = '/subscriptions/delete/' + id;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
<style>
    #subscriptionsTable_wrapper .dataTables_filter input {
        background: rgba(20, 25, 40, 0.8) !important;
        border: 2px solid #333 !important;
        color: #aaa !important;
    }
    #subscriptionsTable_wrapper .dataTables_length select {
        background: rgba(20, 25, 40, 0.8) !important;
        border: 2px solid #333 !important;
        color: #aaa !important;
    }
    #subscriptionsTable_paginate .paginate_button.current {
        background: #ccff00 !important;
        color: #000 !important;
    }
    #subscriptionsTable_paginate .paginate_button:hover {
        background: rgba(204, 255, 0, 0.3) !important;
        color: #ccff00 !important;
    }
    #subscriptionsTable_paginate .paginate_button {
        background: transparent !important;
        border: none !important;
        color: #aaa !important;
        margin: 2px;
    }
    #subscriptionsTable_paginate .paginate_button.disabled {
        color: #666 !important;
    }
    .btn-outline-yellow {
        color: #ccff00;
        border: 1px solid #ccff00;
    }
    .btn-outline-yellow:hover {
        background-color: #ccff00;
        color: #000;
    }
    .btn-outline-danger {
        color: #ff4444;
        border: 1px solid #ff4444;
    }
    .btn-outline-danger:hover {
        background-color: #ff4444;
        color: #fff;
    }
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .alert-info {
        background: rgba(68, 255, 68, 0.1) !important;
        border: 1px solid #44ff44 !important;
        color: #aaa !important;
    }
    .alert-info a {
        color: #ccff00 !important;
    }
</style>
<?= $this->endSection() ?>
