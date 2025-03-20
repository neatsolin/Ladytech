<style>
        body {
            background-color: #f5e6f5;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        .shop {
            max-width: 1200px;
            margin: 0 auto;
        }
        .filter, .filter-categories {
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        .filter h3, .filter-categories h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        #priceRange {
            width: 100%;
        }
        #priceValue {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        #searchForm .form-control {
            border-radius: 20px;
            border: 1px solid #ddd;
        }
        #searchForm .btn-primary {
            background-color: #6f42c1;
            border: none;
            border-radius: 20px;
            padding: 10px;
        }
        #searchForm .btn-primary:hover {
            background-color: #5a2b96;
        }
        .filter-categories .list-group-item {
            border: none;
            padding: 10px 0;
            font-size: 14px;
        }
        .filter-categories .list-group-item a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
        }
        .filter-categories .list-group-item a:hover {
            color: #6f42c1;
        }
        .filter-categories .list-group-item i {
            margin-right: 10px;
            color: #6f42c1;
            font-size: 16px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            max-height: 160px;
            object-fit: contain;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }
        .rating {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .rating .star {
            font-size: 14px;
            cursor: pointer;
            color: #dddd;
            transition: color 0.2s ease;
        }
        .rating .star.filled {
            color:rgb(255, 217, 0);
        }
        .rating .rating-value {
            font-size: 12px;
            color: #666;
            margin-left: 5px;
        }
        .price {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .btn-purple, .btn-green {
            border-radius: 15px;
            font-size: 12px;
            padding: 8px;
            width: 48%;
            transition: background-color 0.3s ease;
        }
        .btn-purple {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
        .btn-purple:hover {
            background-color: #5a2b96;
            border-color: #5a2b96;
        }
        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .bi-heart, .bi-heart-fill {
            font-size: 16px;
            cursor: pointer;
        }
        .bi-heart-fill {
            color: #6f42c1;
        }
        .view-details-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover .view-details-btn {
        opacity: 1;
    }
        
        @media (max-width: 767px) {
            .filter, .filter-categories {
                margin: 0 15px 20px;
            }
            .card {
                margin: 0 auto;
                max-width: 300px;
            }
        }
        .title {
            color: #ffffff;
            font-family: sans-serif;
            text-align: center;
            background-color:rgb(209, 179, 10);
            padding: 10px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
            width: 98%;
        }
</style>
    <div class="shop container-fluid">
        <div class="row">
            <!-- Sidebar for Filters -->
            <div class="col-md-3">
                <!-- Filter by Price -->
                <div class="filter">
                    <h3>Filter by Price</h3>
                    <input type="range" id="priceRange" min="1" max="100" step="1" value="100" class="form-range">
                    <span id="priceValue">$1 - $100</span>
                    <form id="searchForm">
                        <input type="text" id="search" name="q" placeholder="Search by product name" class="form-control mt-3">
                        <button type="submit" class="btn btn-primary mt-2 w-100">Search</button>
                    </form>
                </div>
                <div class="filter-categories mt-4">
                <h3>Filter by Categories</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/oral" class="d-flex align-items-center">
                            <i class="fas fa-tooth me-3" style="color:rgb(12, 230, 242);"></i> <!-- Change color here -->
                            <span>Oral Health (10)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/feminine" class="d-flex align-items-center">
                            <i class="fas fa-female me-3" style="color:rgb(155, 24, 215);"></i> <!-- Change color here -->
                            <span>Feminine Hygiene (10)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/houeshold" class="d-flex align-items-center">
                            <i class="fas fa-home me-3" style="color:rgb(41, 8, 161);"></i> <!-- Change color here -->
                            <span>Household Hygiene (11)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/tissue" class="d-flex align-items-center">
                            <i class="fas fa-toilet-paper me-3" style="color:rgb(16, 198, 168);"></i> <!-- Change color here -->
                            <span>Tissue Roll (11)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/drinking" class="d-flex align-items-center">
                            <i class="fas fa-tint me-3" style="color:rgb(109, 200, 239);"></i> <!-- Change color here -->
                            <span>Drinking Water (5)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/beverage" class="d-flex align-items-center">
                            <i class="fas fa-coffee me-3" style="color:rgb(209, 179, 10);"></i> <!-- Change color here -->
                            <span>Beverages (8)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/saop" class="d-flex align-items-center">
                            <i class="fas fa-soap me-3" style="color:rgb(210, 17, 129);"></i> <!-- Change color here -->
                            <span>Soap (7)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/cooking" class="d-flex align-items-center">
                            <i class="fas fa-utensils me-3" style="color:rgb(12, 211, 188);"></i> <!-- Change color here -->
                            <span>Cooking Ingredients (20)</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/snacks" class="d-flex align-items-center">
                            <i class="fas fa-cookie me-3" style="color:rgb(121, 201, 22);"></i> <!-- Change color here -->
                            <span>Snacks (5)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
            <!-- Product Cards Section -->
            <div class="col-md-9">
                <div class="row px-3 py-4" id="productList">
                <h2 class="title">Beverages</h2>
                    <!-- Product Card 1 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="1">
                        <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                                <img src="/views/assets/images/Beverages (6)/Bear Brand.png" alt="Floral Serum" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                <button class="view-details-btn" onclick="viewDetails(1)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Bear Brand</h6>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(1)"><i class="bi bi-cart"></i> Add to Cart</button> 
                                    <button class="btn btn-green text-white" style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="2">
                        <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                                <img src="/views/assets/images/Beverages (6)/coca cola.png" alt="Serum 2" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                <button class="view-details-btn" onclick="viewDetails(2)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">coca cola</h6>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(2)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card 3 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="3">
                        <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                                <img src="/views/assets/images/Beverages (6)/Lactasoy Chocolate.png" alt="Serum 3" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                <button class="view-details-btn" onclick="viewDetails(3)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Lactasoy Chocolate</h6>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(3)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 4 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="4">
                        <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Beverages (6)/Lactasoy Original.png" alt="Serum 4" class="img-fluid">
                                <button class="view-details-btn" onclick="viewDetails(4)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Lactasoy Original</h6>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(4)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 5 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="5">
                        <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Beverages (6)/Oishi Honey Lemon.png.png" alt="Serum 5" class="img-fluid">
                                <button class="view-details-btn" onclick="viewDetails(5)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Oishi Honey Lemon</h6>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(5)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 6 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="6">
                        <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Beverages (6)/Pocari Sweat.png" alt="Serum 6" class="img-fluid">
                                <button class="view-details-btn" onclick="viewDetails(6)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Pocari Sweat</h6>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(6)"><i class="bi bi-cart"></i> Add to Cart</button>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(7)"><i class="bi bi-cart"></i> Add to Cart</button>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(8)"><i class="bi bi-cart"></i> Add to Cart</button>
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
                                    <button class="btn btn-purple text-white" onclick="addToCart(9)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
