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

// ------------------------------- about-page count number ----------------------------->

   
        // Data for images and content
        const data = [
            {
                image: "/views/assets/images/Snacks (7)/Buldak hot.png",
                title: "We Are Your Favorite Store",
                description: "Discover high-quality products at great prices, curated for your satisfaction.",
                additionalInfo: "We prioritize trust, innovation, and community to deliver exceptional value."
            },
            {
                image: "/views/assets/images/Feminine Hygiene (10)/Tessa.png",
                title: "Our Mission",
                description: "To provide exceptional products and a seamless shopping experience.",
                additionalInfo: "We believe in quality, trust, and customer satisfaction."
            },
            {
                image: "/views/assets/images/Snacks (7)/Good Noodle.png",
                title: "Our Vision",
                description: "To become the most trusted and beloved store worldwide.",
                additionalInfo: "We strive to inspire and innovate for a better future."
            }
        ];

        let currentIndex = 0;

        // Function to update the image and content
        function updateContent() {
            const profileImg = document.getElementById('profileImg');
            const sectionTitle = document.getElementById('sectionTitle');
            const sectionDescription = document.getElementById('sectionDescription');
            const sectionAdditionalInfo = document.getElementById('sectionAdditionalInfo');

            // Update image and content
            profileImg.src = data[currentIndex].image;
            sectionTitle.innerText = data[currentIndex].title;
            sectionDescription.innerText = data[currentIndex].description;
            sectionAdditionalInfo.innerText = data[currentIndex].additionalInfo;

            // Increment index for next update
            currentIndex = (currentIndex + 1) % data.length;
        }

        // Automatically update content every 5 seconds
        setInterval(updateContent, 5000);

        // Initialize with the first set of content
        updateContent();
        // 
        function animateCountUp(element, start, end, duration) {
    let startTime = null;

    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        let progress = timestamp - startTime;
        let increment = (progress / duration) * (end - start);
        let current = Math.min(start + increment, end);
        
        element.innerText = `${Math.floor(current)}+`;

        if (current < end) {
            requestAnimationFrame(step);
        } else {
            element.innerText = `${end}+`; // Ensure final value is correct
        }
    }

    requestAnimationFrame(step);
}

function startAnimation() {
    const stats = [
        { element: document.querySelector("#owned-products"), value: 5000 },
        { element: document.querySelector("#curated-products"), value: 800 },
        { element: document.querySelector("#product-categories"), value: 20 }
    ];
    
    stats.forEach(stat => {
        if (stat.element) {
            animateCountUp(stat.element, 0, stat.value, 2000);
        } else {
            console.error("Element not found:", stat);
        }
    });
}

// Start animation when the page loads
document.addEventListener("DOMContentLoaded", startAnimation);
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








    

    