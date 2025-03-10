<form method="POST" enctype="multipart/form-data">
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
        <input type="file" class="form-control" name="profile" id="profile">
        <input type="hidden" name="currentProfile" value="<?= htmlspecialchars($user['profile']) ?>">
        <img src="uploads/profiles/<?= htmlspecialchars($user['profile']) ?>" width="50" height="50" class="rounded-circle">
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
