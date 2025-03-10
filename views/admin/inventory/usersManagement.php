<h1>Welcome to User Management</h1>

<div class="container mt-5">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Select</th>
                <th scope="col">Profile</th>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th> <!-- Added column for actions -->
            </tr>
        </thead>
        <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selectedRow" id="row<?= htmlspecialchars($user['id']) ?>">
                        </td>
                        <td>
                            <img src="<?= $user['profile'] ?>" 
                                 alt="Profile Image" 
                                 width="50" height="50" 
                                 class="rounded-circle">
                        </td>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <!-- Edit and Delete buttons for each user -->
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button onclick="deleteUser(<?= $user['id'] ?>)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
// Function to handle the Delete action
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Here, you would send an AJAX request to delete the user or redirect to a delete page
        window.location.href = `delete_user.php?id=${userId}`;
    }
}
</script>