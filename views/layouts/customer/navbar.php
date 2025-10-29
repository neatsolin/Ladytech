<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Discount function
if (!function_exists('getDiscountedPrice')) {
    function getDiscountedPrice($price, $coupon) {
        if (!$coupon) return $price;
        return $coupon['discount_type'] === 'percentage'
            ? $price * (1 - $coupon['discount_value'] / 100)
            : max(0, $price - $coupon['discount_value']);
    }
}
$applied_coupon = $_SESSION['applied_coupon'] ?? null;

// Detect product page
$is_product_page = (basename($_SERVER['SCRIPT_NAME']) === 'product.php' || $_SERVER['REQUEST_URI'] === '/product');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* === CART STYLES === */
        .cart-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 12px; border-bottom: 1px solid #eee; font-family: "Poppins", sans-serif;
            background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,.1); margin-bottom: 8px;
        }
        .cart-items { max-height: 300px; overflow-y: auto; padding-right: 5px; }
        .cart-items::-webkit-scrollbar { width: 6px; }
        .cart-items::-webkit-scrollbar-thumb { background: #aaa; border-radius: 10px; }
        .cart-item img { width: 50px; height: 50px; border-radius: 5px; object-fit: cover; margin-right: 10px; }
        .cart-item-details { flex: 1; display: flex; flex-direction: column; }
        .cart-item-name { font-weight: 600; font-size: 14px; color: #333; }
        .cart-item-price, .cart-item-total { font-size: 13px; color: #666; }
        .cart-item-price .original-price { text-decoration: line-through; color: #999; margin-right: 5px; }
        .cart-item-price .discounted-price { color: #28a745; font-weight: bold; }
        .delete-icon {
            cursor: pointer; color: #888; font-size: 16px; display: flex; align-items: center;
            justify-content: center; width: 30px; height: 30px; border-radius: 50%; background: #f8f8f8;
            transition: .2s;
        }
        .delete-icon:hover { background: #dc3545; color: #fff; }

        /* === CART DROPDOWN === */
        .navbar .cart-container .cart-dropdown {
            display: none !important; flex-direction: column; justify-content: space-between;
            position: absolute; top: 54px; right: -200px; width: 380px; height: 80vh;
            background: #d1cece; box-shadow: 0 5px 10px rgba(0,0,0,.1); border-radius: 8px;
            padding: 20px; z-index: 999;
        }
        .navbar .cart-container .cart-dropdown.show {
            display: flex !important; animation: slideInFromRight .5s ease-out forwards;
        }
        @keyframes slideInFromRight { 0% { right: -400px; } 100% { right: -180px; } }
        .cart-subtotal {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 15px; padding: 10px 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;
            font-size: 1.1rem; font-weight: bold; color: #333;
        }

        /* === USER PROFILE TABS === */
        .nav.drp-tabs.nav-fill .nav-item { margin: 0 10px; }
        .nav.drp-tabs.nav-fill .nav-link {
            color: #6c757d; border: none; background: transparent; padding: .5rem 1rem;
            transition: color .3s, border-bottom .3s;
        }
        .nav.drp-tabs.nav-fill .nav-link.active { color: teal; border-bottom: 2px solid teal; }
        .nav.drp-tabs.nav-fill .nav-link:hover { color: teal; }
        .dropdown-user-profile { min-width: 300px; }
        .tab-content-layout { display: flex; gap: 20px; padding: 10px; }
        .tab-content-layout .tab-pane {
            flex: 1; display: none; opacity: 0; transform: translateX(20px);
            transition: opacity .4s, transform .4s;
        }
        .tab-content-layout .tab-pane.active.show {
            display: block; opacity: 1; transform: translateX(0);
        }
        .dropdown-item {
            display: flex; align-items: center; gap: 10px; padding: .5rem 1rem;
            color: #333; text-decoration: none; transition: background .3s;
        }
        .dropdown-item:hover { background: #f8f9fa; }
        .dropdown-item i { font-size: 1.2rem; }

        /* === NAVBAR === */
        .navbar {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; background: #fff;
        }
        .navbar .navbar-nav .nav-link,
        .navbar .navbar-brand,
        .navbar #langToggle { color: #000 !important; }
        .navbar .navbar-nav .nav-link:hover { color: teal !important; }

        /* === PRODUCT DROPDOWN (only on product page) === */
        <?php if ($is_product_page): ?>
        .product-dropdown { position: relative; }
        .product-dropdown:hover .product-menu { display: block; }
        .product-menu {
            display: none; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
            background: #fff; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,.15);
            padding: 20px; min-width: 220px; z-index: 1001; animation: fadeIn .3s ease-out;
        }
        .product-menu::before {
            content: ''; position: absolute; top: -10px; left: 50%; transform: translateX(-50%);
            border-left: 10px solid transparent; border-right: 10px solid transparent;
            border-bottom: 10px solid #fff;
        }
        .product-menu ul { list-style: none; padding: 0; margin: 0; }
        .product-menu li {
            padding: 12px 0; border-bottom: 1px solid #eee; font-family: "Poppins", sans-serif;
            font-size: 15px; color: #333; transition: color .2s;
        }
        .product-menu li:last-child { border-bottom: none; }
        .product-menu li:hover { color: teal; }
        .product-menu li a { color: inherit; text-decoration: none; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-50%) translateY(-10px); }
            to { opacity: 1; transform: translateX(-50%) translateY(0); }
        }
        <?php endif; ?>
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top px-4">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="/">
            <img src="/views/assets/images/image1.png" alt="Logo">
        </a>

        <!-- Mobile toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item me-3">
                    <a class="nav-link active lang" data-en="Shops" data-km="ហាង" href="/">Home</a>
                </li>

                <!-- PRODUCTS with dropdown -->
                <li class="nav-item me-3 <?php echo $is_product_page ? 'product-dropdown' : ''; ?>">
                    <a class="nav-link lang" data-en="Product" data-km="ប្រភេទ" href="/product">PRODUCTS</a>
                    <?php if ($is_product_page): ?>
                    <div class="product-menu">
                        <ul>
                            <li><a href="/product?category=electronics">Electronics</a></li>
                            <li><a href="/product?category=mobile-phones">Mobile Phones</a></li>
                            <li><a href="/product?category=laptops">Laptops</a></li>
                            <li><a href="/product?category=accessories">Accessories</a></li>
                            <li><a href="/product?category=home-appliances">Home Appliances</a></li>
                            <li><a href="/product?category=fashion">Fashion</a></li>
                            <li><a href="/product?category=books">Books</a></li>
                            <li><a href="/product?category=toys">Toys</a></li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </li>

                <!-- Admin Dashboard -->
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
                <li class="nav-item me-3">
                    <a class="nav-link lang" data-en="Dashboard" data-km="ផ្ទាំងគ្រប់គ្រង" href="/admin">DASHBOARD</a>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Right side -->
            <div class="d-flex align-items-center gap-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="nav-link lang text-nowrap" data-en="About" data-km="អំពី" href="/about">ABOUT</a>
                    <a class="nav-link lang text-nowrap" data-en="Contact" data-km="ទំនាក់ទំនង" href="/contact">CONTACT</a>
                <?php endif; ?>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a class="nav-link lang text-nowrap" data-en="Login" data-km="ចូល" href="/F_login">LOGIN</a>
                <?php endif; ?>

                <!-- Cart -->
                <div class="cart-container">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="icon-cart" onclick="toggleCart()">
                            <i class="bi bi-cart"></i>
                            <span id="cart-count">0</span>
                        </div>
                    <?php endif; ?>

                    <div class="cart-dropdown" id="cartDropdown">
                        <div><h4>CART</h4><div class="cart-items"></div></div>
                        <div class="cart-total">
                            <div class="cart-subtotal" style="display:none;">
                                <span class="subtotal-label">Subtotal:</span>
                                <span class="subtotal-amount">$0.00</span>
                            </div>
                            <a href="/viewcart"><button id="view-cart" class="checkout-btn" style="display:none;">VIEW CART</button></a>
                            <a href="/checkouts"><button id="checkoutBtn" class="checkout-btn" style="display:none;">CHECKOUT</button></a>
                            <button id="continueShoppingBtn" class="checkout-btn" style="background:green;display:none;" onclick="window.location.href='/product'">CONTINUE SHOPPING</button>
                        </div>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="ms-auto">
                    <ul class="list-unstyled">
                        <li class="dropdown pc-h-item header-user-profile">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" data-bs-auto-close="outside">
                                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_profile'])): ?>
                                    <img src="<?php echo htmlspecialchars($_SESSION['user_profile']); ?>" alt="user-image" class="user-avtar"
                                         style="width:35px;height:35px;border-radius:50%;border:3px solid #fff;box-shadow:rgba(0,0,0,.05) 0 0 0 1px;"
                                         onerror="this.src='/assets/images/user/avatar-2.jpg';">
                                <?php else: ?>
                                    <img src="/assets/images/user/avatar-2.jpg" alt="default" class="user-avtar"
                                         style="width:35px;height:35px;border-radius:50%;border:3px solid #fff;box-shadow:rgba(0,0,0,.05) 0 0 0 1px;">
                                <?php endif; ?>
                            </a>

                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <div class="dropdown-header">
                                        <div class="d-flex mb-1">
                                            <div class="flex-shrink-0">
                                                <img src="<?php echo htmlspecialchars($_SESSION['user_profile'] ?? '/assets/images/user/avatar-2.jpg'); ?>" alt="user" class="user-avtar wid-35"
                                                     style="width:45px;height:45px;border-radius:50%;border:2px solid #fff;"
                                                     onerror="this.src='/assets/images/user/avatar-2.jpg';">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?></h6>
                                                <span><?php echo htmlspecialchars($_SESSION['user_role'] ?? 'N/A'); ?></span>
                                            </div>
                                            <a href="/logout" class="pc-head-link bg-transparent">
                                                <i class="ti ti-power text-danger" style="font-size:20px;"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#drp-tab-1"><i class="ti ti-user"></i> Profile</button></li>
                                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#drp-tab-2"><i class="ti ti-settings"></i> Setting</button></li>
                                    </ul>

                                    <div class="tab-content-layout">
                                        <div class="tab-pane fade active show" id="drp-tab-1">
                                            <?php if ($_SESSION['user_role'] ?? '' === 'admin'): ?>
                                                <a href="/admin" class="dropdown-item"><i class="ti ti-dashboard"></i><span>Admin Dashboard</span></a>
                                            <?php endif; ?>
                                            <a href="#!" class="dropdown-item"><i class="ti ti-edit-circle"></i><span>Edit Profile</span></a>
                                            <a href="#!" class="dropdown-item"><i class="ti ti-user"></i><span>View Profile</span></a>
                                            <a href="#!" class="dropdown-item"><i class="ti ti-clipboard-list"></i><span>Social Profile</span></a>
                                            <a href="#!" class="dropdown-item"><i class="ti ti-wallet"></i><span>Billing</span></a>
                                            <a href="/logout" class="dropdown-item"><i class="ti ti-power"></i><span>Logout</span></a>
                                        </div>
                                        <div class="tab-pane fade" id="drp-tab-2">
                                            <a href="#!" class="dropdown-item"><i class="ti ti-help"></i><span>Support</span></a>
                                            <a href="#!" class="dropdown-item"><i class="ti ti-user"></i><span>Account Settings</span></a>
                                            <a href="#!" class="dropdown-item"><i class="ti ti-lock"></i><span>Privacy Center</span></a>
                                            <?php if ($_SESSION['user_role'] ?? '' === 'users'): ?>
                                                <a href="#!" class="dropdown-item"><i class="ti ti-messages"></i><span>Feedback</span></a>
                                                <a href="/order_h" class="dropdown-item"><i class="ti ti-list"></i><span>History</span></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="dropdown-header">
                                        <div class="d-flex flex-column align-items-center p-3">
                                            <img src="/assets/images/user/avatar-2.jpg" alt="guest" class="user-avtar mb-2"
                                                 style="width:60px;height:60px;border-radius:50%;border:3px solid #fff;box-shadow:rgba(0,0,0,.05) 0 0 0 1px;">
                                            <h6 class="mb-2">Guest User</h6>
                                            <p class="text-muted text-center">Please log in or register.</p>
                                            <div class="d-flex gap-2">
                                                <a href="/F_login" class="btn btn-primary btn-sm">Login</a>
                                                <a href="/F_register" class="btn btn-outline-primary btn-sm">Register</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Language Toggle -->
                <button class="btn btn-outline-primary btn-sm text-nowrap" id="langToggle">ភាសាខ្មែរ</button>
            </div>
        </div>
    </div>
</nav>

<!-- =================================== -->
<!--           JAVASCRIPT               -->
<!-- =================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // 1. Language Toggle
    let currentLang = "en";
    const langToggle = document.getElementById("langToggle");
    if (langToggle) {
        langToggle.addEventListener("click", function () {
            currentLang = currentLang === "en" ? "km" : "en";
            document.querySelectorAll(".lang").forEach(el => {
                const txt = el.getAttribute(`data-${currentLang}`);
                if (txt) el.textContent = txt;
            });
            this.textContent = currentLang === "en" ? "ភាសាខ្មែរ" : "English";
        });
    }

    // 2. Profile Tabs
    document.querySelectorAll('.nav.drp-tabs .nav-link').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            document.querySelectorAll('.nav.drp-tabs .nav-link').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content-layout .tab-pane').forEach(p => p.classList.remove('active','show'));
            btn.classList.add('active');
            const pane = document.querySelector(btn.dataset.bsTarget);
            if (pane) pane.classList.add('active','show');
        });
    });

    // 3. PRODUCT MENU HOVER (only on product page)
    <?php if ($is_product_page): ?>
    const prodLink = document.querySelector('.product-dropdown > .nav-link');
    const prodMenu = document.querySelector('.product-menu');
    if (prodLink && prodMenu) {
        const show = () => prodMenu.style.display = 'block';
        const hide = () => prodMenu.style.display = 'none';
        prodLink.addEventListener('mouseenter', show);
        prodMenu.addEventListener('mouseenter', show);
        prodLink.addEventListener('mouseleave', hide);
        prodMenu.addEventListener('mouseleave', hide);
    }
    <?php endif; ?>

    // 4. CART FUNCTIONS
    const appliedCoupon = <?php echo json_encode($applied_coupon); ?>;

    window.addToCart = async function(productId) {
        if (!productId) return alert('Invalid product ID');
        try {
            const r = await fetch('/cart/add', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `product_id=${encodeURIComponent(productId)}&quantity=1`
            });
            const d = await r.json();
            if (d.success) fetchCartItems();
            else {
                if (d.message === 'User not logged in') {
                    alert('Please log in to add items to your cart.');
                    location.href = '/F_login';
                } else alert(d.message || 'Failed');
            }
        } catch (e) { console.error(e); alert('Network error'); }
    };

    window.removeFromCart = async function(productId) {
        try {
            const r = await fetch('/cart/remove', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `product_id=${encodeURIComponent(productId)}`
            });
            const d = await r.json();
            if (d.success) fetchCartItems();
            else alert(d.message || 'Failed');
        } catch (e) { console.error(e); }
    };

    async function fetchCartItems() {
        try {
            const r = await fetch('/cart/items');
            const d = await r.json();
            if (d.success) {
                renderCart(d.data || []);
                updateCount(d.data || []);
            } else {
                renderCart([]);
                updateCount([]);
            }
        } catch (e) { console.error(e); renderCart([]); }
    }

    function updateCount(items) {
        const el = document.getElementById('cart-count');
        if (el) el.textContent = items.reduce((s,i)=>s+(parseInt(i.quantity)||0),0);
    }

    function renderCart(items) {
        const cont   = document.querySelector('#cartDropdown .cart-items');
        const subSec = document.querySelector('.cart-subtotal');
        const subAmt = document.querySelector('.subtotal-amount');
        const viewBtn = document.getElementById('view-cart');
        const chkBtn  = document.getElementById('checkoutBtn');
        const contBtn = document.getElementById('continueShoppingBtn');

        cont.innerHTML = '';
        if (!items.length) {
            cont.innerHTML = '<p>No products in the cart.</p>';
            subSec.style.display = 'none';
            viewBtn.style.display = chkBtn.style.display = 'none';
            contBtn.style.display = 'block';
            return;
        }

        let total = 0;
        items.forEach(it => {
            const price = parseFloat(it.price)||0;
            const qty   = parseInt(it.quantity)||1;
            const disc  = getDiscountedPrice(price, appliedCoupon);
            const line  = disc * qty;
            total += line;

            const div = document.createElement('div');
            div.className = 'cart-item';
            div.innerHTML = `
                <img src="${it.imageURL||'/default-image.jpg'}" alt="${it.productname||'Product'}">
                <div class="cart-item-details">
                    <span class="cart-item-name">${it.productname||'Unknown'}</span>
                    <span class="cart-item-price">
                        ${appliedCoupon && disc<price ? `<span class="original-price">$${price.toFixed(2)}</span>
                        <span class="discounted-price">$${disc.toFixed(2)}</span>` : `$${price.toFixed(2)}`} × ${qty}
                    </span>
                    <span class="cart-item-total">$${line.toFixed(2)}</span>
                </div>
                <span class="delete-icon" onclick="removeFromCart(${it.product_id})"><i class="bi bi-trash"></i></span>
            `;
            cont.appendChild(div);
        });

        subSec.style.display = 'flex';
        subAmt.textContent = `$${total.toFixed(2)}`;
        viewBtn.style.display = chkBtn.style.display = 'block';
        contBtn.style.display = 'none';
    }

    function getDiscountedPrice(price, coupon) {
        if (!coupon) return price;
        return coupon.discount_type === 'percentage'
            ? price * (1 - coupon.discount_value/100)
            : Math.max(0, price - coupon.discount_value);
    }

    window.toggleCart = function() {
        const dd = document.getElementById('cartDropdown');
        if (dd.classList.contains('show')) dd.classList.remove('show');
        else { dd.classList.add('show'); fetchCartItems(); }
    };

    // Load cart on login
    <?php if (isset($_SESSION['user_id'])): ?> fetchCartItems(); <?php endif; ?>

});
</script>
</body>
</html>