<h1>Welcome to Register Management</h1>
<form action="/register/store" method="POST" enctype="multipart/form-data">
    <div class="input-with-icon">
        <input type="text" name="username" placeholder="Username" required>
        <span class="icon"><i class="fas fa-user"></i></span>
    </div>
    <div class="input-with-icon">
        <input type="email" name="email" placeholder="Email Address" required>
        <span class="icon"><i class="fas fa-envelope"></i></span>
    </div>
    <div class="input-with-icon">
        <input type="text" name="phone" placeholder="Phone Number" required>
        <span class="icon"><i class="fas fa-phone"></i></span>
    </div>
    <div class="input-with-icon">
        <input type="password" name="password" placeholder="Password" required>
        <span class="icon"><i class="fas fa-lock"></i></span>
    </div>
    <div class="input-with-icon">
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <span class="icon"><i class="fas fa-users"></i></span>
    </div>
    <div class="form-group">
            <label for="imageURL">Profile Image</label>
            <input type="file" class="form-control" id="imageURL" name="profile">
        </div>
    <button type="submit" class="btn btn-outline btn-block">Register</button>
</form>

