// <--------------// ----------------- languages ---------------- //
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

// <-------------------------------- toggle card -----------------------------------> //
function toggleCart() {
    var cartDropdown = document.getElementById("cartDropdown");
    cartDropdown.style.display = (cartDropdown.style.display === "block") ? "none" : "block";
}

// Close cart dropdown when clicking outside
document.addEventListener("click", function (event) {
    var cartContainer = document.querySelector(".cart-container");
    var cartDropdown = document.getElementById("cartDropdown");

    if (!cartContainer.contains(event.target)) {
        cartDropdown.style.display = "none";
    }
});



        