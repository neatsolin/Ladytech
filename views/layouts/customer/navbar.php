<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top px-4">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="/">
            <img src="/views/assets/images/logo.png" alt="Logo">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item me-3">
                    <a class="nav-link active lang" data-en="Shops" data-km="ហាង" href="/">Shops</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link lang" data-en="Product" data-km="ប្រភេទ" href="/product">Product</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link lang" data-en="Product Detail" data-km="លំអិតផលិតផល" href="/product_detail">Product Detail</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link lang" data-en="Dashboard" data-km="ផ្ទាំងគ្រប់គ្រង" href="/admin">Dashboard</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-4">
                <a class="nav-link lang text-nowrap" data-en="About" data-km="អំពី" href="/about">About</a>
                <a class="nav-link lang text-nowrap" data-en="Contact" data-km="ទំនាក់ទំនង" href="/contact">Contact</a>
                <a class="nav-link lang text-nowrap" data-en="Login" data-km="ចូល" href="/F_login">Login</a>
                <!-- Cart Icon (Click to Toggle Dropdown) -->
                <div class="cart-container">
    <div class="icon-cart" onclick="toggleCart()">
        <i class="bi bi-cart"></i>
        <span id="cart-count">0</span> <!-- Cart count badge -->
    </div>

    <!-- Cart Dropdown -->
    <div class="cart-dropdown" id="cartDropdown">
        <h4>Cart</h4>
        <div class="cart-items">
            <!-- Cart items will be dynamically added here -->
        </div>
        <button class="checkout-btn">Checkout</button>
    </div>
</div>



                <i class="bi bi-person-fill ms-2" style="color:#007bff; font-size: 24px;"></i>

                <!-- Language Toggle Button -->
                <button class="btn btn-outline-primary btn-sm text-nowrap" id="langToggle">ភាសាខ្មែរ</button>
            </div>
        </div>                        
    </div>
</nav>


