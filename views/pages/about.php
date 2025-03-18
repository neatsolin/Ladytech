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

    

     <!-- Product Cards Section -->
     <div class="col-md-9">
         <div class="row px-3 py-4" id="productList">
             <!-- Product Card 1 -->
             <h1  style="color:rgb(6, 168, 73);">Show of Categories</h1>
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="1">
                 <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                         <img src="/views/assets/images/Snacks (7)/Buldak hot.png" alt="Floral Serum" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                         <button class="view-details-btn" onclick="viewDetails(1)">View Details</button>
                     </div>
                     <div class="card-body d-flex flex-column">
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
                         <p class="card-text">Hydrate your skin with this lightweight floral serum.</p>
                         <div class="price mt-auto">Price: $50.99</div>
                         <div class="d-flex justify-content-between mt-2">
                             <button class="btn btn-purple text-white" style="border-radius: 8px;"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white" style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- card 2 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="2">
                 <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                         <img src="/views/assets/images/Snacks (7)/Good Noodle.png" alt="Serum 2" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                         <button class="view-details-btn" onclick="viewDetails(2)">View Details</button>
                     </div>
                     <div class="card-body d-flex flex-column">
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
                         <div class="price mt-auto">Price: $40.99</div>
                         <div class="d-flex justify-content-between mt-2">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- card 3 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="3">
                 <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                         <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Serum 3" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                         <button class="view-details-btn" onclick="viewDetails(3)">View Details</button>
                     </div>
                     <div class="card-body d-flex flex-column">
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
                         <div class="price mt-auto">Price: $45.99</div>
                         <div class="d-flex justify-content-between mt-2">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Product Card 4 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="4">
                 <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                         <img src="/views/assets/images/Clothing(7)/Comfort Blue.png" alt="Serum 4" class="img-fluid">
                         <button class="view-details-btn" onclick="viewDetails(4)">View Details</button>
                     </div>
                     <div class="card-body d-flex flex-column">
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
                         <div class="price mt-auto">Price: $60.99</div>
                         <div class="d-flex justify-content-between mt-2">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Product Card 5 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="5">
                 <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                         <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Serum 5" class="img-fluid">
                         <button class="view-details-btn" onclick="viewDetails(5)">View Details</button>
                     </div>
                     <div class="card-body d-flex flex-column">
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
                         <div class="price mt-auto">Price: $55.99</div>
                         <div class="d-flex justify-content-between mt-2">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Product Card 6 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="6">
                 <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                         <img src="/views/assets/images/Clothing(7)/Pao Pink Detergent.png" alt="Serum 6" class="img-fluid">
                         <button class="view-details-btn" onclick="viewDetails(6)">View Details</button>
                     </div>
                     <div class="card-body d-flex flex-column">
                         <div class="d-flex justify-content-between align-items-center mb-2">
                             <h6 class="card-title">Pao Pink Detergent</h6>
                             <i class="bi bi-heart" data-heart-id="6" onclick="toggleFavorite(6)"></i>
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
                         <div class="price mt-auto">Price: $42.99</div>
                         <div class="d-flex justify-content-between mt-2">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Product Card 7 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="7">
                 <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                         <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Serum 7" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                         <button class="view-details-btn" onclick="viewDetails(7)">View Details</button>
                     </div>
                     <div class="card-body">
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
                         <div class="d-flex justify-content-between">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Product Card 8 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="8">
                 <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                         <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Serum 8" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                         <button class="view-details-btn" onclick="viewDetails(8)">View Details</button>
                     </div>
                     <div class="card-body">
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
                         <div class="d-flex justify-content-between">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Product Card 9 -->
             <div class="col-md-4 col-sm-6 mb-4" data-product-id="9">
                 <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                     <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                         <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Serum 9" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                         <button class="view-details-btn" onclick="viewDetails(9)">View Details</button>
                     </div>
                     <div class="card-body">
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
                         <div class="d-flex justify-content-between">
                             <button class="btn btn-purple text-white"><i class="bi bi-cart"></i> Add to Cart</button>
                             <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                         </div>
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