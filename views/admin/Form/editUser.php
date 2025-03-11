<form action="/users/update/<?= $user['id']?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?>">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <input type="text" class="form-control" name="role" id="role" value="<?= htmlspecialchars($user['role']) ?>">
    </div>
    <div class="form-group">
        <label for="profile">Profile Image</label>
        <input type="file" class="form-control" name="profile" id="profile" accept="image/*">
        
        <!-- Image Preview -->
        <img id="profilePreview" src="/<?= $user['profile'] ?>" width="50" height="50" class="rounded-circle mt-2">
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <a href="/users" class="btn btn-secondary">Cancel</a>
</form>

<script>
    // JavaScript to update the profile image preview
    document.getElementById('profile').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader(); // Create a FileReader to read the file

            // Set up the FileReader onload event
            reader.onload = function(e) {
                // Update the src attribute of the image preview
                document.getElementById('profilePreview').src = e.target.result;
            };

            // Read the file as a Data URL (base64 encoded)
            reader.readAsDataURL(file);
        }
    });
</script>