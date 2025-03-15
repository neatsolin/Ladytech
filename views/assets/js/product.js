document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("searchForm");
    const searchInput = document.getElementById("search");
    const priceRange = document.getElementById("priceRange");
    const priceValue = document.getElementById("priceValue");
    const products = document.querySelectorAll(".product");

    function filterProducts() {
        const searchText = searchInput.value.toLowerCase();
        const selectedPrice = parseFloat(priceRange.value);
        priceValue.textContent = selectedPrice; // Show selected price

        products.forEach((product) => {
            const productName = product.querySelector(".product-title").textContent.toLowerCase();
            const productPrice = parseFloat(
                product.querySelector(".product-price").textContent.replace("$", "")
            );

            // Show product only if it matches both filters
            if ((productName.includes(searchText) || searchText === "") && productPrice <= selectedPrice) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    }

    // Search function on form submit
    searchForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent page reload
        filterProducts();
    });

    // Live search as the user types
    searchInput.addEventListener("input", filterProducts);

    // Filter products by price
    priceRange.addEventListener("input", filterProducts);
});

