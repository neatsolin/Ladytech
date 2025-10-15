```php
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }

    /* Original Carousel Styles (Unchanged) */
    .hero-section {
      height: 100vh;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-carousel {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }

    .carousel-inner {
      height: 100%;
    }

    .carousel-item {
      height: 100vh;
      background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3));
      transition: transform 0.8s ease-in-out, opacity 0.8s ease-in-out;
    }

    .carousel-item img {
      max-height: 70vh;
      width: auto;
      object-fit: contain;
      margin: 0 auto;
      padding: 2rem;
    }

    .carousel-caption {
      background: rgba(0, 0, 0, 0.6);
      border-radius: 10px;
      padding: 1.5rem;
      bottom: 20%;
    }

    .carousel-caption h4 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #fff;
    }

    .carousel-caption h1 {
      font-size: 4rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
      color: #fff;
    }

    .carousel-caption p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
      color: #fff;
    }

    .carousel-caption .btn-success {
      font-size: 1.2rem;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      background-color: #28a745;
      border: none;
    }

    .carousel-caption .btn-success:hover {
      background-color: #218838;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
      background: none;
      opacity: 0.7;
      transition: opacity 0.3s ease;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
      opacity: 1;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
      width: 20px;
      height: 20px;
    }

    .carousel-control-next-icon {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
    }

    .carousel-indicators {
      bottom: 20px;
    }

    .carousel-indicators [data-bs-target] {
      background-color: #28a745;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      margin: 0 6px;
    }

    /* Product Card Styles */
    .product-card {
      position: relative;
      height: 350px;
      border-radius: 16px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
      background: linear-gradient(145deg, #ffffff, #f1f5f9);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }

    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .product-img-container {
      height: 200px;
      background: linear-gradient(180deg, #e2e8f0, #f8fafc);
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }

    .product-img-container img {
      max-height: 90%;
      object-fit: contain;
      transition: transform 0.4s ease;
    }

    .product-card:hover .product-img-container img {
      transform: scale(1.08);
    }

    .product-overlay {
      position: absolute;
      top: 200px;
      left: 0;
      width: 100%;
      height: 150px;
      background: rgba(0, 0, 0, 0.75);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
      color: #fff;
      text-align: center;
      padding: 15px;
    }

    .product-card:hover .product-overlay {
      opacity: 1;
    }

    .product-overlay h5 {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .product-overlay .price {
      font-size: 1.1rem;
      font-weight: 500;
      margin-bottom: 10px;
      color: #a3e635;
    }

    .product-overlay .rating {
      margin-bottom: 10px;
    }

    .product-overlay .btn-success {
      border-radius: 50px;
      padding: 8px 20px;
      font-size: 0.9rem;
      background-color: #28a745;
      border: none;
      transition: background-color 0.3s, transform 0.3s;
      font-weight: 500;
    }

    .product-overlay .btn-success:hover {
      background-color: #218838;
      transform: translateY(-3px);
    }

    .star {
      font-size: 1rem;
      color: #d1d5db;
      cursor: pointer;
      transition: color 0.2s;
    }

    .star:hover,
    .star.hovered,
    .star.filled {
      color: #f59e0b;
    }

    .bi-heart {
      cursor: pointer;
      font-size: 1.2rem;
      color: #9ca3af;
      transition: color 0.2s, transform 0.2s;
      position: absolute;
      top: 12px;
      right: 12px;
      z-index: 10;
    }

    .bi-heart.filled {
      color: #dc2626;
      transform: scale(1.1);
    }

    .bi-heart:hover {
      color: #dc2626;
      transform: scale(1.1);
    }

    .badge {
      font-size: 0.8rem;
      padding: 6px 12px;
      border-radius: 12px;
      font-weight: 500;
      position: absolute;
      top: 12px;
      left: 12px;
      z-index: 10;
    }

    /* Modal Styles */
    .modal-content {
      border-radius: 16px;
      background: linear-gradient(145deg, #ffffff, #f1f5f9);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      border: none;
    }

    .modal-header {
      border-bottom: none;
      padding: 1.5rem;
    }

    .modal-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #1f2937;
    }

    .modal-body {
      padding: 1.5rem;
    }

    .modal-img {
      max-height: 300px;
      object-fit: contain;
      margin-bottom: 1rem;
    }

    .modal-body h5 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .modal-body .price {
      font-size: 1.3rem;
      font-weight: 500;
      color: #a3e635;
      margin-bottom: 0.5rem;
    }

    .modal-body .category {
      font-size: 1rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .modal-body .description {
      font-size: 1rem;
      color: #4b5563;
      margin-bottom: 1rem;
    }

    .modal-body .stock-status {
      font-size: 1rem;
      font-weight: 500;
      color: #28a745;
      margin-bottom: 1rem;
    }

    .modal-body .rating {
      margin-bottom: 1rem;
    }

    .modal-footer {
      border-top: none;
      padding: 1.5rem;
    }

    .modal-footer .btn-secondary {
      border-radius: 50px;
      padding: 8px 20px;
      font-size: 0.9rem;
      background-color: #6b7280;
      border: none;
    }

    .modal-footer .btn-secondary:hover {
      background-color: #4b5563;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .carousel-item img {
        max-height: 50vh;
        padding: 1rem;
      }
      .carousel-caption h4 {
        font-size: 1.8rem;
      }
      .carousel-caption h1 {
        font-size: 2.5rem;
      }
      .carousel-caption p {
        font-size: 1rem;
      }
      .carousel-caption .btn-success {
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
      }
      .carousel-indicators {
        bottom: 10px;
      }
      .product-card {
        height: 300px;
      }
      .product-img-container {
        height: 160px;
      }
      .product-overlay {
        top: 160px;
        height: 140px;
      }
      .product-overlay h5 {
        font-size: 1.1rem;
      }
      .product-overlay .price {
        font-size: 0.95rem;
      }
      .product-overlay .btn-success {
        padding: 7px 18px;
        font-size: 0.85rem;
      }
      .modal-img {
        max-height: 200px;
      }
      .modal-title {
        font-size: 1.5rem;
      }
      .modal-body h5 {
        font-size: 1.3rem;
      }
      .modal-body .price {
        font-size: 1.1rem;
      }
    }

    @media (max-width: 480px) {
      .carousel-item img {
        max-height: 40vh;
        padding: 0.5rem;
      }
      .carousel-caption h4 {
        font-size: 1.2rem;
      }
      .carousel-caption h1 {
        font-size: 1.8rem;
      }
      .carousel-caption p {
        font-size: 0.9rem;
      }
      .carousel-caption .btn-success {
        font-size: 0.9rem;
        padding: 0.4rem 1.2rem;
      }
      .carousel-indicators {
        bottom: 5px;
      }
      .product-card {
        height: 260px;
      }
      .product-img-container {
        height: 140px;
      }
      .product-overlay {
        top: 140px;
        height: 120px;
      }
      .product-overlay h5 {
        font-size: 0.9rem;
      }
      .product-overlay .price {
        font-size: 0.85rem;
      }
      .product-overlay .btn-success {
        padding: 6px 16px;
        font-size: 0.8rem;
      }
      .badge {
        font-size: 0.7rem;
        padding: 5px 10px;
      }
      .modal-img {
        max-height: 150px;
      }
      .modal-title {
        font-size: 1.2rem;
      }
      .modal-body h5 {
        font-size: 1.1rem;
      }
      .modal-body .price {
        font-size: 0.95rem;
      }
    }
</style>
</head>
<body>
  <section class="hero-section py-8">
    <div class="hero-carousel">
      <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="ACNES Skincare" class="d-block img-fluid">
            <div class="carousel-caption d-md-block">
              <h4>Premium Skincare</h4>
              <h1>ACNES</h1>
              <p>Combat acne and restore your skin's natural glow.</p>
              <a href="/product/acnes" class="btn btn-success"><i class="bi bi-cart"></i> Shop Now</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="views/assets/about-images/Pocari Sweat.png" alt="Pocari Sweat" class="d-block img-fluid">
            <div class="carousel-caption d-md-block">
              <h4>Hydration Boost</h4>
              <h1>Pocari Sweat</h1>
              <p>Replenish electrolytes with refreshing hydration.</p>
              <a href="/product/pocari-sweat" class="btn btn-success"><i class="bi bi-cart"></i> Shop Now</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="views/assets/about-images/Pao Pink Detergent.png" alt="Pao Pink Detergent" class="d-block img-fluid">
            <div class="carousel-caption d-md-block">
              <h4>Powerful Cleaning</h4>
              <h1>Pao Pink</h1>
              <p>Effective detergent for spotless laundry.</p>
              <a href="/product/pao-pink" class="btn btn-success"><i class="bi bi-cart"></i> Shop Now</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="views/assets/images/Snacks (7)/Buldak Hot.png" alt="Buldak Hot" class="d-block img-fluid">
            <div class="carousel-caption d-md-block">
              <h4>Spicy Delight</h4>
              <h1>Buldak Hot</h1>
              <p>Fiery noodles for bold taste buds.</p>
              <a href="/product/buldak-hot" class="btn btn-success"><i class="bi bi-cart"></i> Shop Now</a>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="background-pattern"></div>
  </section>

  <div class="container py-5">
    <!-- Popular Products Section -->
    <h1 class="text-center mb-5" style="font-weight: 700; color: #1f2937;">Popular Products</h1>
    <div class="row" id="productList">
      <div class="col-md-3 col-sm-6 mb-4" data-product-id="1" onclick="viewDetails(1)">
        <div class="card product-card">
          <span class="badge bg-primary">Beverages</span>
          <i class="bi bi-heart" data-heart-id="1" onclick="toggleFavorite(this, 1, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/about-images/Pocari Sweat.png" alt="Pocari Sweat" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Pocari Sweat</h5>
            <div class="price">Price: $1</div>
            <div class="rating" data-product-id="1">
              <span class="star" onclick="setRating(1, 1, event)" onmouseover="highlightStars(1, 1)" onmouseout="resetStars(1)">★</span>
              <span class="star" onclick="setRating(1, 2, event)" onmouseover="highlightStars(1, 2)" onmouseout="resetStars(1)">★</span>
              <span class="star" onclick="setRating(1, 3, event)" onmouseover="highlightStars(1, 3)" onmouseout="resetStars(1)">★</span>
              <span class="star" onclick="setRating(1, 4, event)" onmouseover="highlightStars(1, 4)" onmouseout="resetStars(1)">★</span>
              <span class="star" onclick="setRating(1, 5, event)" onmouseover="highlightStars(1, 5)" onmouseout="resetStars(1)">★</span>
              <span class="rating-value" id="rating-value-1">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(1, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="2" onclick="viewDetails(2)">
        <div class="card product-card">
          <span class="badge bg-success">Detergents</span>
          <i class="bi bi-heart" data-heart-id="2" onclick="toggleFavorite(this, 2, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/about-images/Pao Pink Detergent.png" alt="Pao Pink" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Pao Pink</h5>
            <div class="price">Price: $7.00</div>
            <div class="rating" data-product-id="2">
              <span class="star" onclick="setRating(2, 1, event)" onmouseover="highlightStars(2, 1)" onmouseout="resetStars(2)">★</span>
              <span class="star" onclick="setRating(2, 2, event)" onmouseover="highlightStars(2, 2)" onmouseout="resetStars(2)">★</span>
              <span class="star" onclick="setRating(2, 3, event)" onmouseover="highlightStars(2, 3)" onmouseout="resetStars(2)">★</span>
              <span class="star" onclick="setRating(2, 4, event)" onmouseover="highlightStars(2, 4)" onmouseout="resetStars(2)">★</span>
              <span class="star" onclick="setRating(2, 5, event)" onmouseover="highlightStars(2, 5)" onmouseout="resetStars(2)">★</span>
              <span class="rating-value" id="rating-value-2">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(2, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="3" onclick="viewDetails(3)">
        <div class="card product-card">
          <span class="badge bg-info">Skincare</span>
          <i class="bi bi-heart" data-heart-id="3" onclick="toggleFavorite(this, 3, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/about-images/ACNES.png" alt="ACNES" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>ACNES</h5>
            <div class="price">Price: $1.5</div>
            <div class="rating" data-product-id="3">
              <span class="star" onclick="setRating(3, 1, event)" onmouseover="highlightStars(3, 1)" onmouseout="resetStars(3)">★</span>
              <span class="star" onclick="setRating(3, 2, event)" onmouseover="highlightStars(3, 2)" onmouseout="resetStars(3)">★</span>
              <span class="star" onclick="setRating(3, 3, event)" onmouseover="highlightStars(3, 3)" onmouseout="resetStars(3)">★</span>
              <span class="star" onclick="setRating(3, 4, event)" onmouseover="highlightStars(3, 4)" onmouseout="resetStars(3)">★</span>
              <span class="star" onclick="setRating(3, 5, event)" onmouseover="highlightStars(3, 5)" onmouseout="resetStars(3)">★</span>
              <span class="rating-value" id="rating-value-3">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(3, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="4" onclick="viewDetails(4)">
        <div class="card product-card">
          <span class="badge bg-warning text-dark">Snacks</span>
          <i class="bi bi-heart" data-heart-id="4" onclick="toggleFavorite(this, 4, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Snacks (7)/Buldak Hot.png" alt="Buldak Hot" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Buldak Hot</h5>
            <div class="price">Price: $1.5</div>
            <div class="rating" data-product-id="4">
              <span class="star" onclick="setRating(4, 1, event)" onmouseover="highlightStars(4, 1)" onmouseout="resetStars(4)">★</span>
              <span class="star" onclick="setRating(4, 2, event)" onmouseover="highlightStars(4, 2)" onmouseout="resetStars(4)">★</span>
              <span class="star" onclick="setRating(4, 3, event)" onmouseover="highlightStars(4, 3)" onmouseout="resetStars(4)">★</span>
              <span class="star" onclick="setRating(4, 4, event)" onmouseover="highlightStars(4, 4)" onmouseout="resetStars(4)">★</span>
              <span class="star" onclick="setRating(4, 5, event)" onmouseover="highlightStars(4, 5)" onmouseout="resetStars(4)">★</span>
              <span class="rating-value" id="rating-value-4">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(4, event)">View Details</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Type of Product Section -->
    <h1 class="text-center mb-5" style="font-weight: 700; color: #1f2937;">Type of Product</h1>
    <div class="row">
      <div class="col-md-3 col-sm-6 mb-4" data-product-id="5" onclick="viewDetails(5)">
        <div class="card product-card">
          <span class="badge bg-danger">Condiments</span>
          <i class="bi bi-heart" data-heart-id="5" onclick="toggleFavorite(this, 5, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Cooking ingredients (20)/KK Ketchup.png" alt="KK Ketchup" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>KK Ketchup</h5>
            <div class="price">Price: $1</div>
            <div class="rating" data-product-id="5">
              <span class="star" onclick="setRating(5, 1, event)" onmouseover="highlightStars(5, 1)" onmouseout="resetStars(5)">★</span>
              <span class="star" onclick="setRating(5, 2, event)" onmouseover="highlightStars(5, 2)" onmouseout="resetStars(5)">★</span>
              <span class="star" onclick="setRating(5, 3, event)" onmouseover="highlightStars(5, 3)" onmouseout="resetStars(5)">★</span>
              <span class="star" onclick="setRating(5, 4, event)" onmouseover="highlightStars(5, 4)" onmouseout="resetStars(5)">★</span>
              <span class="star" onclick="setRating(5, 5, event)" onmouseover="highlightStars(5, 5)" onmouseout="resetStars(5)">★</span>
              <span class="rating-value" id="rating-value-5">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(5, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="6" onclick="viewDetails(6)">
        <div class="card product-card">
          <span class="badge bg-secondary">Tissues</span>
          <i class="bi bi-heart" data-heart-id="6" onclick="toggleFavorite(this, 6, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Tissue (6)/Keepo pink.png" alt="Keepo Pink" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Keepo Pink</h5>
            <div class="price">Price: $3.2</div>
            <div class="rating" data-product-id="6">
              <span class="star" onclick="setRating(6, 1, event)" onmouseover="highlightStars(6, 1)" onmouseout="resetStars(6)">★</span>
              <span class="star" onclick="setRating(6, 2, event)" onmouseover="highlightStars(6, 2)" onmouseout="resetStars(6)">★</span>
              <span class="star" onclick="setRating(6, 3, event)" onmouseover="highlightStars(6, 3)" onmouseout="resetStars(6)">★</span>
              <span class="star" onclick="setRating(6, 4, event)" onmouseover="highlightStars(6, 4)" onmouseout="resetStars(6)">★</span>
              <span class="star" onclick="setRating(6, 5, event)" onmouseover="highlightStars(6, 5)" onmouseout="resetStars(6)">★</span>
              <span class="rating-value" id="rating-value-6">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(6, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="7" onclick="viewDetails(7)">
        <div class="card product-card">
          <span class="badge bg-dark">Laundry</span>
          <i class="bi bi-heart" data-heart-id="7" onclick="toggleFavorite(this, 7, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Liquid Detergent" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Liquid Detergent</h5>
            <div class="price">Price: $7.1</div>
            <div class="rating" data-product-id="7">
              <span class="star" onclick="setRating(7, 1, event)" onmouseover="highlightStars(7, 1)" onmouseout="resetStars(7)">★</span>
              <span class="star" onclick="setRating(7, 2, event)" onmouseover="highlightStars(7, 2)" onmouseout="resetStars(7)">★</span>
              <span class="star" onclick="setRating(7, 3, event)" onmouseover="highlightStars(7, 3)" onmouseout="resetStars(7)">★</span>
              <span class="star" onclick="setRating(7, 4, event)" onmouseover="highlightStars(7, 4)" onmouseout="resetStars(7)">★</span>
              <span class="star" onclick="setRating(7, 5, event)" onmouseover="highlightStars(7, 5)" onmouseout="resetStars(7)">★</span>
              <span class="rating-value" id="rating-value-7">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(7, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="8" onclick="viewDetails(8)">
        <div class="card product-card">
          <span class="badge bg-warning text-dark">Snacks</span>
          <i class="bi bi-heart" data-heart-id="8" onclick="toggleFavorite(this, 8, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Snacks (7)/Lays Classic.png" alt="Lays Classic" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Lays Classic</h5>
            <div class="price">Price: $1.2</div>
            <div class="rating" data-product-id="8">
              <span class="star" onclick="setRating(8, 1, event)" onmouseover="highlightStars(8, 1)" onmouseout="resetStars(8)">★</span>
              <span class="star" onclick="setRating(8, 2, event)" onmouseover="highlightStars(8, 2)" onmouseout="resetStars(8)">★</span>
              <span class="star" onclick="setRating(8, 3, event)" onmouseover="highlightStars(8, 3)" onmouseout="resetStars(8)">★</span>
              <span class="star" onclick="setRating(8, 4, event)" onmouseover="highlightStars(8, 4)" onmouseout="resetStars(8)">★</span>
              <span class="star" onclick="setRating(8, 5, event)" onmouseover="highlightStars(8, 5)" onmouseout="resetStars(8)">★</span>
              <span class="rating-value" id="rating-value-8">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(8, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="9" onclick="viewDetails(9)">
        <div class="card product-card">
          <span class="badge bg-info">Beverages</span>
          <i class="bi bi-heart" data-heart-id="9" onclick="toggleFavorite(this, 9, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Beverages (10)/Coca Cola.png" alt="Coca Cola" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Coca Cola</h5>
            <div class="price">Price: $0.8</div>
            <div class="rating" data-product-id="9">
              <span class="star" onclick="setRating(9, 1, event)" onmouseover="highlightStars(9, 1)" onmouseout="resetStars(9)">★</span>
              <span class="star" onclick="setRating(9, 2, event)" onmouseover="highlightStars(9, 2)" onmouseout="resetStars(9)">★</span>
              <span class="star" onclick="setRating(9, 3, event)" onmouseover="highlightStars(9, 3)" onmouseout="resetStars(9)">★</span>
              <span class="star" onclick="setRating(9, 4, event)" onmouseover="highlightStars(9, 4)" onmouseout="resetStars(9)">★</span>
              <span class="star" onclick="setRating(9, 5, event)" onmouseover="highlightStars(9, 5)" onmouseout="resetStars(9)">★</span>
              <span class="rating-value" id="rating-value-9">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(9, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="10" onclick="viewDetails(10)">
        <div class="card product-card">
          <span class="badge bg-primary">Skincare</span>
          <i class="bi bi-heart" data-heart-id="10" onclick="toggleFavorite(this, 10, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Feminine Hygiene (10)/Nivea Cream.png" alt="Nivea Cream" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Nivea Cream</h5>
            <div class="price">Price: $2.5</div>
            <div class="rating" data-product-id="10">
              <span class="star" onclick="setRating(10, 1, event)" onmouseover="highlightStars(10, 1)" onmouseout="resetStars(10)">★</span>
              <span class="star" onclick="setRating(10, 2, event)" onmouseover="highlightStars(10, 2)" onmouseout="resetStars(10)">★</span>
              <span class="star" onclick="setRating(10, 3, event)" onmouseover="highlightStars(10, 3)" onmouseout="resetStars(10)">★</span>
              <span class="star" onclick="setRating(10, 4, event)" onmouseover="highlightStars(10, 4)" onmouseout="resetStars(10)">★</span>
              <span class="star" onclick="setRating(10, 5, event)" onmouseover="highlightStars(10, 5)" onmouseout="resetStars(10)">★</span>
              <span class="rating-value" id="rating-value-10">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(10, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="11" onclick="viewDetails(11)">
        <div class="card product-card">
          <span class="badge bg-success">Condiments</span>
          <i class="bi bi-heart" data-heart-id="11" onclick="toggleFavorite(this, 11, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Cooking ingredients (20)/Soy Sauce.png" alt="Soy Sauce" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Soy Sauce</h5>
            <div class="price">Price: $1.3</div>
            <div class="rating" data-product-id="11">
              <span class="star" onclick="setRating(11, 1, event)" onmouseover="highlightStars(11, 1)" onmouseout="resetStars(11)">★</span>
              <span class="star" onclick="setRating(11, 2, event)" onmouseover="highlightStars(11, 2)" onmouseout="resetStars(11)">★</span>
              <span class="star" onclick="setRating(11, 3, event)" onmouseover="highlightStars(11, 3)" onmouseout="resetStars(11)">★</span>
              <span class="star" onclick="setRating(11, 4, event)" onmouseover="highlightStars(11, 4)" onmouseout="resetStars(11)">★</span>
              <span class="star" onclick="setRating(11, 5, event)" onmouseover="highlightStars(11, 5)" onmouseout="resetStars(11)">★</span>
              <span class="rating-value" id="rating-value-11">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(11, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="12" onclick="viewDetails(12)">
        <div class="card product-card">
          <span class="badge bg-dark">Laundry</span>
          <i class="bi bi-heart" data-heart-id="12" onclick="toggleFavorite(this, 12, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Clothing(7)/Fabric Softener.png" alt="Fabric Softener" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Fabric Softener</h5>
            <div class="price">Price: $5.0</div>
            <div class="rating" data-product-id="12">
              <span class="star" onclick="setRating(12, 1, event)" onmouseover="highlightStars(12, 1)" onmouseout="resetStars(12)">★</span>
              <span class="star" onclick="setRating(12, 2, event)" onmouseover="highlightStars(12, 2)" onmouseout="resetStars(12)">★</span>
              <span class="star" onclick="setRating(12, 3, event)" onmouseover="highlightStars(12, 3)" onmouseout="resetStars(12)">★</span>
              <span class="star" onclick="setRating(12, 4, event)" onmouseover="highlightStars(12, 4)" onmouseout="resetStars(12)">★</span>
              <span class="star" onclick="setRating(12, 5, event)" onmouseover="highlightStars(12, 5)" onmouseout="resetStars(12)">★</span>
              <span class="rating-value" id="rating-value-12">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(12, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="13" onclick="viewDetails(13)">
        <div class="card product-card">
          <span class="badge bg-warning text-dark">Snacks</span>
          <i class="bi bi-heart" data-heart-id="13" onclick="toggleFavorite(this, 13, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Snacks (7)/Pringles Original.png" alt="Pringles Original" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Pringles Original</h5>
            <div class="price">Price: $2.0</div>
            <div class="rating" data-product-id="13">
              <span class="star" onclick="setRating(13, 1, event)" onmouseover="highlightStars(13, 1)" onmouseout="resetStars(13)">★</span>
              <span class="star" onclick="setRating(13, 2, event)" onmouseover="highlightStars(13, 2)" onmouseout="resetStars(13)">★</span>
              <span class="star" onclick="setRating(13, 3, event)" onmouseover="highlightStars(13, 3)" onmouseout="resetStars(13)">★</span>
              <span class="star" onclick="setRating(13, 4, event)" onmouseover="highlightStars(13, 4)" onmouseout="resetStars(13)">★</span>
              <span class="star" onclick="setRating(13, 5, event)" onmouseover="highlightStars(13, 5)" onmouseout="resetStars(13)">★</span>
              <span class="rating-value" id="rating-value-13">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(13, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="14" onclick="viewDetails(14)">
        <div class="card product-card">
          <span class="badge bg-info">Beverages</span>
          <i class="bi bi-heart" data-heart-id="14" onclick="toggleFavorite(this, 14, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Beverages (10)/Pepsi.png" alt="Pepsi" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Pepsi</h5>
            <div class="price">Price: $0.9</div>
            <div class="rating" data-product-id="14">
              <span class="star" onclick="setRating(14, 1, event)" onmouseover="highlightStars(14, 1)" onmouseout="resetStars(14)">★</span>
              <span class="star" onclick="setRating(14, 2, event)" onmouseover="highlightStars(14, 2)" onmouseout="resetStars(14)">★</span>
              <span class="star" onclick="setRating(14, 3, event)" onmouseover="highlightStars(14, 3)" onmouseout="resetStars(14)">★</span>
              <span class="star" onclick="setRating(14, 4, event)" onmouseover="highlightStars(14, 4)" onmouseout="resetStars(14)">★</span>
              <span class="star" onclick="setRating(14, 5, event)" onmouseover="highlightStars(14, 5)" onmouseout="resetStars(14)">★</span>
              <span class="rating-value" id="rating-value-14">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(14, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="15" onclick="viewDetails(15)">
        <div class="card product-card">
          <span class="badge bg-primary">Skincare</span>
          <i class="bi bi-heart" data-heart-id="15" onclick="toggleFavorite(this, 15, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Feminine Hygiene (10)/Cetaphil Cleanser.png" alt="Cetaphil Cleanser" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Cetaphil Cleanser</h5>
            <div class="price">Price: $8.0</div>
            <div class="rating" data-product-id="15">
              <span class="star" onclick="setRating(15, 1, event)" onmouseover="highlightStars(15, 1)" onmouseout="resetStars(15)">★</span>
              <span class="star" onclick="setRating(15, 2, event)" onmouseover="highlightStars(15, 2)" onmouseout="resetStars(15)">★</span>
              <span class="star" onclick="setRating(15, 3, event)" onmouseover="highlightStars(15, 3)" onmouseout="resetStars(15)">★</span>
              <span class="star" onclick="setRating(15, 4, event)" onmouseover="highlightStars(15, 4)" onmouseout="resetStars(15)">★</span>
              <span class="star" onclick="setRating(15, 5, event)" onmouseover="highlightStars(15, 5)" onmouseout="resetStars(15)">★</span>
              <span class="rating-value" id="rating-value-15">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(15, event)">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4" data-product-id="16" onclick="viewDetails(16)">
        <div class="card product-card">
          <span class="badge bg-secondary">Tissues</span>
          <i class="bi bi-heart" data-heart-id="16" onclick="toggleFavorite(this, 16, event)"></i>
          <div class="product-img-container">
            <img src="views/assets/images/Tissue (6)/Kleenex Box.png" alt="Kleenex Box" class="img-fluid">
          </div>
          <div class="product-overlay">
            <h5>Kleenex Box</h5>
            <div class="price">Price: $4.0</div>
            <div class="rating" data-product-id="16">
              <span class="star" onclick="setRating(16, 1, event)" onmouseover="highlightStars(16, 1)" onmouseout="resetStars(16)">★</span>
              <span class="star" onclick="setRating(16, 2, event)" onmouseover="highlightStars(16, 2)" onmouseout="resetStars(16)">★</span>
              <span class="star" onclick="setRating(16, 3, event)" onmouseover="highlightStars(16, 3)" onmouseout="resetStars(16)">★</span>
              <span class="star" onclick="setRating(16, 4, event)" onmouseover="highlightStars(16, 4)" onmouseout="resetStars(16)">★</span>
              <span class="star" onclick="setRating(16, 5, event)" onmouseover="highlightStars(16, 5)" onmouseout="resetStars(16)">★</span>
              <span class="rating-value" id="rating-value-16">(0)</span>
            </div>
            <button class="btn btn-success" onclick="viewDetails(16, event)">View Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Detail Modal -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="modalImage" src="" alt="" class="img-fluid modal-img mx-auto d-block">
          <h5 id="modalName"></h5>
          <div id="modalPrice" class="price"></div>
          <div id="modalCategory" class="category"></div>
          <div id="modalDescription" class="description"></div>
          <div id="modalStock" class="stock-status"></div>
          <div class="rating" id="modalRating">
            <span class="star" onclick="setModalRating(1, event)" onmouseover="highlightModalStars(1)" onmouseout="resetModalStars()"></span>
            <span class="star" onclick="setModalRating(2, event)" onmouseover="highlightModalStars(2)" onmouseout="resetModalStars()"></span>
            <span class="star" onclick="setModalRating(3, event)" onmouseover="highlightModalStars(3)" onmouseout="resetModalStars()"></span>
            <span class="star" onclick="setModalRating(4, event)" onmouseover="highlightModalStars(4)" onmouseout="resetModalStars()"></span>
            <span class="star" onclick="setModalRating(5, event)" onmouseover="highlightModalStars(5)" onmouseout="resetModalStars()"></span>
            <span class="rating-value" id="modalRatingValue">(0)</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const products = {
      1: {
        name: "Pocari Sweat",
        price: "$1",
        category: "Beverages",
        description: "A refreshing isotonic drink that replenishes electrolytes and keeps you hydrated.",
        image: "views/assets/about-images/Pocari Sweat.png",
        stock: "In Stock"
      },
      2: {
        name: "Pao Pink",
        price: "$7.00",
        category: "Detergents",
        description: "A powerful laundry detergent for spotless clothes with a fresh scent.",
        image: "views/assets/about-images/Pao Pink Detergent.png",
        stock: "In Stock"
      },
      3: {
        name: "ACNES",
        price: "$1.5",
        category: "Skincare",
        description: "An effective acne treatment for clear and healthy skin.",
        image: "views/assets/about-images/ACNES.png",
        stock: "In Stock"
      },
      4: {
        name: "Buldak Hot",
        price: "$1.5",
        category: "Snacks",
        description: "Spicy instant noodles for a fiery and flavorful experience.",
        image: "views/assets/images/Snacks (7)/Buldak Hot.png",
        stock: "In Stock"
      },
      5: {
        name: "KK Ketchup",
        price: "$1",
        category: "Condiments",
        description: "Classic tomato ketchup, perfect for enhancing your meals.",
        image: "views/assets/images/Cooking ingredients (20)/KK Ketchup.png",
        stock: "In Stock"
      },
      6: {
        name: "Keepo Pink",
        price: "$3.2",
        category: "Tissues",
        description: "Soft and durable tissues for everyday use.",
        image: "views/assets/images/Tissue (6)/Keepo pink.png",
        stock: "In Stock"
      },
      7: {
        name: "Liquid Detergent",
        price: "$7.1",
        category: "Laundry",
        description: "Gentle yet effective liquid detergent for all types of fabrics.",
        image: "views/assets/images/Clothing(7)/Fineline Liquid Detergent.png",
        stock: "In Stock"
      },
      8: {
        name: "Lays Classic",
        price: "$1.2",
        category: "Snacks",
        description: "Crispy potato chips with a classic salted flavor.",
        image: "views/assets/images/Snacks (7)/Lays Classic.png",
        stock: "In Stock"
      },
      9: {
        name: "Coca Cola",
        price: "$0.8",
        category: "Beverages",
        description: "The iconic carbonated soft drink with a refreshing taste.",
        image: "views/assets/images/Beverages (10)/Coca Cola.png",
        stock: "In Stock"
      },
      10: {
        name: "Nivea Cream",
        price: "$2.5",
        category: "Skincare",
        description: "Moisturizing cream for soft and hydrated skin.",
        image: "views/assets/images/Feminine Hygiene (10)/Nivea Cream.png",
        stock: "In Stock"
      },
      11: {
        name: "Soy Sauce",
        price: "$1.3",
        category: "Condiments",
        description: "Rich and savory soy sauce for cooking and dipping.",
        image: "views/assets/images/Cooking ingredients (20)/Soy Sauce.png",
        stock: "In Stock"
      },
      12: {
        name: "Fabric Softener",
        price: "$5.0",
        category: "Laundry",
        description: "Softens fabrics and leaves clothes with a fresh fragrance.",
        image: "views/assets/images/Clothing(7)/Fabric Softener.png",
        stock: "In Stock"
      },
      13: {
        name: "Pringles Original",
        price: "$2.0",
        category: "Snacks",
        description: "Crispy, stackable potato chips with a unique flavor.",
        image: "views/assets/images/Snacks (7)/Pringles Original.png",
        stock: "In Stock"
      },
      14: {
        name: "Pepsi",
        price: "$0.9",
        category: "Beverages",
        description: "A bold and refreshing cola drink.",
        image: "views/assets/images/Beverages (10)/Pepsi.png",
        stock: "In Stock"
      },
      15: {
        name: "Cetaphil Cleanser",
        price: "$8.0",
        category: "Skincare",
        description: "Gentle facial cleanser for sensitive skin.",
        image: "views/assets/images/Feminine Hygiene (10)/Cetaphil Cleanser.png",
        stock: "In Stock"
      },
      16: {
        name: "Kleenex Box",
        price: "$4.0",
        category: "Tissues",
        description: "Premium facial tissues for comfort and durability.",
        image: "views/assets/images/Tissue (6)/Kleenex Box.png",
        stock: "In Stock"
      }
    };

    function setRating(productId, rating, event) {
      event.stopPropagation();
      const stars = document.querySelectorAll(`.rating[data-product-id="${productId}"] .star`);
      const ratingValue = document.querySelector(`#rating-value-${productId}`);
      stars.forEach((star, index) => {
        star.classList.toggle('filled', index < rating);
      });
      if (ratingValue) {
        ratingValue.textContent = `(${rating})`;
      }
    }

    function highlightStars(productId, rating) {
      const stars = document.querySelectorAll(`.rating[data-product-id="${productId}"] .star`);
      stars.forEach((star, index) => {
        star.classList.toggle('hovered', index < rating);
      });
    }

    function resetStars(productId) {
      const stars = document.querySelectorAll(`.rating[data-product-id="${productId}"] .star`);
      stars.forEach(star => star.classList.remove('hovered'));
    }

    function toggleFavorite(element, id, event) {
      event.stopPropagation();
      element.classList.toggle('filled');
    }

    let currentProductId = null;

    function viewDetails(id, event) {
      if (event) event.stopPropagation();
      currentProductId = id;
      const product = products[id];
      document.getElementById('productModalLabel').textContent = product.name;
      document.getElementById('modalImage').src = product.image;
      document.getElementById('modalName').textContent = product.name;
      document.getElementById('modalPrice').textContent = `Price: ${product.price}`;
      document.getElementById('modalCategory').textContent = `Category: ${product.category}`;
      document.getElementById('modalDescription').textContent = product.description;
      document.getElementById('modalStock').textContent = `Stock: ${product.stock}`;
      const modalStars = document.querySelectorAll('#modalRating .star');
      modalStars.forEach(star => star.textContent = '★');
      const modalRatingValue = document.getElementById('modalRatingValue');
      const cardRatingValue = document.querySelector(`#rating-value-${id}`);
      modalRatingValue.textContent = cardRatingValue ? cardRatingValue.textContent : '(0)';
      modalStars.forEach((star, index) => {
        star.classList.toggle('filled', document.querySelector(`.rating[data-product-id="${id}"] .star:nth-child(${index + 1})`).classList.contains('filled'));
      });
      const modal = new bootstrap.Modal(document.getElementById('productModal'));
      modal.show();
    }

    function setModalRating(rating, event) {
      event.stopPropagation();
      const stars = document.querySelectorAll('#modalRating .star');
      stars.forEach((star, index) => {
        star.classList.toggle('filled', index < rating);
      });
      document.getElementById('modalRatingValue').textContent = `(${rating})`;
      if (currentProductId) {
        setRating(currentProductId, rating, event);
      }
    }

    function highlightModalStars(rating) {
      const stars = document.querySelectorAll('#modalRating .star');
      stars.forEach((star, index) => {
        star.classList.toggle('hovered', index < rating);
      });
    }

    function resetModalStars() {
      const stars = document.querySelectorAll('#modalRating .star');
      stars.forEach(star => star.classList.remove('hovered'));
    }
  </script>
</body>
```