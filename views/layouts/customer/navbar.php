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
                    <a class="nav-link active lang" data-en="Shops" data-km="ហាង" href="/">SHOP</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link lang" data-en="Product" data-km="ប្រភេទ" href="/product">PRODUCTS</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link lang" data-en="Product Detail" data-km="លំអិតផលិតផល" href="/product_detail">PRODUCT DETAIL</a>
                </li>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role']==='admin'): ?>
                    <li class="nav-item me-3">
                        <a class="nav-link lang" data-en="Dashboard" data-km="ផ្ទាំងគ្រប់គ្រង" href="/admin">DASHBOARD</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center gap-4">
                <a class="nav-link lang text-nowrap" data-en="About" data-km="អំពី" href="/about">ABOUT</a>
                <a class="nav-link lang text-nowrap" data-en="Contact" data-km="ទំនាក់ទំនង" href="/contact">CONTACT</a>
                <!-- Updated Login Link for Front-End Users -->
                 <?php if (!isset($_SESSION['user_id'])): ?>
                    <a class="nav-link lang text-nowrap" data-en="Login" data-km="ចូល" href="/F_login">LOGIN</a>
                <?php endif; ?>
                <!-- Cart Icon (Click to Toggle Dropdown) -->
                <div class="cart-container">
                    <div class="icon-cart" onclick="toggleCart()">
                        <i class="bi bi-cart"></i> <!-- Bootstrap cart icon -->
                        <span id="cart-count">0</span> <!-- Cart count badge -->
                    </div>

                    <!-- Cart Dropdown -->
                    <div class="cart-dropdown" id="cartDropdown">
                        <div>
                            <h4>CART</h4>
                            <div class="cart-items">
                                <!-- Cart items will be dynamically added here -->
                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-subtotal" style="display:none;">
                                <span class="subtotal-label">Subtotal:</span>
                                <span class="subtotal-amount">$0.00</span>
                            </div>
                            <button id="view-cart" class="checkout-btn" style="display: none;">VIEW CART</button>
                            <button id="checkoutBtn" class="checkout-btn" style="display: none;">CHECKOUT</button>
                            <button id="continueShoppingBtn" class="checkout-btn" style="background:green; display: none;" onclick="window.location.href='/product'">CONTINUE SHOPPING</button>
                        </div>    
                    </div>
                </div>
                <!-- profile -->
                <div class="ms-auto">
                    <ul class="list-unstyled">
                        <li class="dropdown pc-h-item header-user-profile">
                            <a
                                class="pc-head-link dropdown-toggle arrow-none me-0"
                                data-bs-toggle="dropdown"
                                href="#"
                                role="button"
                                aria-haspopup="false"
                                data-bs-auto-close="outside"
                                aria-expanded="false"
                            >
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <img src="<?= $_SESSION['user_profile'] ?>" alt="user-image" class="user-avtar" style="width: 35px; height: 35px; border-radius: 50%; border: 3px solid #fff; box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                                <?php else: ?>
                                    <!-- Show default profile icon if not logged in -->
                                    <img src="../../../assets/images/user/avatar-2.jpg" alt="default-profile-image" class="user-avtar" style="width: 35px; height: 35px; border-radius: 50%; border: 3px solid #fff; box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <!-- Show profile and settings if logged in -->
                                    <div class="dropdown-header">
                                        <div class="d-flex mb-1">
                                            <div class="flex-shrink-0">
                                                <img src="<?= $_SESSION['user_profile'] ?>" alt="user-image" class="user-avtar wid-35" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid #fff;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1"><?= $_SESSION['user_name'] ?></h6>
                                                <span><?= $_SESSION['user_role'] ?></span>
                                            </div>
                                            <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger" style="font-size: 20px;"></i></a>
                                        </div>
                                    </div>

                                    <!-- Tab Buttons -->
                                    <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link active"
                                                id="drp-t1"
                                                data-bs-toggle="tab"
                                                data-bs-target="#drp-tab-1"
                                                type="button"
                                                role="tab"
                                                aria-controls="drp-tab-1"
                                                aria-selected="true"
                                            >
                                                <i class="ti ti-user"></i> Profile
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link"
                                                id="drp-t2"
                                                data-bs-toggle="tab"
                                                data-bs-target="#drp-tab-2"
                                                type="button"
                                                role="tab"
                                                aria-controls="drp-tab-2"
                                                aria-selected="false"
                                            >
                                                <i class="ti ti-settings"></i> Setting
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content-layout">
                                        <!-- Profile Tab Content (Left Side) -->
                                        <div class="tab-pane fade active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                                <a href="/admin" class="dropdown-item">
                                                    <i class="ti ti-dashboard"></i>
                                                    <span>Admin Dashboard</span>
                                                </a>
                                            <?php endif; ?>
                                            <a href="/users/edit/<?= $_SESSION['user_id'] ?>" class="dropdown-item">
                                                <i class="ti ti-edit-circle"></i>
                                                <span data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-user"></i>
                                                <span>View Profile</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-clipboard-list"></i>
                                                <span>Social Profile</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-wallet"></i>
                                                <span>Billing</span>
                                            </a>
                                            <a href="/logout" class="dropdown-item">
                                                <i class="ti ti-power"></i>
                                                <span>Logout</span>
                                            </a>
                                        </div>

                                        <!-- Setting Tab Content (Right Side) -->
                                        <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-help"></i>
                                                <span>Support</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-user"></i>
                                                <span>Account Settings</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-lock"></i>
                                                <span>Privacy Center</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-messages"></i>
                                                <span>Feedback</span>
                                            </a>
                                            <a href="#!" class="dropdown-item">
                                                <i class="ti ti-list"></i>
                                                <span>History</span>
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Show login/register prompt if not logged in -->
                                    <div class="dropdown-header">
                                        <div class="d-flex flex-column align-items-center p-3">
                                            <img src="../../../assets/images/user/avatar-2.jpg" alt="default-profile-image" class="user-avtar mb-2" style="width: 60px; height: 60px; border-radius: 50%; border: 3px solid #fff; box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                                            <h6 class="mb-2">Guest User</h6>
                                            <p class="text-muted text-center">Please log in or register to access your profile and settings.</p>
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
                <!-- Language Toggle Button -->
                <button class="btn btn-outline-primary btn-sm text-nowrap" id="langToggle">ភាសាខ្មែរ</button>
            </div>
        </div>                        
    </div>
