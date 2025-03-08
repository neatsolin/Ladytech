<h1>Welcome to Register Management</h1>
<form action="/register" method="POST">
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
    <input type="hidden" name="role" value="user">
    <button type="submit" class="btn btn-outline btn-block">Register</button>
</form>
