
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<h1>Welcome to User Management</h1>

<div class="container mt-5">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Select</th>
                <th scope="col">Profile</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th style="text-align:center" scope="col">Actions</th> <!-- Added column for actions -->
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
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td style="text-align: center; vertical-align: middle;" >
                            <!-- Edit and Delete buttons for each user -->
                            <a href="/users/edit/<?= $user['id'] ?>"><i class="material-icons">edit</i></a>
                            <a href="#" class="material-icons text-danger delete-user"
                                data-id="<?= $user['id'] ?>">
                                
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Include SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert Delete Confirmation
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor action
            const userId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete action
                    window.location.href = `/users/delete/${userId}`;
                }
            });
        });
    });
</script>