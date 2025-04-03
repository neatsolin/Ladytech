<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
    <h3 class="text-center">Welcome to some page</h3>

<?php
else:
    $this->redirect("/login");
endif;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .nav-link:hover {
            font-weight: bold;
            color: blue !important;
            /* Change color to blue on hover */
        }

        body {
            background-color: rgb(219, 226, 233);

        }

        .nav-link {
            font-weight: normal;
            /* Default weight */
            transition: color 0.3s ease, font-weight 0.3s ease;
            /* Smooth transition */
        }

        .text-white {
            height: 70vh;
        }

        .img_some {
            width: 400px;
            height: 400px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link " href=".//home" style="font-size: 1.2rem;">Shops</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/product" style="font-size: 1.2rem;">Product</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/about" style="font-size: 1.2rem;">About</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/contact" style="font-size: 1.2rem;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
        /* Cards Section */
        .cards {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            flex: 0 0 auto;
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
        }

        /* Info Overlay */
        .info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(224, 116, 116, 0.7);
            color: white;
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover .info,
        .card:active .info {
            opacity: 1;
        }

        /* Content Section */
        .content-section {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-top: 40px;
        }

        .text-content .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #ff6f61;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .image-content-right img {
            width: 100%;
            height: auto;
            border-radius: 10px 70px 10px 70px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Info Section */
        .info-section {
            background-color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        .info-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
            max-width: 800px;
            margin: 0 auto 20px;
        }

        .info-section .cta-button {
            display: inline-block;
            padding: 12px 25px;
            background: #ff6f61;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        /* Product Container */
        .product-container {
            display: flex;
            /* flex-wrap: wrap; */
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .learn-more {
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }

        @media (max-width: 1199px) {
            .products-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 767px) {
            .products-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 575px) {

            /* General adjustments */
            body {
                padding: 10px;
                font-size: 14px;
            }

            header h1 {
                font-size: 1.8rem;
                padding: 15px;
            }

            header p {
                font-size: 1.2rem;
            }

            /* Product cards container */
            .products-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            /* Product cards */
            .product-card {
                width: 100%;
                margin: 0;
                height: auto;
            }

            .product-image {
                height: 150px !important;
                /* Adjusted for better proportions */
                border-radius: 8px 8px 0 0;
                object-fit: cover;
            }

            .product-info {
                padding: 10px;
            }

            .product-name {
                font-size: 1.2rem;
                margin-bottom: 5px;
                font-family: serif;
            }

            .price {
                font-size: 1.5rem;
            }

            .add-to-cart {
                padding: 5px;
                font-size: 0.9rem;
            }

            /* Discount section */
            .discount-products {
                padding: 20px 10px;
            }

            .discount-header h2 {
                font-size: 1.5rem;
            }

            /* Content sections */
            .content-section {
                flex-direction: column;
                gap: 20px;
            }

            .text-content {
                order: 2;
            }

            .image-content-right,
            .image-content-left,
            .image-content-lefts {
                order: 1;
                width: 100%;
            }

            .image-content-right img,
            .image-content-left img,
            .image-content-lefts img {
                width: 100%;
                height: auto;
                max-height: 250px;
                object-fit: cover;
                border-radius: 10px !important;
            }

            /* Product cards in product-container */
            .product-container {
                flex-direction: column;
                align-items: center;
            }

            .product-card1 {
                width: 100%;
                max-width: 300px;
                margin-bottom: 20px;
            }

            .product-card1 img {
                height: 180px;
                object-fit: cover;
            }

            /* Cards carousel */
            .cards {
                gap: 10px;
                padding-bottom: 15px;
            }

            .card {
                width: 200px;
                flex: 0 0 auto;
            }

            .card img {
                height: 150px;
            }

            /* Info overlay */
            .info {
                font-size: 0.85rem;
                padding: 8px;
            }

            /* Info section */
            .info-section {
                padding: 20px 10px;
            }

            .info-section h2 {
                font-size: 1.5rem;
            }

            /* Buttons */
            .cta-button,
            .info-section .cta-button,
            .learn-more {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            /* Ensure all images maintain aspect ratio */
            img {
                max-width: 100%;
                height: auto;
            }

            /* Cart panel adjustments */
            .cart-panel {
                width: 90%;
                max-width: none;
            }

            /* Discount badge */
            .discount-badge {
                font-size: 0.8rem;
                padding: 3px 8px;
            }

            /* Remove animations on mobile */
            .card img {
                animation: none !important;
            }

            /* Adjust spacing */
            .container {
                padding: 10px;
            }

            /* Full width for text content */
            .text-content {
                width: 100%;
            }

            .text-content h2 {
                font-size: 1.5rem;
            }

            .text-content p {
                font-size: 0.95rem;
            }
        }

        .product-card1 {

            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }
    </style>
    </head>

    <body>
        <!-- Cards of Products -->
        <div class="cards">
            <div class="card">
                <img src="/views/assets/images/Snacks (7)/Buldak hot.png" alt="Hydrating Moisturizer">
                <div class="info">Deeply nourish your skin with our hydrating moisturizer. Perfect for all skin types.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Vitamin C Serum">
                <div class="info">Brighten your complexion with our powerful Vitamin C serum.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Snacks (7)/Good Noodle.png" alt="Sunscreen SPF 50">
                <div class="info">Protect your skin from harmful UV rays with our lightweight sunscreen.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Hydrating Moisturizer">
                <div class="info">Deeply nourish your skin with our hydrating moisturizer. Perfect for all skin types.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Clothing(7)/Comfort Blue.png" alt="Vitamin C Serum">
                <div class="info">Brighten your complexion with our powerful Vitamin C serum.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Clothing(7)/Pao Pink Detergent.png" alt="Sunscreen SPF 50">
                <div class="info">Protect your skin from harmful UV rays with our lightweight sunscreen.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Sunscreen SPF 50">
                <div class="info">Protect your skin from harmful UV rays with our lightweight sunscreen.</div>
            </div>
            <div class="card">
                <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Sunscreen SPF 50">
                <div class="info">Protect your skin from harmful UV rays with our lightweight sunscreen.</div>
            </div>
            <div class="card">
                <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Sunscreen SPF 50">
                <div class="info">Protect your skin from harmful UV rays with our lightweight sunscreen.</div>
            </div>
        </div>

        <!-- Left Paragraph Right Image -->
        <div class="container">
            <div class="content-section">
                <div class="text-content">
                    <h2>Why Choose Glow Skincare?</h2>
                    <p>At Glow Skincare, we believe that everyone deserves to feel confident in their skin. Our products are crafted with the finest natural ingredients, scientifically proven to nourish and rejuvenate your skin.</p>
                    <a href="#" class="cta-button">Discover Our Story</a>
                </div>
                <div class="image-content-right">
                    <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Glow Skincare Products" style="width: 400px; height: 400px;">
                </div>
            </div>
        </div>

        <!-- Product Cards -->
        <div class="product-container">
            <div class="product-card1">
                <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Hydrating Moisturizer">
                <p>Deeply nourish your skin with our hydrating moisturizer. Perfect for all skin types.</p>
                <button class="learn-more">Learn More</button>
            </div>
            <div class="product-card1">
                <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Vitamin C Serum">
                <p>Brighten your complexion with our powerful Vitamin C serum.</p>
                <button class="learn-more">Learn More</button>
            </div>
            <div class="product-card1">
                <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Hydrating Moisturizer">
                <p>Deeply nourish your skin with our hydrating moisturizer. Perfect for all skin types.</p>
                <button class="learn-more">Learn More</button>
            </div>
        </div>

        <!-- Information Section -->
        <div class="info-section">
            <div class="container">
                <h2>About Our Products</h2>
                <p>At DAILY NEEDS, we are committed to providing you with products that are not only effective, but also safe and sustainable.</p>
                <a href="#" class="cta-button">Learn More About Us</a>
            </div>
        </div>

        <script>
            // Simple script for the discount section
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productName = this.closest('.discount-card').querySelector('h3').textContent;
                    alert(`Added ${productName} to your cart!`);
                });
            });
        </script>

        <script>
            // Select the container with class 'cards'
            const container = document.querySelector('.cards');

            // Hide the scroll bar to keep the UI clean
            container.style.overflowX = 'hidden';

            // Get the width of the original set of cards
            const originalScrollWidth = container.scrollWidth;

            // Clone all existing cards and append them for seamless looping
            const cards = Array.from(container.querySelectorAll('.card'));
            cards.forEach(card => {
                const clone = card.cloneNode(true);
                container.appendChild(clone);
            });

            // Set the initial scroll position
            container.scrollLeft = originalScrollWidth;

            // Define the speed of the animation (pixels per second)
            const speed = 100;
            let lastTime = performance.now();

            // Animation function for continuous movement
            function animate(currentTime) {
                const deltaTime = (currentTime - lastTime) / 1000;
                container.scrollLeft -= speed * deltaTime;
                if (container.scrollLeft <= 0) {
                    container.scrollLeft += originalScrollWidth;
                }
                lastTime = currentTime;
                requestAnimationFrame(animate);
            }

            // Start the animation
            requestAnimationFrame(animate);

            // Ensure images have no animations
            const images = document.querySelectorAll('.card img');
            images.forEach(img => {
                img.style.animation = 'none';
            });
        </script>

        <!-- Inline CSS -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }
        </style>

        <!-- JavaScript -->
        <!-- JavaScript -->
        <script src="Views/E-commerce-user/assets/js/jquery-3.3.1.min.js"></script>
        <script src="Views/E-commerce-user/assets/js/main.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cartPanel = document.querySelector('.cart-panel');
                const closeCart = document.querySelector('.close-cart');
                const addToCartButtons = document.querySelectorAll('.add-to-cart');
                const cartItemsContainer = document.querySelector('.cart-items');
                const cartItemCount = document.querySelector('#cart-item-count');
                const subtotalAmount = document.querySelector('#subtotal-amount');
                const imageZoomModal = document.querySelector('.image-zoom-modal');
                const zoomedImage = document.querySelector('#zoomed-image');
                const backBtn = document.querySelector('.back-btn');
                const zoomButtons = document.querySelectorAll('.image-zoom');
                let cartItems = [];

                // Load cart from localStorage on page load
                try {
                    cartItems = JSON.parse(localStorage.getItem('cart')) || [];
                } catch (e) {
                    console.error("Error parsing cart from localStorage:", e);
                    cartItems = [];
                }

                // Render cart items on page load
                cartItems.forEach(item => addCartItem(item));
                updateCartSummary();

                // Cart Functionality
                function toggleCart() {
                    cartPanel.classList.toggle('active');
                }

                closeCart.addEventListener('click', toggleCart);

                addToCartButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const productName = this.getAttribute('data-product-name');
                        const productPrice = parseFloat(this.getAttribute('data-product-price'));
                        const productImage = this.getAttribute('data-product-image');

                        const existingItem = cartItems.find(item => item.name === productName);
                        if (existingItem) {
                            existingItem.quantity += 1;
                            updateCartItem(existingItem);
                        } else {
                            const newItem = {
                                name: productName,
                                price: productPrice,
                                image: productImage,
                                quantity: 1
                            };
                            cartItems.push(newItem);
                            addCartItem(newItem);
                        }

                        // Save to localStorage
                        localStorage.setItem('cart', JSON.stringify(cartItems));
                        console.log("Cart after adding item:", cartItems);

                        if (!cartPanel.classList.contains('active')) {
                            toggleCart();
                        }
                        updateCartSummary();
                    });
                });

                function addCartItem(item) {
                    const cartItem = document.createElement('div');
                    cartItem.classList.add('cart-item');
                    cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="cart-item-details">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn decrease-btn">-</button>
                    <input type="number" class="quantity-input" value="${item.quantity}" min="1">
                    <button class="quantity-btn increase-btn">+</button>
                </div>
            </div>
            <div class="cart-item-total">$${(item.price * item.quantity).toFixed(2)}</div>
            <div class="delete-btn"><i class="fa fa-trash"></i></div>
        `;
                    cartItemsContainer.appendChild(cartItem);

                    attachItemListeners(cartItem, item);
                }

                function updateCartItem(item) {
                    const cartItem = Array.from(cartItemsContainer.querySelectorAll('.cart-item')).find(
                        el => el.querySelector('.cart-item-name').textContent === item.name
                    );
                    const input = cartItem.querySelector('.quantity-input');
                    input.value = item.quantity;
                    cartItem.querySelector('.cart-item-total').textContent = `$${(item.price * item.quantity).toFixed(2)}`;
                    updateCartSummary();
                    // Save to localStorage
                    localStorage.setItem('cart', JSON.stringify(cartItems));
                }

                function attachItemListeners(cartItem, item) {
                    const decreaseBtn = cartItem.querySelector('.decrease-btn');
                    const increaseBtn = cartItem.querySelector('.increase-btn');
                    const quantityInput = cartItem.querySelector('.quantity-input');
                    const deleteBtn = cartItem.querySelector('.delete-btn');

                    decreaseBtn.addEventListener('click', () => {
                        if (item.quantity > 1) {
                            item.quantity--;
                            updateCartItem(item);
                        }
                    });

                    increaseBtn.addEventListener('click', () => {
                        item.quantity++;
                        updateCartItem(item);
                    });

                    quantityInput.addEventListener('change', () => {
                        let value = parseInt(quantityInput.value);
                        if (value < 1 || isNaN(value)) value = 1;
                        item.quantity = value;
                        updateCartItem(item);
                    });

                    deleteBtn.addEventListener('click', () => {
                        cartItem.remove();
                        cartItems = cartItems.filter(i => i.name !== item.name);
                        updateCartSummary();
                        // Save to localStorage
                        localStorage.setItem('cart', JSON.stringify(cartItems));
                    });
                }

                function updateCartSummary() {
                    const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
                    const subtotal = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
                    cartItemCount.textContent = `${totalItems} items`;
                    subtotalAmount.textContent = `$${subtotal.toFixed(2)}`;
                }

                // Image Zoom Functionality
                zoomButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const imageUrl = this.getAttribute('data-image');
                        zoomedImage.src = imageUrl;
                        imageZoomModal.classList.add('active');
                        document.body.style.overflow = 'hidden'; // Prevent scrolling
                    });
                });

                backBtn.addEventListener('click', function() {
                    imageZoomModal.classList.remove('active');
                    document.body.style.overflow = 'auto'; // Restore scrolling
                });

                // Close modal when clicking outside the image
                imageZoomModal.addEventListener('click', function(e) {
                    if (e.target === imageZoomModal) {
                        imageZoomModal.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }
                });
            });
        </script>



    </body>

    </html>

    <!-- Product Cards Section -->
    <h2 class="mb-4 mt-5 text-center" style="color: rgb(80, 71, 83);">Our Category</h2>
    <div class="row px-3 py-4" id="productList">
        <!-- Product Card 1 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="1">
            <div class="card text-start" style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Buldak hot.png" alt="Floral Serum" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Buldak hot</h6>
                        <i class="bi bi-heart" data-heart-id="1" onclick="toggleFavorite(1)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(1, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(1, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(1, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(1, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(1, 5)">★</span>
                        <span class="rating-value" data-rating-id="1">(0)</span>
                    </div>
                    <p class="card-text">Moisturize your skin with this serum.</p>
                    <div class="price ">Price: $50.99</div>
                </div>
            </div>
        </div>
        <!-- card 2 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="2">
            <div class="card text-start" style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Good Noodle.png" alt="Serum 2" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Good Noodle</h6>
                        <i class="bi bi-heart" data-heart-id="2" onclick="toggleFavorite(2)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(2, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(2, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(2, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(2, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(2, 5)">★</span>
                        <span class="rating-value" data-rating-id="2">(0)</span>
                    </div>
                    <p class="card-text">Revitalize your skin with this amazing serum.</p>
                    <div class="price ">Price: $40.99</div>
                </div>
            </div>
        </div>
        <!-- card 3 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="3">
            <div class="card text-start" style="border-radius: 12px; overflow: hidden; ">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Serum 3" class="img-fluid">
                </div>
                <div class="card-body " style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Mama Pork pack</h6>
                        <i class="bi bi-heart" data-heart-id="3" onclick="toggleFavorite(3)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(3, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(3, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(3, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(3, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(3, 5)">★</span>
                        <span class="rating-value" data-rating-id="3">(0)</span>
                    </div>
                    <p class="card-text">Nourish your skin with this amazing product.</p>
                    <div class="price ">Price: $45.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 4 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="4">
            <div class="card text-star" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Comfort Blue.png" alt="Serum 4" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Comfort Blue</h6>
                        <i class="bi bi-heart" data-heart-id="4" onclick="toggleFavorite(4)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(4, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(4, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(4, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(4, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(4, 5)">★</span>
                        <span class="rating-value" data-rating-id="4">(0)</span>
                    </div>
                    <p class="card-text">Replenish your skin with this amazing serum.</p>
                    <div class="price ">Price: $60.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 5 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="5">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Serum 5" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Fineline Liquid Detergent</h6>
                        <i class="bi bi-heart" data-heart-id="5" onclick="toggleFavorite(5)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(5, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(5, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(5, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(5, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(5, 5)">★</span>
                        <span class="rating-value" data-rating-id="5">(0)</span>
                    </div>
                    <p class="card-text">Moisturize your skin with this floral serum.</p>
                    <div class="price ">Price: $55.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 6 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="6">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Pao Pink Detergent.png" alt="Serum 7" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Pao Pink Detergent</h6>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(6, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(6, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(6, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(6, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(6, 5)">★</span>
                        <span class="rating-value" data-rating-id="6">(0)</span>
                    </div>
                    <p class="card-text">A refreshing serum for daily use.</p>
                    <div class="price">Price: $42.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 7 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="7">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Serum 7" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">keepo purple</h6>
                        <i class="bi bi-heart" data-heart-id="7" onclick="toggleFavorite(7)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(7, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(7, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(7, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(7, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(7, 5)">★</span>
                        <span class="rating-value" data-rating-id="7">(0)</span>
                    </div>
                    <p class="card-text">Hydrate and nourish with this serum.</p>
                    <div class="price">Price: $48.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 8 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="8">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Serum 8" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Keepo Green</h6>
                        <i class="bi bi-heart" data-heart-id="8" onclick="toggleFavorite(8)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(8, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(8, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(8, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(8, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(8, 5)">★</span>
                        <span class="rating-value" data-rating-id="8">(0)</span>
                    </div>
                    <p class="card-text">A lightweight serum for all skin types.</p>
                    <div class="price">Price: $52.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 9 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="9">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Serum 9" class="img-fluid">
                </div>
                <div class="card-body" style=" color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">ACNES</h6>
                        <i class="bi bi-heart" data-heart-id="9" onclick="toggleFavorite(9)"></i>
                    </div>
                    <div class="rating mb-2">
                        <span class="star" data-star="1" onclick="setRating(9, 1)">★</span>
                        <span class="star" data-star="2" onclick="setRating(9, 2)">★</span>
                        <span class="star" data-star="3" onclick="setRating(9, 3)">★</span>
                        <span class="star" data-star="4" onclick="setRating(9, 4)">★</span>
                        <span class="star" data-star="5" onclick="setRating(9, 5)">★</span>
                        <span class="rating-value" data-rating-id="9">(0)</span>
                    </div>
                    <p class="card-text">Glow up with this floral serum.</p>
                    <div class="price">Price: $49.99</div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<style>
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .icon-large {
            font-size: 2.5rem;
        }

        .stats h3 {
            font-size: 1.8rem;
        }
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        max-height: 180px;
        object-fit: contain;
    }

    .card-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
    }

    .rating .star.filled {
        color: rgb(255, 217, 0);
    }

    .rating .rating-value {
        font-size: 12px;
        color: #666;
        margin-left: 5px;
    }

    .price {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    @media (max-width: 767px) {

        .filter,
        .filter-categories {
            margin: 0 15px 20px;
        }

        .card {
            margin: 0 auto;
            max-width: 300px;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .profile {
            padding: 40px 20px;
            /* Adjust padding for smaller screens */
        }
    }
</style>

</html>