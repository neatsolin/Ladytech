<h1>Welcome to User Management</h1>
<div class="container mt-5">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Select</th> <!-- Checkbox column -->
                <th scope="col">Profile</th>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selectedRow" id="row<?= htmlspecialchars($user['id']) ?>">
                        </td>
                        <td>
                            <img src="uploads/profiles/<?= htmlspecialchars($user['profile']) ?>" 
                                 alt="Profile Image" width="50" height="50" 
                                 class="rounded-circle">
                        </td>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>