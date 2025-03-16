<h1>Welcome to Login Management</h1>

<div class="container mt-5">
    <div class="card p-4 shadow-lg rounded">
        <h2 class="text-center">Login</h2>
        
        <!-- Login Form -->
        <form action="/login/authenticate" method="POST">
            <!-- Email Input -->
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password Input -->
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Register Link -->
        <p class="text-center mt-3">
            Don't have an account? <a href="/register">Register here</a>
        </p>
    </div>
</div>


