
    <title>Daily Needs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script defer src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
         /* Navbar Styling */
         .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            height: 60px;
            width: auto;
        }
        .nav-link {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            transition: color 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #007bff !important;
        }
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .nav-icons i {
            font-size: 1.3rem;
            color: #007bff;
            transition: color 0.3s ease;
        }
        .nav-icons i:hover {
            color: #0056b3;
        }
        .cart-text {
            font-weight: bold;
            color: #555;
            font-size: 0.9rem;
        }
        .btn-outline-primary {
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 20px;
        }
        /* Hero Section Styling */
        .hero-section {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
            text-align: left;
            padding: 50px 0;
            position: relative;
        }
        .hero-section .container {
            max-width: 1200px;
        }
        .hero-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .hero-content h4 {
            font-weight: bold;
            color: #333;
        }
        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #222;
        }
        .hero-content p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 20px;
        }
        .shop-btn {
            display: inline-flex;
            align-items: center;
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: 0.3s ease-in-out;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }
        .shop-btn:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
            transform: translateY(-2px);
        }
        .shop-btn i {
            margin-right: 8px;
        }
        /* Background pattern */
        .background-pattern {
            position: absolute;
            right: 0;
            top: 20%;
            width: 300px;
            height: 300px;
            opacity: 0.1;
            background: url('https://www.svgrepo.com/show/326908/leaves.svg') no-repeat;
            background-size: cover;
        }
        /* Benefits Section Styling */
        .benefits-section {
        padding: 40px 0;
        background-color: #02172c;
        }

        .benefit-card {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .benefit-card:hover {
            transform: scale(1.05);
        }

        .benefit-icon {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 10px;
        }

        .benefit-card h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .benefit-card p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0;
        }
        
        .rating {
            cursor: pointer;
        }
        .rating .star {
            font-size: 20px;
            color: #ddd; /* Default color for unselected stars */
        }
        .rating .star.selected {
            color: #ffcc00; /* Yellow color for selected stars */
        }

        .cart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            display: none; /* Hide by default */
        }
        .card {
            position: relative;
        }
        .card:hover .cart-icon {
            display: block; /* Show when hovering */
        }
    </style>
    <!-- Add this inside the body, after your navbar -->
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar Filter Section -->
        <div class="col-md-3">
            <h5>Filter by price</h5>
            <input type="range" id="priceRange" min="10" max="50" step="5" value="50" class="form-range">
            <p>Price: $<span id="priceValue">10 - 50</span></p>
            <button class="btn btn-outline-primary w-100" id="filterBtn">FILTER</button>
            
            <h5 class="mt-4">Filter by Categories</h5>
            <ul class="list-group">
                <li class="list-group-item category-filter" data-category="Body lotion">Body lotion (3)</li>
                <li class="list-group-item category-filter" data-category="Bundles">Bundles (1)</li>
                <li class="list-group-item category-filter" data-category="Cleanser">Cleanser (6)</li>
                <li class="list-group-item category-filter" data-category="Moisturizer">Moisturizer (3)</li>
                <li class="list-group-item category-filter" data-category="Sunscreens">Sunscreens (2)</li>
            </ul>
        </div>

        <!-- Product Display Section -->
        <div class="col-md-9">
            <h5>Showing 1-12 of 14 results</h5>
            <div class="row" id="productList">
                <!-- Example Product Cards -->
                <div class="col-md-4 product" data-category="Body lotion" data-price="28">
                    <div class="card">
                        <img src="images/product1.jpg" class="card-img-top" alt="Product 1">
                        <div class="card-body">
                            <h6 class="card-title">Almond Milk Lotion</h6>
                            <p class="text-muted">Body lotion</p>
                            <p class="fw-bold">$28.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 product" data-category="Moisturizer" data-price="44">
                    <div class="card">
                        <img src="images/product2.jpg" class="card-img-top" alt="Product 2">
                        <div class="card-body">
                            <h6 class="card-title">Antiaging Skin Oil</h6>
                            <p class="text-muted">Moisturizer</p>
                            <p class="fw-bold">$44.90</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 product" data-category="Cleanser" data-price="34">
                    <div class="card">
                        <img src="images/product3.jpg" class="card-img-top" alt="Product 3">
                        <div class="card-body">
                            <h6 class="card-title">Balancing Daily Cleanser</h6>
                            <p class="text-muted">Cleanser</p>
                            <p class="fw-bold">$34.90</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add JavaScript for filtering functionality -->
<script>
    document.getElementById("priceRange").addEventListener("input", function() {
        document.getElementById("priceValue").textContent = `10 - ${this.value}`;
    });

    document.getElementById("filterBtn").addEventListener("click", function() {
        let maxPrice = document.getElementById("priceRange").value;
        let products = document.querySelectorAll(".product");
        
        products.forEach(product => {
            let productPrice = parseFloat(product.getAttribute("data-price"));
            product.style.display = productPrice <= maxPrice ? "block" : "none";
        });
    });

    document.querySelectorAll(".category-filter").forEach(category => {
        category.addEventListener("click", function() {
            let selectedCategory = this.getAttribute("data-category");
            let products = document.querySelectorAll(".product");
            
            products.forEach(product => {
                let productCategory = product.getAttribute("data-category");
                product.style.display = productCategory === selectedCategory ? "block" : "none";
            });
        });
    });
</script>

<!-- Add CSS for styling -->
<style>
    .list-group-item {
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .product {
        margin-bottom: 20px;
    }
    .card img {
        width: 100%;
        height: auto;
    }
</style>
