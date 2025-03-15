// document.addEventListener("DOMContentLoaded", () => {
//     const shopButton = document.querySelector(".shop-btn");

//     shopButton.addEventListener("click", () => {
//         alert("Redirecting to the shop...");
//         window.location.href = "#"; // Replace with your actual shop URL
//     });
// });

let currentLang = "en"; // Default language is English
        document.getElementById("langToggle").addEventListener("click", function() {
            currentLang = currentLang === "en" ? "km" : "en";
            document.querySelectorAll(".lang").forEach(el => {
                el.textContent = el.getAttribute(`data-${currentLang}`);
            });
            this.textContent = currentLang === "en" ? "ភាសាខ្មែរ" : "English";
        });
        // Rating stars
        const ratings = document.querySelectorAll('.rating');

        ratings.forEach(rating => {
            rating.addEventListener('click', (e) => {
                const stars = rating.querySelectorAll('.star');
                const value = e.target.getAttribute('data-value');

                // Clear previous ratings
                stars.forEach(star => {
                    star.classList.remove('selected');
                });

                // Set the selected stars based on the clicked star
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= value) {
                        star.classList.add('selected');
                    }
                });

                // Set the data-rating attribute
                rating.setAttribute('data-rating', value);
            });
        });
// run text
document.addEventListener("DOMContentLoaded", function () {
    const text = "Get 25% Off On Your First Purchase!";
    const typingText = document.getElementById("typing-text");
    let index = 0;

    function typeEffect() {
        if (index < text.length) {
            typingText.textContent += text[index]; 
            index++;
            setTimeout(typeEffect, 100);
        } else {
            setTimeout(resetText, 3000); 
        }
    }

    function resetText() {
        typingText.textContent = ""; 
        index = 0;
        typeEffect(); 
    }

    typeEffect(); 
});


// cart icon
let listProductHTML = document.querySelector('.listProduct');
let listCartHTML = document.querySelector('.listCart');
let iconCart = document.querySelector('.icon-cart');
let iconCartSpan = document.querySelector('.icon-cart span');
let body = document.querySelector('body');
let closeCart = document.querySelector('.close');
let cartTab = document.querySelector('.cartTab');
let products = [];
let cart = [];

iconCart.addEventListener('click', () => {
    cartTab.style.display = cartTab.style.display === 'none' ? 'block' : 'none';
});

closeCart.addEventListener('click', () => {
    cartTab.style.display = 'none';
});

const addDataToHTML = () => {
    if (products.length > 0) {
        products.forEach(product => {
            let newProduct = document.createElement('div');
            newProduct.dataset.id = product.id;
            newProduct.classList.add('item');
            newProduct.innerHTML = `
                <img src="${product.image}" alt="">
                <h2>${product.name}</h2>
                <div class="price">$${product.price}</div>
                <button class="addCart">Add To Cart</button>`;
            listProductHTML.appendChild(newProduct);
        });
    }
};

listProductHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('addCart')) {
        let id_product = positionClick.parentElement.dataset.id;
        addToCart(id_product);
    }
});

const addToCart = (product_id) => {
    let positionThisProductInCart = cart.findIndex((value) => value.product_id == product_id);
    if (cart.length <= 0) {
        cart = [{
            product_id: product_id,
            quantity: 1
        }];
    } else if (positionThisProductInCart < 0) {
        cart.push({
            product_id: product_id,
            quantity: 1
        });
    } else {
        cart[positionThisProductInCart].quantity = cart[positionThisProductInCart].quantity + 1;
    }
    addCartToHTML();
    addCartToMemory();
};

const addCartToMemory = () => {
    localStorage.setItem('cart', JSON.stringify(cart));
};

const addCartToHTML = () => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;
    if (cart.length > 0) {
        cart.forEach(item => {
            totalQuantity = totalQuantity + item.quantity;
            let newItem = document.createElement('div');
            newItem.classList.add('item');
            newItem.dataset.id = item.product_id;

            let positionProduct = products.findIndex((value) => value.id == item.product_id);
            let info = products[positionProduct];
            listCartHTML.appendChild(newItem);
            newItem.innerHTML = `
                <div class="image">
                    <img src="${info.image}">
                </div>
                <div class="name">
                    ${info.name}
                </div>
                <div class="totalPrice">$${info.price * item.quantity}</div>
                <div class="quantity">
                    <span class="minus"><</span>
                    <span>${item.quantity}</span>
                    <span class="plus">></span>
                </div>
            `;
        });
    }
    iconCartSpan.innerText = totalQuantity;
};

listCartHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('minus') || positionClick.classList.contains('plus')) {
        let product_id = positionClick.parentElement.parentElement.dataset.id;
        let type = 'minus';
        if (positionClick.classList.contains('plus')) {
            type = 'plus';
        }
        changeQuantityCart(product_id, type);
    }
});

const changeQuantityCart = (product_id, type) => {
    let positionItemInCart = cart.findIndex((value) => value.product_id == product_id);
    if (positionItemInCart >= 0) {
        let info = cart[positionItemInCart];
        switch (type) {
            case 'plus':
                cart[positionItemInCart].quantity = cart[positionItemInCart].quantity + 1;
                break;

            default:
                let changeQuantity = cart[positionItemInCart].quantity - 1;
                if (changeQuantity > 0) {
                    cart[positionItemInCart].quantity = changeQuantity;
                } else {
                    cart.splice(positionItemInCart, 1);
                }
                break;
        }
    }
    addCartToHTML();
    addCartToMemory();
};

const initApp = () => {
    fetch('products.json')
        .then(response => response.json())
        .then(data => {
            products = data;
            addDataToHTML();

            if (localStorage.getItem('cart')) {
                cart = JSON.parse(localStorage.getItem('cart'));
                addCartToHTML();
            }
        });
};

initApp();


iconCart.addEventListener('click', () => {
    cartTab.classList.toggle('active');
});

closeCart.addEventListener('click', () => {
    cartTab.classList.remove('active');
});


// active 
// Function to toggle the active class on the navbar items
function setActiveNavItem() {
    // Get all the nav-link elements
    const navLinks = document.querySelectorAll('.nav-link');

    // Remove the active class from all nav-links
    navLinks.forEach(link => {
        link.classList.remove('active');
        link.style.color = ''; // Reset the color
    });

    // Add the active class and set the color for the clicked link
    this.classList.add('active');
    if (this.id === 'shop-link') {
        this.style.color = 'blue'; // Shop link is blue
    } else if (this.id === 'product-link') {
        this.style.color = 'blue'; // Product link is blue
    } else {
        this.style.color = 'black'; // Default color for others
    }
}

// Add click event listeners to all the nav-link items
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', setActiveNavItem);
});



        