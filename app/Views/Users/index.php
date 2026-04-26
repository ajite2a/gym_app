<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="color: #ccff00; margin-bottom: 5px;"><?= $title ?> Management</h2>
        <p style="color: #888;">Manage all <?= strtolower($title) ?></p>
    </div>
    <a href="<?= route_to('users.form.create', $role) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New <?= ucfirst($role) ?>
    </a>
</div>

<!-- Users DataTable -->
<div class="dashboard-card">
    <?php if (empty($users)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No <?= strtolower($title) ?> found. 
            <a href="<?= route_to('users.form.create', $role) ?>" class="btn btn-primary btn-sm">Create one now</a>
        </div>
    <?php else: ?>
        <table id="usersTable" class="table table-hover" style="color: #aaa; width: 100%; margin-bottom: 0;">
            <thead>
                <tr style="border-bottom: 2px solid #ccff00;">
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">ID</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Profile</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Name</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Email</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Phone</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Status</th>
                    <th style="background-color: #ccff00; color: #000; text-align: center; padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $user['id'] ?></td>
                        <td>
                            <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; border: 2px solid #333; background: rgba(20, 25, 40, 0.8);">
                                <?php if (!empty($user['profile_picture'])): ?>
                                    <img src="<?= base_url('uploads/' . $user['profile_picture']) ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #666;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <strong><?= esc($user['name']) ?></strong>
                        </td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= $user['phone'] ? esc($user['phone']) : '<span style="color: #666;">-</span>' ?></td>
                        <td>
                            <span class="badge" style="background-color: <?= $user['status'] === 'active' ? '#44ff44' : '#ff4444' ?>; color: #000; padding: 8px 12px;">
                                <?= ucfirst($user['status']) ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= route_to('users.form.edit', $role, $user['id']) ?>" class="btn btn-outline-yellow" style="color: #000;" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-outline-danger" onclick="confirmDelete(<?= $user['id'] ?>, '<?= addslashes($user['name']) ?>')" title="Delete">
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
                <p>Are you sure you want to delete <strong id="userName" style="color: #ccff00;"></strong>?</p>
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
    $('#usersTable').DataTable({
        "ordering": true,
        "paging": true,
        "pageLength": 10,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "columnDefs": [{"targets": -1, "orderable": false}],
        "language": {
            "search": "Search <?= strtolower($role) ?>s:",
            "paginate": {
                "first": "First",
                "previous": "Prev",
                "next": "Next",
                "last": "Last"
            },
            "info": "Showing _START_ to _END_ of _TOTAL_ <?= strtolower($role) ?>s",
            "infoEmpty": "No <?= strtolower($role) ?>s found"
        },
        "dom": '<"top"lf>rt<"bottom"ip>'
    });
});

function confirmDelete(id, name) {
    document.getElementById('userName').textContent = name;
    document.getElementById('deleteForm').action = '/users/<?= $role ?>/delete/' + id;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
<style>
    #usersTable_wrapper .dataTables_filter input {
        background: rgba(20, 25, 40, 0.8) !important;
        border: 2px solid #333 !important;
        color: #aaa !important;
    }
    #usersTable_wrapper .dataTables_length select {
        background: rgba(20, 25, 40, 0.8) !important;
        border: 2px solid #333 !important;
        color: #aaa !important;
    }
    #usersTable_paginate .paginate_button.current {
        background: #ccff00 !important;
        color: #000 !important;
    }
    #usersTable_paginate .paginate_button:hover {
        background: rgba(204, 255, 0, 0.3) !important;
        color: #ccff00 !important;
    }
</style>
<?= $this->endSection() ?>
