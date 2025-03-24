<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    $this->redirect('/login');
}
?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Users</h1>
        <table class="table table-bordered table-striped table-hover" style="border-radius: 15px; overflow: hidden;">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="border-top-left-radius: 10px;">Profile</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th style="text-align:center; border-top-right-radius: 10px;" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php
                    // Check if the user is active (last login within the last 5 minutes)
                    $lastLogin = isset($user['last_login']) ? strtotime($user['last_login']) : null;
                    $currentTime = time();
                    $isActive = ($lastLogin && ($currentTime - $lastLogin) <= 300); // 300 seconds = 5 minutes

                    // If last login is NULL, user is Inactive
                    $statusLabel = $isActive ? 'Active' : 'Inactive';
                    $statusColor = $isActive ? '#28a745' : '#dc3545';
                    ?>
                    <tr>
                        <td class="text-center">
                            <img src="/<?= $user['profile'] ?>" alt="Profile Image" width="50" height="50" class="rounded-circle">
                        </td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td>
                            <span class="badge text-white px-3 py-1" style="border-radius: 20px; font-size: 12px; background-color: 
                                <?= ($user['role'] == 'Admin') ? '#dc3545' : 
                                (($user['role'] == 'User') ? '#ffc107' : '#28a745'); ?>;">
                                <?= htmlspecialchars($user['role']) ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge text-white px-3 py-1" style="border-radius: 20px; font-size: 12px; background-color: 
                                <?= $user['status'] === 'Active' ? '#28a745' : '#dc3545'; ?>;">
                                <?= $user['status'] ?>
                            </span>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <div class="dropdown">
                                <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none;">
                                    <i class="material-icons"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/users/edit/<?= $user['id'] ?>">
                                        <i class="material-icons">edit</i> Edit</a></li>
                                    <li><a class="dropdown-item text-danger delete-user" href="#" data-id="<?= $user['id'] ?>">
                                        <i class="material-icons">delete</i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert Move to Trash Confirmation
        document.querySelectorAll('.delete-user').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default anchor action
                const userId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This user will be moved to the trash!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, move to trash!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to move-to-trash action
                        window.location.href = `/users/delete/${userId}`;
                    }
                });
            });
        });
    </script>
