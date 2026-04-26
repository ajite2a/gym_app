<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <div>
        <h2 style="color: #ccff00; margin-bottom: 5px;">Plans Management</h2>
        <p style="color: #888;">Manage all membership plans</p>
    </div>
    <a href="/plans/form" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Plan
    </a>
</div>

<!-- Plans DataTable -->
<div class="dashboard-card">
    <?php if (empty($plans)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No plans found. 
            <a href="/plans/form" class="btn btn-primary btn-sm">Create one now</a>
        </div>
    <?php else: ?>
        <table id="plansTable" class="table table-hover" style="color: #aaa; width: 100%; margin-bottom: 0;">
            <thead>
                <tr style="border-bottom: 2px solid #ccff00;">
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">ID</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Plan Name</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Price</th>
                    <th style="background-color: #ccff00; color: #000; padding: 12px;">Duration (Days)</th>
                    <th style="background-color: #ccff00; color: #000; text-align: center; padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plans as $plan): ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $plan['id'] ?></td>
                        <td>
                            <strong><?= esc($plan['name']) ?></strong>
                        </td>
                        <td>
                            <strong style="background-color: #ccff00; color: #000; padding: 8px 12px; border-radius: 5px; display: inline-block;">$<?= number_format($plan['price'], 2) ?></strong>
                        </td>
                        <td>
                            <span class="badge" style="background-color: #ccff00; color: #000; padding: 8px 12px;">
                                <?= $plan['duration'] ?> day<?= $plan['duration'] > 1 ? 's' : '' ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group btn-group-sm">
                                <a href="/plans/form/<?= $plan['id'] ?>" class="btn btn-outline-yellow me-1" style="color: #000;" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-outline-danger" onclick="confirmDelete(<?= $plan['id'] ?>, '<?= addslashes($plan['name']) ?>')" title="Delete">
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
                <p>Are you sure you want to delete <strong id="planName" style="color: #ccff00;"></strong>?</p>
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

<style>
    /* DataTables Dark Theme Styling */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        color: #aaa;
    }

    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        background: rgba(20, 25, 40, 0.8);
        border: 2px solid #333;
        color: #aaa;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #ccff00;
        box-shadow: 0 0 5px rgba(204, 255, 0, 0.3);
    }

    .dataTables_wrapper .paginate_button.current,
    .dataTables_wrapper .paginate_button:hover {
        background: rgba(204, 255, 0, 0.2);
        border: 1px solid #ccff00;
        color: #ccff00 !important;
    }

    .dataTables_wrapper .paginate_button {
        color: #aaa !important;
        border: 1px solid #333;
        background: rgba(30, 35, 50, 0.5);
        border-radius: 5px;
        margin: 0 2px;
    }

    .dataTables_wrapper .paginate_button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    #plansTable tbody tr:hover {
        background-color: rgba(204, 255, 0, 0.1) !important;
    }

    /* DataTables Sorting */
    .dataTables_wrapper .sorting::before,
    .dataTables_wrapper .sorting::after,
    .dataTables_wrapper .sorting_asc::before,
    .dataTables_wrapper .sorting_asc::after,
    .dataTables_wrapper .sorting_desc::before,
    .dataTables_wrapper .sorting_desc::after {
        content: '';
    }

    .dataTables_wrapper th.sorting,
    .dataTables_wrapper th.sorting_asc,
    .dataTables_wrapper th.sorting_desc {
        cursor: pointer;
        position: relative;
        padding-right: 30px !important;
    }

    .dataTables_wrapper th.sorting::after {
        content: '↕';
        position: absolute;
        right: 10px;
        color: #888;
    }

    .dataTables_wrapper th.sorting_asc::after {
        content: '↑';
        position: absolute;
        right: 10px;
        color: #ccff00;
    }

    .dataTables_wrapper th.sorting_desc::after {
        content: '↓';
        position: absolute;
        right: 10px;
        color: #ccff00;
    }
</style>

<script>
    $(document).ready(function() {
        // Initialize DataTable with dark theme
        $('#plansTable').DataTable({
            "ordering": true,
            "paging": true,
            "pageLength": 10,
            "searching": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [
                {
                    "targets": -1,
                    "orderable": false
                }
            ],
            "language": {
                "search": "Search Plans:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ plans",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "emptyTable": "No plans available",
                "zeroRecords": "No matching plans found"
            },
            "dom": '<"top"lf>rt<"bottom"ip>'
        });
    });

    function confirmDelete(planId, planName) {
        document.getElementById('planName').textContent = planName;
        document.getElementById('deleteForm').action = '/plans/delete/' + planId;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
<?= $this->endSection() ?>
