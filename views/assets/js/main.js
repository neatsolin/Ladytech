// <--------------// ----------------- languages ---------------- //document.addEventListener("DOMContentLoaded", function () {
    let currentLang = "en"; // Default language is English

    document.getElementById("langToggle").addEventListener("click", function () {
        currentLang = currentLang === "en" ? "km" : "en"; // Toggle between English and Khmer

        // Update all text elements with the corresponding language
        document.querySelectorAll(".lang").forEach(el => {
            let newText = el.getAttribute(`data-${currentLang}`);
            if (newText) {
                el.textContent = newText;
            }
        });

        // Change the button text to indicate the next language option
        this.textContent = currentLang === "en" ? "ភាសាខ្មែរ" : "English";
    });

// <--------------// ----------------- nav links ---------------- //
document.addEventListener("DOMContentLoaded", function () {
    // Select all navbar links
    const navLinks = document.querySelectorAll(".nav-link");

    // Function to remove active class from all links
    function removeActiveClass() {
        navLinks.forEach(link => link.classList.remove("active"));
    }

    // Add click event to each link
    navLinks.forEach(link => {
        link.addEventListener("click", function () {
            removeActiveClass();  // Remove active class from all links
            this.classList.add("active");  // Add active class to the clicked link
        });
    });

    // Set active class based on current URL (for page reloads)
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            removeActiveClass();
            link.classList.add("active");
        }
    });
});

// ------------- link page on view detail -------------------->
function viewDetails(productId) {
    console.log(`/product_detail?productId=${productId}`);
    window.location.href = `/product_detail?productId=${productId}`;
    }

// ----------------- rate filter -------------------->
const stats = document.querySelectorAll('.stat');
stats.forEach(stat => {
    stat.addEventListener('mouseenter', () => {
        stat.classList.add('hovered');
        stat.querySelector('h3').classList.add('text-warning');
        stat.querySelector('h6').classList.add('text-success');
        const img = stat.querySelector('.icon-overlay img');
        if (img) {
            img.style.transform = 'scale(1.2) rotate(10deg)';
        }
    });
    stat.addEventListener('mouseleave', () => {
        stat.classList.remove('hovered');
        stat.querySelector('h3').classList.remove('text-warning');
        stat.querySelector('h6').classList.remove('text-success');
        const img = stat.querySelector('.icon-overlay img');
        if (img) {
            img.style.transform = 'scale(1) rotate(0deg)';
        }
    });
});

// ------------------ Search Functionality (by Product Name Only) ------------------>
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('search');
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        filterProducts();
    });

    searchInput.addEventListener('input', filterProducts);

    function filterProducts() {
        const searchQuery = searchInput.value.toLowerCase();
        const products = document.querySelectorAll('#productList > div');

        products.forEach(product => {
            const title = product.querySelector('.card-title').textContent.toLowerCase();

            // Check if the title includes the search query
            const matchesSearch = title.includes(searchQuery);

            if (matchesSearch) {
                product.style.display = 'block';  // Show the product
            } else {
                product.style.display = 'none';  // Hide the product
            }
        });
    }



// -------------------- Rating Functionality -------------------->
    function setRating(productId, rating) {
        const stars = document.querySelectorAll(`[data-product-id="${productId}"] .star`);
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-star'));
            if (starValue <= rating) {
                star.classList.add('filled');
            } else {
                star.classList.remove('filled');
            }
        });
        const ratingValueElement = document.querySelector(`[data-rating-id="${productId}"]`);
        ratingValueElement.textContent = `(${rating})`;
    }

    // Favorite Toggle
    function toggleFavorite(productId) {
        const heartIcon = document.querySelector(`[data-heart-id="${productId}"]`);
        if (heartIcon.classList.contains('bi-heart')) {
            heartIcon.classList.remove('bi-heart');
            heartIcon.classList.add('bi-heart-fill');
        } else {
            heartIcon.classList.remove('bi-heart-fill');
            heartIcon.classList.add('bi-heart');
        }
    }

//------------------------- add to cart ---------------------------------------------------->
    let cart = [];

    function addToCart(productId) {
        // Find the product card by productId
        const productCard = document.querySelector(`[data-product-id="${productId}"]`);
        if (!productCard) return;

        // Extract product details
        const productName = productCard.querySelector('.card-title').textContent;
        const productPrice = parseFloat(productCard.querySelector('.price').textContent.replace('Price: $', ''));
        const productImage = productCard.querySelector('img').src; // Get the image URL

        // Check if the product is already in the cart
        const existingProduct = cart.find(item => item.id === productId);

        if (existingProduct) {
            // If the product is already in the cart, increase the quantity
            existingProduct.quantity += 1;
        } else {
            // If the product is not in the cart, add it with a quantity of 1
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage, // Include the image URL
                quantity: 1,
            });
        }

        // Update the cart count and dropdown
        updateCartCount();
        updateCartDropdown();
    }

    function removeFromCart(productId) {
        // Remove the product from the cart
        cart = cart.filter(item => item.id !== productId);

        // Update the cart count and dropdown
        updateCartCount();
        updateCartDropdown();
    }

    function updateCartCount() {
        const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        document.getElementById('cart-count').textContent = cartCount;
    }

    function updateCartDropdown() {
        const cartDropdown = document.getElementById('cartDropdown');
        const cartItems = cartDropdown.querySelector('.cart-items');

        // Clear the current cart items
        cartItems.innerHTML = '';

        // Add each item in the cart to the dropdown
        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                <div class="cart-item-details">
                    <span class="cart-item-name">${item.name}</span>
                    <span class="cart-item-price">$${item.price.toFixed(2)} x ${item.quantity}</span>
                    <span class="cart-item-total">$${(item.price * item.quantity).toFixed(2)}</span>
                </div>
                <span class="delete-icon" onclick="removeFromCart(${item.id})">
                    <i class="bi bi-trash"></i> <!-- Bootstrap trash icon -->
                </span>
            `;
            cartItems.appendChild(cartItem);
        });

        // If the cart is empty, display a message
        if (cart.length === 0) {
            cartItems.innerHTML = '<p>Your cart is empty.</p>';
        }
    }

    function toggleCart() {
        const cartDropdown = document.getElementById('cartDropdown');
        cartDropdown.style.display = cartDropdown.style.display === 'block' ? 'none' : 'block';
    }
// <--------------------- rate filter -------------------->
// rate filter 
document.getElementById("priceRange").addEventListener("input", function () {
    let selectedPrice = parseInt(this.value);
    document.getElementById("priceValue").innerText = `$1 - $${selectedPrice}`;

    document.querySelectorAll(".col-md-4").forEach(product => {
        let priceText = product.querySelector(".price").innerText;
        let productPrice = parseFloat(priceText.replace(/[^0-9.]/g, ""));
        
        if (productPrice <= selectedPrice) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });
});



   




        

        