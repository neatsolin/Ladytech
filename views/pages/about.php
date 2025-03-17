
<style>
    /* General Card Styling */
    .card {
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        height: 400px;
        margin-bottom: 30px;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }

    /* Card Image */
    .card-img-top {
        height: 300px;
        width: 100%;
        object-fit: cover;
    }

    /* .card:hover .card-img-top {
        transform: scale(1.05);
    } */

    /* Card Icons */
    .icon {
        font-size: 40px;
        margin-bottom: 15px;
        color: #007bff;
    }

    .icon-large {
        font-size: 3rem;
    }

    /* Card Text */
    .card-title {
        font-size: 20px;
        font-weight: bold;
    }

    .card-text {
        color: #6c757d;
        margin-top: auto;
    }

    /* Profile Section */
    .profile-img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    /* Stats Section */
    .stats h3 {
        font-size: 2rem;
    }

    .hover-effect:hover {
        transform: translateY(-5px);  /* Moves the card up slightly */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);  /* Adds a shadow for depth */
    }

    /* Base styles for cards */
    .small-card {
        border: 2px solid #ccc;
        position: relative;
        overflow: hidden;
        background-color: #fff; 
        color: #333;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
    }

    /* Hover Effect for Cards */
   
    /* Hover State: Color changes and lifts */
    .hover-effect:hover {
        transform: translateY(-5px);  
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);  
        border-color:rgb(27, 155, 96); 
        background-color: #fff; 
        color: #007bff; 
    }



    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .icon-large {
            font-size: 2.5rem; /* Adjust icon size for mobile */
        }

        .stats h3 {
            font-size: 1.8rem; /* Adjust number sizes for mobile */
        }
    }
</style>

        
</style>
<!-- Profile Section -->
<section class="profile py-5 bg-light">
    <div class="container">
        <div class="row align-items-center flex-md-row-reverse">
            <!-- 🖼️ Image Section -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <div class="profile-img-wrapper">
                    <img id="profileImg" src="views/assets/about-images/card.png" alt="Profile Picture" class="profile-img img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
                </div>
            </div>
            <!-- 📝 Text Section -->
            <div class="col-md-7">
                <h2 class="mb-3 fw-bold text-success">We Are Your Favorite Store</h2>
                <p class="text-muted lead mb-3">At We Are Your Favorite Store, we are committed to 
providing high-quality products, great prices, and 
a seamless shopping experience. Our goal is to
connect customers with passionate sellers who offer
carefully curated products that bring value and satisfaction.</p>
                <p class="text-muted mb-4">We prioritize customer trust, quality, innovation, and community
 ensuring that every product is reliable and worth your investme
nt. Our sellers focus on delivering unique, affordable, and highly 
rated products that capture customer interest through engaging
 visuals, competitive pricing, and excellent service.</p>
                <a href="#shop-now" class="btn btn-success btn-lg mt-3 px-4 py-2 rounded-pill shadow-sm">Shop Now</a>
            </div>
        </div>
    </div>
</section>



<!-- Stats Section -->
<section class="stats py-5 bg-dark text-white">
    <div class="container">
        <div class="row text-center text-md-start align-items-center">
            <!-- Title Section -->
            <div class="col-md-3 mb-3 mb-md-0">
                <h4 class="fw-bold mb-4 fs-4">Numbers Speak <br>for Themselves!</h4>
                <p class="text-muted small">Impressive stats about our products and categories!</p>
            </div>

            <!-- Stats Item 1 -->
            <div class="col-md-3 stat text-center mb-3 mb-md-0">
                <div class="icon-overlay mb-3">
                    <i class="bi bi-boxes text-success icon-large"></i>
                </div>
                <h3 class="fw-bold fs-3" id="owned-products">0+</h3>
                <h6 class="text-light">Owned Products</h6>
            </div>

            <!-- Stats Item 2 -->
            <div class="col-md-3 stat text-center mb-3 mb-md-0">
                <div class="icon-overlay mb-3">
                    <i class="bi bi-tags text-success icon-large"></i>
                </div>
                <h3 class="fw-bold fs-3" id="curated-products">0+</h3>
                <h6 class="text-light">Curated Products</h6>
            </div>

            <!-- Stats Item 3 -->
            <div class="col-md-3 stat text-center mb-3 mb-md-0">
                <div class="icon-overlay mb-3">
                    <i class="bi bi-grid text-success icon-large"></i>
                </div>
                <h3 class="fw-bold fs-3" id="product-categories">0+</h3>
                <h6 class="text-light">Product Categories</h6>
            </div>
        </div>
    </div>
</section>

<!-- Shop By Categories Section -->
<section class="shop-categories py-5 bg-light">
    <div class="container">
    <h2 class="text-center mb-5 fw-bold display-5" style="color: #00C853;">Shop By Categories</h2>


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
            
            <!-- Product Card 1 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='beverages.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="/views/assets/about-images/Pocari Sweat.png" alt="Beverages" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Beverages</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 2 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='clothes.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="views/assets/about-images/Eau Kulen small.png" alt="Clothes" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Drinking Water</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 3 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='electronics.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="views/assets/about-images/Sofy Cooling fresh.png" alt="Electronics" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Feminine Hygiene</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 4 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='cleaning.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="/views/assets/about-images/Pao Pink Detergent.png" alt="Cleaning" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Soap</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 5 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='furniture.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="/views/assets/about-images/Ring Floor.png" alt="Furniture" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Household Hygiene</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 6 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='toys.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="/views/assets/about-images/Knorr.png" alt="Toys" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Cooking Ingredients</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 7 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='instant-noodles.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="views/assets/about-images/Mama tom yum.png" alt="Instant Noodles" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Snacks</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 8 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='skincare.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="/views/assets/about-images/ACNES.png" alt="Skincare" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Oral Health</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 9 -->
            <div class="col">
                <a href="#" class="text-decoration-none" onclick="window.location.href='skincare.html'">
                    <div class="card h-100 border-0 shadow-lg rounded-4 text-center d-flex flex-column">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="flex-grow: 1; cursor: pointer;">
                            <img src="views/assets/about-images/Muyly toothbrush.png" alt="Skincare" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">Oral Health</h5>
                            <div class="d-flex justify-content-center">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>


<!-- User Card Section -->
<!-- User Card Section -->
<div class="container mt-4">
    <div class="row text-center justify-content-center">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="small-card shadow-sm p-3 rounded hover-effect" style="height: 250px;">
                <div class="icon">
                    <i class="fas fa-check-circle text-primary"></i> 
                </div>
                <h6 class="fw-bold mt-2">Legitimate Businesses</h6>
                <p class="text-muted">Legally registered, sells genuine products, and provides reliable service.</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="small-card shadow-sm p-3 rounded hover-effect" style="height: 250px;">
                <div class="icon">
                    <i class="fas fa-chart-line text-success"></i> 
                </div>
                <h6 class="fw-bold mt-2">Real Data</h6>
                <p class="text-muted">Offers accurate product details and honest descriptions.</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="small-card shadow-sm p-3 rounded hover-effect" style="height: 250px;">
                <div class="icon">
                    <i class="fas fa-exchange-alt text-warning"></i> 
                </div>
                <h6 class="fw-bold mt-2">Done For You Migrations</h6>
                <p class="text-muted">Ensures smooth transfers or setups for customers.</p>
            </div>
        </div>
    </div>
</div>

