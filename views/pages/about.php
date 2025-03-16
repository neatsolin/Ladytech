<style>
    .card {
            border: 1px solid #e1e1e1; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            transition: transform 0.2s; 
            height: 300px; 
            margin-bottom: 30px;
        }
        .card:hover {
            transform: translateY(-5px); 
        }
        .icon {
            font-size: 40px; 
            margin-bottom: 15px; 
            color: #007bff; 
        }
        .card-title {
            font-size: 20px; 
            font-weight: bold; 
        }
        .card-text {
            color: #6c757d; 
            margin-top: auto; 
        }
        
        
</style>
<!-- Profile Section -->
<section class="profile py-5 bg-light">
    <div class="container">
        <div class="row align-items-center flex-md-row-reverse">
            <!-- 🖼️ Image Section -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <div class="profile-img-wrapper">
                    <img id="profileImg" src="views/assets/about-images/card.png" alt="Profile Picture" class="profile-img img-fluid shadow-lg" style="max-width: 100%; height: auto;">
                </div>
            </div>
            <!-- 📝 Text Section -->
            <div class="col-md-7">
                <h2 class="mb-3 fw-bold text-success">We Are Your Favorite Store</h2>
                <p class="text-muted lead mb-3">At <strong>We Are Your Favorite Store</strong>, we provide high-quality products, great prices, and a seamless shopping experience.</p>
                <p class="text-muted mb-4">We prioritize trust, quality, and innovation, ensuring every product is reliable. Our sellers offer unique, affordable, and highly rated products with engaging visuals, competitive pricing, and excellent service.</p>
                <a href="#shop-now" class="btn btn-success btn-lg mt-3 px-4 py-2 rounded-pill shadow-sm">Shop Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats py-3 bg-dark text-white">
    <div class="container">
        <div class="row text-center text-md-start align-items-center">
            <div class="col-md-3 mb-3 mb-md-0">
                <h4 class="fw-bold mb-2 fs-6">Numbers Speak <br>for Themselves!</h4>
                <p class="text-muted small">Impressive stats about our products and categories!</p>
            </div>
            <div class="col-md-3 stat position-relative mb-3 mb-md-0">
                <div class="icon-overlay mb-1">
                    <i class="bi bi-boxes fs-5 text-success"></i>
                </div>
                <h3 class="fw-bold fs-6" id="owned-products">0+</h3>
                <h6 class="text-light small">Owned Products</h6>
            </div>
            <div class="col-md-3 stat position-relative mb-3 mb-md-0">
                <div class="icon-overlay mb-1">
                    <i class="bi bi-tags fs-5 text-success"></i>
                </div>
                <h3 class="fw-bold fs-6" id="curated-products">0+</h3>
                <h6 class="text-light small">Curated Products</h6>
            </div>
            <div class="col-md-3 stat position-relative mb-3 mb-md-0">
                <div class="icon-overlay mb-1">
                    <i class="bi bi-grid fs-5 text-success"></i>
                </div>
                <h3 class="fw-bold fs-6" id="product-categories">0+</h3>
                <h6 class="text-light small">Product Categories</h6>
            </div>
        </div>
    </div>
</section>

<!-- card -->
<section class="shop-categories py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold display-5 text-primary">Shop By Categories</h2>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
            <!-- Product Card 1 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Pocari Sweat.png" alt="Beverages" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Beverages</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(3.5)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 2 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Clothes.png" alt="Clothes" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Clothes</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.0)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 3 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Electronics.png" alt="Electronics" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Electronics</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.3)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 4 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Furniture.png" alt="Furniture" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Furniture</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.7)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 5 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Accessories.png" alt="Accessories" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Accessories</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.8)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 6 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Toys.png" alt="Toys" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Toys</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(3.9)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 7 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Books.png" alt="Books" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Books</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.5)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 8 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Beauty.png" alt="Beauty" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Beauty</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.6)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Card 9 -->
            <div class="col">
                <a href="#" class="text-decoration-none shop-card-link">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg shop-card">
                        <div class="card-img-wrapper position-relative">
                            <img src="/views/assets/about-images/Shoes.png" alt="Shoes" class="card-img-top">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        </div>
                        <div class="card-body text-center py-3">
                            <h5 class="card-title fw-bold mb-2 text-dark">Shoes</h5>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-2">
                            <div class="star-rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <span class="ms-2 text-muted small">(4.2)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- uder card -->
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card p-4 d-flex flex-column"> <!-- Increased padding -->
                <div class="icon mb-3"><i class="fas fa-check-circle"></i></div> <!-- Icon padding -->
                <div class="card-title mb-3">Legitimate Businesses</div> <!-- Title padding -->
                <div class="card-text mb-3">Legally registered, sells genuine products, and provides reliable service.</div> <!-- Text padding -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 d-flex flex-column"> <!-- Increased padding -->
                <div class="icon mb-3"><i class="fas fa-chart-line"></i></div> <!-- Icon padding -->
                <div class="card-title mb-3">Real Data</div> <!-- Title padding -->
                <div class="card-text mb-3">Offers accurate product details and honest descriptions.</div> <!-- Text padding -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 d-flex flex-column"> <!-- Increased padding -->
                <div class="icon mb-3"><i class="fas fa-exchange-alt"></i></div> <!-- Icon padding -->
                <div class="card-title mb-3">Done For You Migrations</div> <!-- Title padding -->
                <div class="card-text mb-3">Ensures smooth transfers or setups for customers.</div> <!-- Text padding -->
            </div>
        </div>
    </div>
</div>
