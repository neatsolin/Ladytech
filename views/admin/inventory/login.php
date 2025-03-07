<h1>Welcome to Login Management</h1>
<!-- Example form in your view for user registration -->
<form action="/store" method="POST">
    <div class="form-group mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <input type="hidden" name="role" value="user">
    <button type="submit" class="btn btn-primary">Register</button>
</form>
