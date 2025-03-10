<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
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
                            <a class="nav-link lang" data-en="product Detail" data-km="លំអិតផលិតផល" href="/product_detail">Product Detail</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link lang" data-en="Dashboard" data-km="ផ្ទាំងគ្រប់គ្រង" href="/admin">Dashboard</a>
                        </li>
                    </ul>
    
                    <!-- Right-side Menu -->
                    <div class="d-flex align-items-center gap-4">
                        <a class="nav-link lang text-nowrap" data-en="About" data-km="អំពី" href="/about">About</a>
                        <a class="nav-link lang text-nowrap" data-en="Contact" data-km="ទំនាក់ទំនង" href="/contact">Contact</a>
                        
                        <!-- Cart & Profile Icons with Offcanvas Sidebar -->
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                            <span class="cart-text me-2">$0.00</span>
                            <i class="bi bi-bag-check-fill" style="color:#007bff"></i>
                        </a>
                        <i class="bi bi-person-fill ms-2" style="color:#007bff; font-size: 24px;"></i>

    
                        <!-- Language Toggle Button -->
                        <button class="btn btn-outline-primary btn-sm text-nowrap" id="langToggle">ភាសាខ្មែរ</button>
                    </div>
                </div>                        
            </div>
        </nav>
    
        <!-- Offcanvas Shopping Cart -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="cartOffcanvasLabel">Shopping Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="images/sample-product.jpg" alt="Hand Sanitizer" class="me-3" width="50">
                    <img src="images/sample-product.jpg" alt="Hand Sanitizer" class="me-3" width="50">
                    <img src="images/sample-product.jpg" alt="Hand Sanitizer" class="me-3" width="50">
                    <div>
                        <p class="mb-1">Hand Sanitizer</p>
                        <p class="mb-0">1 × £15.00</p>
                    </div>
                    <button class="btn btn-sm btn-outline-danger ms-auto">×</button>
                </div>
                <hr>
                <p class="text-end">Subtotal: <strong>£15.00</strong></p>
                <button class="btn btn-success w-100 mb-2">VIEW CART</button>
                <button class="btn btn-primary w-100">CHECKOUT</button>
            </div>
        </div>
    </header>
    