</nav>

<style>
    /* Custom styles for the dropdown tabs */
    .nav.drp-tabs.nav-fill .nav-item {
        margin: 0 10px; /* Adds space between the tabs */
    }

    .nav.drp-tabs.nav-fill .nav-link {
        color: #6c757d; /* Default gray color */
        border: none;
        background-color: transparent;
        padding: 0.5rem 1rem;
        transition: color 0.3s ease, border-bottom 0.3s ease; /* Smooth transition for hover and active states */
    }

    .nav.drp-tabs.nav-fill .nav-link.active {
        color: #0d6efd; /* Blue color for active tab */
        border-bottom: 2px solid #0d6efd; /* Underline effect for active tab */
    }

    .nav.drp-tabs.nav-fill .nav-link:hover {
        color: #0d6efd; /* Blue color on hover */
    }

    /* Ensure the dropdown menu has enough width to accommodate the tabs */
    .dropdown-user-profile {
        min-width: 300px; /* Adjust based on your content */
    }

    /* Container for the tab content layout */
    .tab-content-layout {
        display: flex;
        gap: 20px; /* Space between the two columns */
        padding: 10px;
    }

    /* Smooth transition for tab content */
    .tab-content-layout .tab-pane {
        flex: 1; /* Each pane takes equal width */
        display: none; /* Hide all panes by default */
        opacity: 0;
        transform: translateX(20px); /* Start slightly to the right */
        transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out; /* Smooth fade and slide effect */
    }

    .tab-content-layout .tab-pane.active {
        display: block; /* Show active pane */
        opacity: 1;
        transform: translateX(0); /* Move to original position */
    }

    /* Left column for Profile */
    #drp-tab-1 {
        order: 1; /* Ensure Profile is on the left */
    }

    /* Right column for Setting */
    #drp-tab-2 {
        order: 2; /* Ensure Setting is on the right */
    }

    /* Additional styling for dropdown items */
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px; /* Space between icon and text */
        padding: 0.5rem 1rem;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa; /* Light background on hover */
    }

    .dropdown-item i {
        font-size: 1.2rem; /* Icon size */
    }
    .navbar .cart-container .cart-dropdown {
        display: none !important;
        flex-direction: column;
        justify-content: space-between;
        position: absolute;
        top: 54px;
        right: -200px;
        width: 380px;
        height: 80vh; /* Full height of the viewport */
        background: rgb(209, 206, 206);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        z-index: 999;
    }

    .navbar .cart-container .cart-dropdown.show {
        display: flex !important;
        animation: slideInFromRight 0.5s ease-out forwards; /* Animation applied when .show is added */
    }

    /* Define the animation */
    @keyframes slideInFromRight {
        0% {
            right: -400px; /* Start off-screen to the right (beyond the width of the cart) */
        }
        100% {
            right: -180px; /* End at the final position */
        }
    }

    .cart-subtotal {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px 0;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
    }

    .subtotal-label {
        text-transform: uppercase;
    }

    .subtotal-amount {
        color: #000;
    }

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Language toggle functionality
    let currentLang = "en";
    const langToggle = document.getElementById("langToggle");
    if (langToggle) {
        langToggle.addEventListener("click", function () {
            currentLang = currentLang === "en" ? "km" : "en";
            document.querySelectorAll(".lang").forEach(el => {
                const newText = el.getAttribute(`data-${currentLang}`);
                if (newText) {
                    el.textContent = newText;
                }
            });
            this.textContent = currentLang === "en" ? "ភាសាខ្មែរ" : "English";
        });
    }

    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.nav.drp-tabs .nav-link');
    const tabPanes = document.querySelectorAll('.tab-content-layout .tab-pane');
    tabButtons.forEach((button) => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            const targetPaneId = this.getAttribute('data-bs-target');
            const targetPane = document.querySelector(targetPaneId);
            if (targetPane) {
                this.classList.add('active');
                targetPane.classList.add('active');
            }
        });
    });

    // Cart functionality
    window.addToCart = async function(productId) {
        if (!productId) {
            alert('Invalid product ID');
            return;
        }

        try {
            console.log('Adding product ID:', productId);
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${encodeURIComponent(productId)}&quantity=1`
            });

            if (!response.ok) {
                console.error('Network response not ok:', response.status, response.statusText);
                throw new Error('Network response was not ok');
            }
            
            const result = await response.json();
            console.log('Add to cart response:', result);
            
            if (result.success) {
                await fetchCartItems();
            } else {
                if (result.message === 'User not logged in') {
                    alert('Please log in to add items to your cart.');
                    window.location.href = '/F_login';
                } else {
                    alert(result.message || 'Failed to add item to cart');
                }
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            alert('An error occurred while adding to cart. Please try again.');
        }
    };

    window.removeFromCart = async function(productId) {
        if (!productId) {
            alert('Invalid product ID');
            return;
        }

        try {
            const response = await fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${encodeURIComponent(productId)}`
            });

            if (!response.ok) {
                console.error('Network response not ok:', response.status, response.statusText);
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            console.log('Remove from cart response:', result);
            
            if (result.success) {
                await fetchCartItems();
            } else {
                alert(result.message || 'Failed to remove item from cart');
            }
        } catch (error) {
            console.error('Error removing from cart:', error);
            alert('An error occurred while removing from cart. Please try again.');
        }
    };

    // Fetch cart items and update UI
    async function fetchCartItems() {
        try {
            const response = await fetch('/cart/items');
            if (!response.ok) {
                console.error('Network response not ok:', response.status, response.statusText);
                throw new Error('Network response was not ok');
            }
            
            const result = await response.json();
            console.log('Fetch cart items response:', result);
            
            if (result.success) {
                updateCartDropdown(result.data || []);
                updateCartCount(result.data || []);
            } else {
                console.warn('Failed to fetch cart items:', result.message);
                updateCartDropdown([]);
                updateCartCount([]);
            }
        } catch (error) {
            console.error('Error fetching cart items:', error);
            updateCartDropdown([]);
            updateCartCount([]);
        }
    }
    // Update the cart count badge
    function updateCartCount(cartItems) {
        const cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            const count = Array.isArray(cartItems) 
                ? cartItems.reduce((total, item) => total + (parseInt(item.quantity) || 0), 0)
                : 0;
            cartCountElement.textContent = count;
        }
    }

    // Update the cart dropdown (this is the function that needs to be updated)
    function updateCartDropdown(cartItems) {
        const cartDropdown = document.getElementById('cartDropdown');
        if (!cartDropdown) return;

        const cartItemsContainer = cartDropdown.querySelector('.cart-items');
        if (!cartItemsContainer) return;

        // Get subtotal elements
        const subtotalSection = cartDropdown.querySelector('.cart-subtotal');
        const subtotalAmount = cartDropdown.querySelector('.subtotal-amount');

        // Situation between checkout and continue shopping
        const checkoutBtn = document.getElementById('checkoutBtn');
        const continueShoppingBtn = document.getElementById('continueShoppingBtn');
        const viewCartBtn = document.getElementById('view-cart');

        cartItemsContainer.innerHTML = '';

        if (!Array.isArray(cartItems) || cartItems.length === 0) {
            cartItemsContainer.innerHTML = '<p>No products in the cart.</p>';
            if (subtotalSection) subtotalSection.style.display = 'none';
            if (viewCartBtn) viewCartBtn.style.display = 'none';
            if (checkoutBtn) checkoutBtn.style.display = 'none';
            if (continueShoppingBtn) continueShoppingBtn.style.display = 'block';
            return;
        }

        // Calculate subtotal
        const subtotal = cartItems.reduce((total, item) => {
            const price = parseFloat(item.price) || 0;
            const quantity = parseInt(item.quantity) || 1;
            return total + price * quantity;
        }, 0);

        // Update subtotal display
        if (subtotalSection && subtotalAmount) {
            subtotalSection.style.display = 'flex';
            subtotalAmount.textContent = `$${subtotal.toFixed(2)}`;
        }

        cartItems.forEach(item => {
            if (!item || !item.product_id) return;

            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <img src="${item.imageURL || '/default-image.jpg'}" alt="${item.productname || 'Product'}" class="cart-item-image">
                <div class="cart-item-details">
                    <span class="cart-item-name">${item.productname || 'Unknown Product'}</span>
                    <span class="cart-item-price">$${parseFloat(item.price || 0).toFixed(2)} x ${parseInt(item.quantity) || 1}</span>
                    <span class="cart-item-total">$${(parseFloat(item.price || 0) * parseInt(item.quantity || 1)).toFixed(2)}</span>
                </div>
                <span class="delete-icon" onclick="removeFromCart(${item.product_id})">
                    <i class="bi bi-trash"></i>
                </span>
            `;
            cartItemsContainer.appendChild(cartItem);
        });
        if (viewCartBtn) viewCartBtn.style.display = 'block';
        if (checkoutBtn) checkoutBtn.style.display = 'block';
        if (continueShoppingBtn) continueShoppingBtn.style.display = 'none';
    }

   // Toggle cart dropdown visibility (updated to use show class)
   window.toggleCart = function() {
        const cartDropdown = document.getElementById('cartDropdown');
        if (!cartDropdown) {
            console.error('Cart dropdown element not found');
            return;
        }

        const isDisplayed = cartDropdown.classList.contains('show');
        console.log('Cart dropdown isDisplayed:', isDisplayed);

        if (!isDisplayed) {
            // Show the dropdown and fetch cart items
            cartDropdown.classList.add('show');
            fetchCartItems();
            console.log('Showing cart dropdown');
        } else {
            // Hide the dropdown
            cartDropdown.classList.remove('show');
            console.log('Hiding cart dropdown');
        }
    };

    // Initial setup: Ensure the cart dropdown is hidden on page load
    const cartDropdown = document.getElementById('cartDropdown');
    if (cartDropdown) {
        cartDropdown.classList.remove('show');
        console.log('Cart dropdown initially hidden');
    }

    // Fetch initial cart items if user is logged in
    <?php if (isset($_SESSION['user_id'])): ?>
        fetchCartItems();
    <?php endif; ?>
});
</script>
