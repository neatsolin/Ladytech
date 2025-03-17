     

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
                <h2 class="mb-3 fw-bold " style="color:rgb(6, 168, 73);">We Are Your Favorite Store</h2>
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

<div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/ACNES.png" alt="Serum 1" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 1</h6>
                        <i class="bi bi-heart heart-icon" id="heart1" onclick="toggleFavorite(1)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star1_1" onclick="setRating(1, 1)">★</span>
                        <span class="star" id="star1_2" onclick="setRating(1, 2)">★</span>
                        <span class="star" id="star1_3" onclick="setRating(1, 3)">★</span>
                        <span class="star" id="star1_4" onclick="setRating(1, 4)">★</span>
                        <span class="star" id="star1_5" onclick="setRating(1, 5)">★</span> 
                        <span id="rating1">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(1)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(1)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Knorr.png" alt="Serum 2" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 2</h6>
                        <i class="bi bi-heart heart-icon" id="heart2" onclick="toggleFavorite(2)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star2_1" onclick="setRating(2, 1)">★</span>
                        <span class="star" id="star2_2" onclick="setRating(2, 2)">★</span>
                        <span class="star" id="star2_3" onclick="setRating(2, 3)">★</span>
                        <span class="star" id="star2_4" onclick="setRating(2, 4)">★</span>
                        <span class="star" id="star2_5" onclick="setRating(2, 5)">★</span> 
                        <span id="rating2">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(2)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(2)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Sofy Cooling fresh.png" alt="Serum 3" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 3</h6>
                        <i class="bi bi-heart heart-icon" id="heart3" onclick="toggleFavorite(3)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star3_1" onclick="setRating(3, 1)">★</span>
                        <span class="star" id="star3_2" onclick="setRating(3, 2)">★</span>
                        <span class="star" id="star3_3" onclick="setRating(3, 3)">★</span>
                        <span class="star" id="star3_4" onclick="setRating(3, 4)">★</span>
                        <span class="star" id="star3_5" onclick="setRating(3, 5)">★</span> 
                        <span id="rating3">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(3)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(3)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Ring Floor.png" alt="Serum 4" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 4</h6>
                        <i class="bi bi-heart heart-icon" id="heart4" onclick="toggleFavorite(4)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star4_1" onclick="setRating(4, 1)">★</span>
                        <span class="star" id="star4_2" onclick="setRating(4, 2)">★</span>
                        <span class="star" id="star4_3" onclick="setRating(4, 3)">★</span>
                        <span class="star" id="star4_4" onclick="setRating(4, 4)">★</span>
                        <span class="star" id="star4_5" onclick="setRating(4, 5)">★</span> 
                        <span id="rating4">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(4)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(4)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Pocari Sweat.png" alt="Serum 5" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 5</h6>
                        <i class="bi bi-heart heart-icon" id="heart5" onclick="toggleFavorite(5)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star5_1" onclick="setRating(5, 1)">★</span>
                        <span class="star" id="star5_2" onclick="setRating(5, 2)">★</span>
                        <span class="star" id="star5_3" onclick="setRating(5, 3)">★</span>
                        <span class="star" id="star5_4" onclick="setRating(5, 4)">★</span>
                        <span class="star" id="star5_5" onclick="setRating(5, 5)">★</span> 
                        <span id="rating5">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(5)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(5)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Muyly toothbrush.png" alt="Serum 6" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 6</h6>
                        <i class="bi bi-heart heart-icon" id="heart6" onclick="toggleFavorite(6)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star6_1" onclick="setRating(6, 1)">★</span>
                        <span class="star" id="star6_2" onclick="setRating(6, 2)">★</span>
                        <span class="star" id="star6_3" onclick="setRating(6, 3)">★</span>
                        <span class="star" id="star6_4" onclick="setRating(6, 4)">★</span>
                        <span class="star" id="star6_5" onclick="setRating(6, 5)">★</span> 
                        <span id="rating6">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(6)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(6)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Pao Pink Detergent.png" alt="Serum 7" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 7</h6>
                        <i class="bi bi-heart heart-icon" id="heart7" onclick="toggleFavorite(7)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star7_1" onclick="setRating(7, 1)">★</span>
                        <span class="star" id="star7_2" onclick="setRating(7, 2)">★</span>
                        <span class="star" id="star7_3" onclick="setRating(7, 3)">★</span>
                        <span class="star" id="star7_4" onclick="setRating(7, 4)">★</span>
                        <span class="star" id="star7_5" onclick="setRating(7, 5)">★</span> 
                        <span id="rating7">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(7)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(7)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Mama tom yum.png" alt="Serum 8" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 8</h6>
                        <i class="bi bi-heart heart-icon" id="heart8" onclick="toggleFavorite(8)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star8_1" onclick="setRating(8, 1)">★</span>
                        <span class="star" id="star8_2" onclick="setRating(8, 2)">★</span>
                        <span class="star" id="star8_3" onclick="setRating(8, 3)">★</span>
                        <span class="star" id="star8_4" onclick="setRating(8, 4)">★</span>
                        <span class="star" id="star8_5" onclick="setRating(8, 5)">★</span> 
                        <span id="rating8">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(8)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(8)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>
            <!-- Card 9 -->
            <div class="col">
                <div class="card text-start shadow-sm p-3 rounded-3">
                    <div class="image-wrapper d-flex justify-content-center align-items-center">
                        <img src="views/assets/about-images/Eau Kulen small.png" alt="Serum 9" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h6 class="fw-bold">Serum 9</h6>
                        <i class="bi bi-heart heart-icon" id="heart9" onclick="toggleFavorite(9)" style="cursor: pointer; color: black;"></i>
                    </div>
                    <div class="text-dark small">
                        <span class="star" id="star9_1" onclick="setRating(9, 1)">★</span>
                        <span class="star" id="star9_2" onclick="setRating(9, 2)">★</span>
                        <span class="star" id="star9_3" onclick="setRating(9, 3)">★</span>
                        <span class="star" id="star9_4" onclick="setRating(9, 4)">★</span>
                        <span class="star" id="star9_5" onclick="setRating(9, 5)">★</span> 
                        <span id="rating9">(0)</span>
                    </div>
                    <p class="text-muted small">Replenish your skin with this amazing serum.</p>
                    <div class="fw-bold">Price: $60.99</div>
                    <div class="d-flex justify-content-between gap-2">
                        <button class="btn btn-purple text-white mt-2 w-30" onclick="addToCart(9)"><i class="bi bi-cart"></i> Add to Cart</button>
                        <button class="btn btn-light btn-green mt-2 w-30" onclick="buyNow(9)"><i class="bi bi-check-circle"></i> Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- User Card Section -->
<div class="container mt-4">
    <div class="row text-center justify-content-center">
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

