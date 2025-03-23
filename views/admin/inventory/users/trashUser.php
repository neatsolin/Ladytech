<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    $this->redirect('/login');
}
?>


    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-content {
            padding: 2.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid #dee2e6;
        }

        .header h2 {
            font-weight: 700;
            color: #212529;
            font-size: 1.75rem;
        }

        .header h2 span {
            color: #6c757d;
            font-weight: 400;
            margin: 0 0.5rem;
        }

        .search-bar input {
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .action-buttons .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
            background-color: #fff;
        }

        .table th {
            background-color: #212529;
            color: #fff;
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .role-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
        }

        .checkbox {
            width: 2.5rem;
        }

        .actions-column {
            width: 5rem;
            text-align: center;
        }

        .action-menu-btn {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #6c757d;
            transition: color 0.2s ease;
        }

        .action-menu-btn:hover {
            color: #212529;
        }

        .dropdown-menu {
            min-width: 8rem;
            border-radius: 0.375rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }

            .header h2 {
                font-size: 1.5rem;
            }

            .search-bar {
                width: 100% !important;
                margin-top: 1rem;
            }

            .action-buttons {
                gap: 0.75rem !important;
                justify-content: center;
            }

            .action-buttons .btn {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
                flex: 1 1 45%;
                max-width: none;
            }

            .table th, .table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }

            .profile-img {
                width: 30px;
                height: 30px;
            }

            .checkbox {
                width: 2rem;
            }

            .actions-column {
                width: 4rem;
            }

            .action-menu-btn {
                font-size: 1rem;
            }
        }
    </style>

    <div class="main-content">
        <div class="header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="mb-0">Recycle Bin <span>User Management</span></h2>
            <div class="col-md-4 col-lg-3 search-bar">
                <input type="text" class="form-control rounded-pill" placeholder="Search deleted users" id="recycleSearchInput">
            </div>
        </div>

        <div class="action-buttons d-flex flex-wrap gap-3 mb-4">
            <button class="btn btn-outline-primary" onclick="restoreSelected()" id="restoreBtn" disabled>
                <i class="fas fa-undo me-2"></i> Restore Selection
            </button>
            <button class="btn btn-outline-danger" onclick="deleteSelected()" id="deleteBtn" disabled>
                <i class="fas fa-trash me-2"></i> Delete Selection
            </button>
            <button class="btn btn-danger" onclick="emptyRecycleBin()" id="emptyBtn">
                <i class="fas fa-trash-alt me-2"></i> Empty Recycle Bin
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle" id="recycleBinTable">
                        <thead>
                            <tr>
                                <th class="checkbox"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                <th>Profile</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Deleted</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="recycleBinTableBody">
                            <?php if (!empty($deletedUsers)): ?>
                                <?php foreach ($deletedUsers as $user): ?>
                                    <tr data-id="<?= htmlspecialchars($user['id']) ?>">
                                        <td class="checkbox"><input type="checkbox" class="recycleCheckbox form-check-input" data-id="<?= htmlspecialchars($user['id']) ?>"></td>
                                        <td><img src="<?= htmlspecialchars($user['profile']) ?>" alt="Profile" class="profile-img"></td>
                                        <td><?= htmlspecialchars($user['username']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= htmlspecialchars($user['phone']) ?></td>
                                        <td>
                                            <span class="role-badge text-white px-3 py-1" style="border-radius: 20px; font-size: 12px; background-color: 
                                                <?php echo ($user['role'] == 'Admin') ? '#dc3545' : 
                                                (($user['role'] == 'User') ? '#ffc107' : '#28a745'); ?>;">
                                                <?= htmlspecialchars($user['role']) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($user['deleted_at']) ?></td>
                                        <td class="actions-column">
                                            <div class="dropdown">
                                                <button class="action-menu-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item text-success restore-user" href="#" data-id="<?= htmlspecialchars($user['id']) ?>">
                                                        <i class="fas fa-undo me-2"></i>Restore</a></li>
                                                    <li><a class="dropdown-item text-danger permanent-delete" href="#" data-id="<?= htmlspecialchars($user['id']) ?>">
                                                        <i class="fas fa-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No deleted users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById("recycleSearchInput").addEventListener("input", function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll("#recycleBinTableBody tr");
            rows.forEach(row => {
                const username = row.querySelector("td:nth-child(3)")?.textContent.toLowerCase();
                const email = row.querySelector("td:nth-child(4)")?.textContent.toLowerCase();
                if (username && email) {
                    row.style.display = (username.includes(searchTerm) || email.includes(searchTerm)) ? "" : "none";
                }
            });
        });

        // Select all checkbox
        document.getElementById("selectAll").addEventListener("change", function() {
            document.querySelectorAll(".recycleCheckbox").forEach(cb => cb.checked = this.checked);
            updateRecycleButtonStates();
        });

        // Update button states
        document.addEventListener("change", e => {
            if (e.target.classList.contains("recycleCheckbox")) updateRecycleButtonStates();
        });

        function updateRecycleButtonStates() {
            const checkboxes = document.querySelectorAll(".recycleCheckbox:checked");
            document.getElementById("restoreBtn").disabled = checkboxes.length === 0;
            document.getElementById("deleteBtn").disabled = checkboxes.length === 0;
            document.getElementById("emptyBtn").disabled = document.querySelectorAll("#recycleBinTableBody tr").length === 0 || !document.querySelectorAll(".recycleCheckbox").length;
        }

        // Restore selected users
        function restoreSelected() {
            const checkboxes = document.querySelectorAll(".recycleCheckbox:checked");
            const ids = Array.from(checkboxes).map(cb => cb.dataset.id);
            if (ids.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to restore the selected users?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore them!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ids.forEach(id => {
                            window.location.href = `/admin/inventory/users/restore/${id}`;
                        });
                    }
                });
            }
        }

        // Permanently delete selected users
        function deleteSelected() {
            const checkboxes = document.querySelectorAll(".recycleCheckbox:checked");
            const ids = Array.from(checkboxes).map(cb => cb.dataset.id);
            if (ids.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the selected users!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete them!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ids.forEach(id => {
                            window.location.href = `/admin/inventory/users/permanentDelete/${id}`;
                        });
                    }
                });
            }
        }

        // Empty recycle bin
        function emptyRecycleBin() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete all users in the recycle bin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, empty it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/inventory/users/emptyRecycleBin';
                }
            });
        }

        // Individual restore
        document.querySelectorAll('.restore-user').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to restore this user?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/inventory/users/restore/${id}`;
                    }
                });
            });
        });

        // Individual permanent delete
        document.querySelectorAll('.permanent-delete').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the user!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/inventory/users/permanentDelete/${id}`;
                    }
                });
            });
        });

        // Initial button state update
        document.addEventListener("DOMContentLoaded", updateRecycleButtonStates);
    </script>
