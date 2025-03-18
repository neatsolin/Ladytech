<style>
.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    border-bottom: 1px solid #eee;
    font-family: "Poppins", sans-serif; /* Modern & clean font */
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 8px;
}

/* Container for cart items with scroll */
.cart-items {
    max-height: 300px; /* Limit height */
    overflow-y: auto;  /* Enable scroll */
    padding-right: 5px; /* Prevent content cutoff */
}

/* Improve scrollbar design */
.cart-items::-webkit-scrollbar {
    width: 6px;
}

.cart-items::-webkit-scrollbar-thumb {
    background: #aaa;
    border-radius: 10px;
}

.cart-item img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    object-fit: cover;
    margin-right: 10px;
}

.cart-item-details {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.cart-item-name {
    font-weight: 600;
    font-size: 14px;
    color: #333;
}

.cart-item-price,
.cart-item-total {
    font-size: 13px;
    color: #666;
}

/* Delete button */
.delete-icon {
    cursor: pointer;
    color: #888;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #f8f8f8;
    transition: 0.2s ease-in-out;
}

.delete-icon:hover {
    background: #dc3545;
    color: #fff;
}

/* Bootstrap trash icon */
.delete-icon .bi-trash {
    font-size: 14px;
}

</style>
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
                        <i class="bi bi-cart"></i> <!-- Bootstrap cart icon -->
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


