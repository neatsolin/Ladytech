<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
    <h1>Welcome to Stock Mangement</h1>

<?php
else:
    $this->redirect("/login");
endif;
?>



<style>
    /* Original Styles */
    body {
        background: linear-gradient(90deg, #f8e1e1 0%, #e1e1f8 100%);
        font-family: 'Arial', sans-serif;
    }

    .category-list {
        background-color: rgb(241, 241, 246);
        border-radius: 15px;
        padding: 20px;
    }

    .category-card {
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        box-sizing: border-box;
        border-radius: 8px;
    }
    
    .category-card img {
        height: 100px;
    }

    .category-card:hover {
        background-color: #d0d0e8;
        transform: translateY(-4px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .category-card.active {
        background-color: #fff;
        transform: translateY(-2px);
    }

    /* NFT Card Styling */
    .nft-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(135deg, rgb(227, 233, 244), rgb(196, 212, 240));
        transition: all 0.3s ease; /* Handles hover and click transitions */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        height: 350px;
        margin: 0 auto;
        position: relative; /* Ensure it stays in its original position */
    }

    .nft-card:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
    }

    /* New class for click animation */
    .nft-card-jump {
        transform: scale(1.1); /* Slightly larger than hover scale */
        transition: transform 0.2s ease; /* Quick animation for the jump */
    }

    .carousel-inner img {
        height: 240px;
        width: auto;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
        transition: opacity 0.5s;
        margin-left: 0;
        margin: 0 auto;
        display: block;
    }

    .carousel-item {
        position: relative;
        transition: transform 0.5s ease;
    }

    .carousel-item .card-title-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(149, 141, 141, 0.3);
        color: #fff;
        padding: 5px 10px;
        border-radius: 8px;
        opacity: 0;
        transition: opacity 0.3s ease, background-color 0.5s ease, transform 0.5s ease;
        pointer-events: none;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .carousel-item.active .card-title-overlay {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.1);
    }

    .card-body {
        padding: 15px;
        color: #000;
        background: white;
        backdrop-filter: none;
        position: relative;
    }

    .row.mb-5 {
        margin-bottom: 3rem !important; /* Fixed typo from "rem" to "3rem" */
    }

    .card-body h5 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: green;
    }

    .card-body p {
        font-size: 0.8rem;
        color: #b0b0b0;
        margin-bottom: 10px;
    }

    .btn-link {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 0;
        color: #000;
        font-size: 1.2rem;
    }

    @media (max-width: 768px) {
        .nft-card {
            margin-bottom: 20px;
            max-width: 100%;
        }
        .carousel-inner img {
            height: 120px;
        }
        .carousel-item .card-title-overlay {
            font-size: 0.8rem;
            padding: 4px 8px;
        }
    }

    /* Rest of the original styles */
    .banner {
        background: url('views/assets/about-images/background.png') no-repeat center/cover;
    }

    .banner-overlay {
        background: rgba(0, 0, 0, 0.5);
    }

    .banner-content {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .header-card {
        background-color: #fff;
        transition: box-shadow 0.3s ease;
    }

    .header-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
</style>
</head>
<body>
    <!-- Header (unchanged) -->
    <div class="container mt-3">
        <div class="card header-card shadow-sm rounded-3">
            <nav class="navbar navbar-expand-lg p-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">ANSWEAR</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="d-flex align-items-center w-100">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                            <input type="text" class="form-control search-bar rounded-pill bg-light border-0 px-3 me-3" placeholder="Search for trendy, stylish, inspiration..." style="max-width: 300px;">
                            <div class="d-flex align-items-center">
                                <a href="#" class="text-dark me-3"><i class="bi bi-heart fs-5"></i></a>
                                <a href="#" class="text-dark position-relative">
                                    <i class="bi bi-cart fs-5"></i>
                                    <span class="badge bg-dark text-white rounded-circle p-1" style="position: absolute; top: -5px; right: -10px; font-size: 0.75rem;">2</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-4" style="margin-bottom: 10rem !important" ;>
        <!-- Banner (unchanged) -->
        <div class="banner position-relative rounded-3 overflow-hidden text-center">
            <div class="position-absolute top-0 start-0 w-100 h-100 banner-overlay rounded-3"></div>
            <div class="position-relative z-1 p-5 h-100 d-flex flex-column justify-content-center align-items-center">
                <div class="banner-content">
                    <h1 class="text-white fw-bold mb-3">Discount up to 50% from Answear Club Original Goods</h1>
                    <p class="text-white mb-4">PROMOCODE: 10030</p>
                    <a href="#" class="btn btn-dark rounded-pill px-4 py-2 text-uppercase">Shop Now</a>
                </div>
            </div>
        </div>

        <div class="row mb-5" style="margin-bottom: 8rem !important;">
            <!-- Sidebar (unchanged) -->
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="category-list" style="padding: 20px; border-radius: 15px;">
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(1)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Drinking Water</span>
                                <i class="bi bi-fire"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark active" onclick="setActiveCategory(2)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                Beverages </span>
                                <i class="bi bi-star"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(3)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Tissue</span>
                                <i class="bi bi-star"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(4)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Snacks</span>
                                <i class="bi bi-star"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(5)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Cooking ingredients</span>
                                <i class="bi bi-star"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(6)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                House Hold Hygiene</span>
                                <i class="bi bi-bag"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(7)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Oral Health</span>
                                <i class="bi bi-cart3"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(8)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Feminine Hygiene</span>
                                <i class="bi bi-cup-straw"></i>
                            </div>
                        </a>
                        <a href="#" class="card category-card mb-2 p-3 text-decoration-none text-dark" onclick="setActiveCategory(9)">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Saop</span>
                                <i class="bi bi-gift"></i>
                            </div>
                        </a>
                    </div>
                    <!-- <a href="#" class="text-muted text-decoration-none d-block mt-2">View More</a> -->
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-md-9" style="padding: 20px;">
                <h4 class="mb-3" id="category-title"></h4>
                <!-- Filter Section (unchanged) -->
                <div class="filter d-flex align-items-center justify-content-between mb-4 p-3 rounded-3 bg-white shadow-sm flex-wrap" style="border-radius: 10px;">
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Sort</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Size</option>
                        <option>XS</option>
                        <option>S</option>
                        <option>M</option>
                    </select>
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Colour</option>
                        <option>White</option>
                        <option>Blue</option>
                        <option>Yellow</option>
                    </select>
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Season</option>
                        <option>Summer</option>
                        <option>Winter</option>
                    </select>
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Purpose</option>
                        <option>Casual</option>
                        <option>Sport</option>
                    </select>
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Style</option>
                        <option>Minimal</option>
                        <option>Streetwear</option>
                    </select>
                    <select class="border-0 bg-transparent text-muted me-2">
                        <option>Material</option>
                        <option>Cotton</option>
                        <option>Polyester</option>
                    </select>
                    <i class="bi bi-sliders text-muted"></i>
                </div>

                <div class="row product-grid" id="product-grid">
                    <!-- Products will be dynamically populated here -->
                </div>
            </div>
        </div>

        <!-- Modal for Add/Edit Card -->
        <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cardModalLabel">Add/Edit Product Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="cardForm">
                            <div class="mb-3">
                                <label for="cardTitle" class="form-label">Card Title</label>
                                <input type="text" class="form-control" id="cardTitle" required>
                            </div>
                            <div class="mb-3">
                                <label for="cardImage1" class="form-label">Image 1 URL</label>
                                <input type="text" class="form-control" id="cardImage1" required>
                            </div>
                            <div class="mb-3">
                                <label for="cardImage2" class="form-label">Image 2 URL</label>
                                <input type="text" class="form-control" id="cardImage2" required>
                            </div>
                            <div class="mb-3">
                                <label for="cardCreator" class="form-label">Creator</label>
                                <input type="text" class="form-control" id="cardCreator" required>
                            </div>
                            <div class="mb-3">
                                <label for="cardPrice" class="form-label">Price (ETH)</label>
                                <input type="number" class="form-control" id="cardPrice" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveCard()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Product data with multiple images
            const productsByCategory = {
                1: [{
                        id: 1,
                        imgs: ["imges/Sofy Cooling fresh.png", "imges/Sofy Cooling fresh.png"],
                        alt: "Best Product 1",
                        title: "Best Item 1",
                        creator: "Creator A",
                        price: "2.5"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Eau Kulen big.png", "views/assets/about-images/Knorr.png"],
                        alt: "Best Product 2",
                        title: "Best Item 2",
                        creator: "Creator A",
                        price: "3.0"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Eau Kulen big.png", "views/assets/about-images/Mouly.png"],
                        alt: "Best Product 3",
                        title: "Best Item 3",
                        creator: "Creator A",
                        price: "2.8"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Eau Kulen big.png", "views/assets/about-images/Ring Floor.png"],
                        alt: "Best Product 4",
                        title: "Best Item 4",
                        creator: "Creator A",
                        price: "2.7"
                    }
                ],
                2: [{
                        id: 1,
                        imgs: ["views/assets/about-images/ACNES.png", "views/assets/about-images/Keepo pink.png"],
                        alt: "New Product 1",
                        title: "New Item 1",
                        creator: "Creator B",
                        price: "1.8"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/ACNES.png", "views/assets/about-images/Mama tom yum.png"],
                        alt: "New Product 2",
                        title: "New Item 2",
                        creator: "Creator B",
                        price: "1.9"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/ACNES.png", "views/assets/about-images/Pao Pink Detergent.png"],
                        alt: "New Product 3",
                        title: "New Item 3",
                        creator: "Creator B",
                        price: "2.0"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/ACNES.png", "views/assets/about-images/Muyly toothbrush.png"],
                        alt: "New Product 4",
                        title: "New Item 4",
                        creator: "Creator B",
                        price: "2.1"
                    }
                ],
                3: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Keepo pink.png", "views/assets/about-images/Eau Kulen big.png"],
                        alt: "Top Product 1",
                        title: "Top Item 1",
                        creator: "Creator C",
                        price: "3.5"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Keepo pink.png", "views/assets/about-images/Knorr.png"],
                        alt: "Top Product 2",
                        title: "Top Item 2",
                        creator: "Creator C",
                        price: "3.6"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Keepo pink.png", "views/assets/about-images/Mouly.png"],
                        alt: "Top Product 3",
                        title: "Top Item 3",
                        creator: "Creator C",
                        price: "3.7"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Keepo pink.png", "views/assets/about-images/Ring Floor.png"],
                        alt: "Top Product 4",
                        title: "Top Item 4",
                        creator: "Creator C",
                        price: "3.8"
                    }
                ],
                4: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Knorr.png", "views/assets/about-images/ACNES.png"],
                        alt: "Pants Product 1",
                        title: "Pants Item 1",
                        creator: "Creator D",
                        price: "2.2"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Knorr.png", "views/assets/about-images/Keepo pink.png"],
                        alt: "Pants Product 2",
                        title: "Pants Item 2",
                        creator: "Creator D",
                        price: "2.3"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Knorr.png", "views/assets/about-images/Mama tom yum.png"],
                        alt: "Pants Product 3",
                        title: "Pants Item 3",
                        creator: "Creator D",
                        price: "2.4"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Knorr.png", "views/assets/about-images/Pao Pink Detergent.png"],
                        alt: "Pants Product 4",
                        title: "Pants Item 4",
                        creator: "Creator D",
                        price: "2.5"
                    }
                ],
                5: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Ring Floor.png", "views/assets/about-images/Eau Kulen big.png"],
                        alt: "Wine Product 1",
                        title: "Wine Item 1",
                        creator: "Creator E",
                        price: "4.0"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Ring Floor.png", "views/assets/about-images/Mouly.png"],
                        alt: "Wine Product 2",
                        title: "Wine Item 2",
                        creator: "Creator E",
                        price: "4.1"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Ring Floor.png", "views/assets/about-images/Muyly toothbrush.png"],
                        alt: "Wine Product 3",
                        title: "Wine Item 3",
                        creator: "Creator E",
                        price: "4.2"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Ring Floor.png", "views/assets/about-images/Knorr.png"],
                        alt: "Wine Product 4",
                        title: "Wine Item 4",
                        creator: "Creator E",
                        price: "4.3"
                    }
                ],
                6: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Mama tom yum.png", "views/assets/about-images/ACNES.png"],
                        alt: "Accessory Product 1",
                        title: "Acc Item 1",
                        creator: "Creator F",
                        price: "1.5"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Mama tom yum.png", "views/assets/about-images/Keepo pink.png"],
                        alt: "Accessory Product 2",
                        title: "Acc Item 2",
                        creator: "Creator F",
                        price: "1.6"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Mama tom yum.png", "views/assets/about-images/Pao Pink Detergent.png"],
                        alt: "Accessory Product 3",
                        title: "Acc Item 3",
                        creator: "Creator F",
                        price: "1.7"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Mama tom yum.png", "views/assets/about-images/Muyly toothbrush.png"],
                        alt: "Accessory Product 4",
                        title: "Acc Item 4",
                        creator: "Creator F",
                        price: "1.8"
                    }
                ],
                7: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Pao Pink Detergent.png", "views/assets/about-images/Eau Kulen big.png"],
                        alt: "Shoe Product 1",
                        title: "Shoe Item 1",
                        creator: "Creator G",
                        price: "3.0"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Pao Pink Detergent.png", "views/assets/about-images/Knorr.png"],
                        alt: "Shoe Product 2",
                        title: "Shoe Item 2",
                        creator: "Creator G",
                        price: "3.1"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Pao Pink Detergent.png", "views/assets/about-images/Mouly.png"],
                        alt: "Shoe Product 3",
                        title: "Shoe Item 3",
                        creator: "Creator G",
                        price: "3.2"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Pao Pink Detergent.png", "views/assets/about-images/Ring Floor.png"],
                        alt: "Shoe Product 4",
                        title: "Shoe Item 4",
                        creator: "Creator G",
                        price: "3.3"
                    }
                ],
                8: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Mouly.png", "views/assets/about-images/ACNES.png"],
                        alt: "Jacket Product 1",
                        title: "Jacket Item 1",
                        creator: "Creator H",
                        price: "4.5"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Mouly.png", "views/assets/about-images/Keepo pink.png"],
                        alt: "Jacket Product 2",
                        title: "Jacket Item 2",
                        creator: "Creator H",
                        price: "4.6"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Mouly.png", "views/assets/about-images/Mama tom yum.png"],
                        alt: "Jacket Product 3",
                        title: "Jacket Item 3",
                        creator: "Creator H",
                        price: "4.7"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Mouly.png", "views/assets/about-images/Pao Pink Detergent.png"],
                        alt: "Jacket Product 4",
                        title: "Jacket Item 4",
                        creator: "Creator H",
                        price: "4.8"
                    }
                ],
                9: [{
                        id: 1,
                        imgs: ["views/assets/about-images/Muyly toothbrush.png", "views/assets/about-images/Eau Kulen big.png"],
                        alt: "Special Offer 1",
                        title: "Offer Item 1",
                        creator: "Creator I",
                        price: "1.0"
                    },
                    {
                        id: 2,
                        imgs: ["views/assets/about-images/Muyly toothbrush.png", "views/assets/about-images/Knorr.png"],
                        alt: "Special Offer 2",
                        title: "Offer Item 2",
                        creator: "Creator I",
                        price: "1.1"
                    },
                    {
                        id: 3,
                        imgs: ["views/assets/about-images/Muyly toothbrush.png", "views/assets/about-images/Mouly.png"],
                        alt: "Special Offer 3",
                        title: "Offer Item 3",
                        creator: "Creator I",
                        price: "1.2"
                    },
                    {
                        id: 4,
                        imgs: ["views/assets/about-images/Muyly toothbrush.png", "views/assets/about-images/Ring Floor.png"],
                        alt: "Special Offer 4",
                        title: "Offer Item 4",
                        creator: "Creator I",
                        price: "1.3"
                    }
                ]
            };

            let editingCardId = null;

            // Function to update the product grid
            function updateProductGrid(categoryId) {
                const productGrid = document.getElementById('product-grid');
                const categoryTitle = document.getElementById('category-title');
                const products = productsByCategory[categoryId] || [];

                const categoryNames = {
                    1: "Bestsellers",
                    2: "New Arrivals",
                    3: "Tops",
                    4: "Pants & Tights",
                    5: "ไวน์ (Wine)",
                    6: "Accessories",
                    7: "Shoes",
                    8: "Jackets",
                    9: "Special Offers"
                };
                categoryTitle.textContent = categoryNames[categoryId];

                productGrid.innerHTML = '';

                // Limit to only the first 3 products
                const limitedProducts = products.slice(0, 3);

                limitedProducts.forEach(product => {
                    const productHtml = `
            <div class="col-md-4 mb-4"> <!-- Using col-md-4 for 3 cards per row -->
                <div class="card nft-card" data-id="${product.id}-${categoryId}">
                    <div id="carousel${product.id}-${categoryId}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="${product.imgs[0]}" class="d-block" alt="${product.alt}">
                                <div class="card-title-overlay">${product.title} - Image 1</div>
                            </div>
                            <div class="carousel-item">
                                <img src="${product.imgs[1]}" class="d-block" alt="${product.alt}">
                                <div class="card-title-overlay">${product.title} - Image 2</div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel${product.id}-${categoryId}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel${product.id}-${categoryId}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body text-center">
                        <button class="btn btn-link p-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="editCard('${product.id}-${categoryId}')">Edit</a></li>
                            <li><a class="dropdown-item" href="#" onclick="deleteCard('${product.id}-${categoryId}')">Delete</a></li>
                            <li><a class="dropdown-item" href="#" onclick="addCard(${categoryId})">Add</a></li>
                        </ul>
                        <h5 class="fw-bold">${product.title}</h5>
                        <p class="text-muted">${product.creator}</p>
                        <span class="badge bg-primary">${product.price} ETH</span>
                    </div>
                </div>
            </div>
        `;
                    productGrid.insertAdjacentHTML('beforeend', productHtml);
                });
            }

            // Open Add/Edit Modal
            function addCard(categoryId) {
                editingCardId = null;
                document.getElementById('cardForm').reset();
                document.getElementById('cardModalLabel').textContent = "Add Product Card";
                new bootstrap.Modal(document.getElementById('cardModal')).show();
                document.getElementById('cardForm').dataset.categoryId = categoryId;
            }

            function editCard(id) {
                editingCardId = id;
                const card = document.querySelector(`[data-id="${id}"]`);
                document.getElementById('cardTitle').value = card.querySelector('h5').textContent;
                document.getElementById('cardImage1').value = card.querySelector('.carousel-item.active img').src;
                document.getElementById('cardImage2').value = card.querySelector('.carousel-item:not(.active) img').src;
                document.getElementById('cardCreator').value = card.querySelector('p').textContent;
                document.getElementById('cardPrice').value = card.querySelector('.badge').textContent.replace(' ETH', '');
                document.getElementById('cardModalLabel').textContent = "Edit Product Card";
                new bootstrap.Modal(document.getElementById('cardModal')).show();
            }

            function saveCard() {
                const title = document.getElementById('cardTitle').value;
                const image1 = document.getElementById('cardImage1').value;
                const image2 = document.getElementById('cardImage2').value;
                const creator = document.getElementById('cardCreator').value;
                const price = document.getElementById('cardPrice').value;
                const categoryId = document.getElementById('cardForm').dataset.categoryId || activeCategory;

                if (editingCardId) {
                    const card = document.querySelector(`[data-id="${editingCardId}"]`);
                    card.querySelector('h5').textContent = title;
                    card.querySelector('.carousel-item.active img').src = image1;
                    card.querySelector('.carousel-item:not(.active) img').src = image2;
                    card.querySelector('.carousel-item.active .card-title-overlay').textContent = `${title} - Image 1`;
                    card.querySelector('.carousel-item:not(.active) .card-title-overlay').textContent = `${title} - Image 2`;
                    card.querySelector('p').textContent = creator;
                    card.querySelector('.badge').textContent = `${price} ETH`;
                } else {
                    const newId = Date.now();
                    const newCard = `
            <div class="col-md-4 mb-4"> <!-- Changed from col-md-3 to col-md-4 -->
                <div class="card nft-card" data-id="${newId}-${categoryId}">
                    <div id="carousel${newId}-${categoryId}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="${image1}" class="d-block" alt="New Product">
                                <div class="card-title-overlay">${title} - Image 1</div>
                            </div>
                            <div class="carousel-item">
                                <img src="${image2}" class="d-block" alt="New Product">
                                <div class="card-title-overlay">${title} - Image 2</div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel${newId}-${categoryId}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel${newId}-${categoryId}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body text-center">
                        <button class="btn btn-link p-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="editCard('${newId}-${categoryId}')">Edit</a></li>
                            <li><a class="dropdown-item" href="#" onclick="deleteCard('${newId}-${categoryId}')">Delete</a></li>
                            <li><a class="dropdown-item" href="#" onclick="addCard(${categoryId})">Add</a></li>
                        </ul>
                        <h5 class="fw-bold">${title}</h5>
                        <p class="text-muted">${creator}</p>
                        <span class="badge bg-primary">${price} ETH</span>
                    </div>
                </div>
            </div>
        `;
                    document.getElementById('product-grid').insertAdjacentHTML('beforeend', newCard);
                    productsByCategory[categoryId].push({
                        id: newId,
                        imgs: [image1, image2],
                        alt: "New Product",
                        title,
                        creator,
                        price
                    });
                }

                bootstrap.Modal.getInstance(document.getElementById('cardModal')).hide();
            }

            // Delete Card
            function deleteCard(id) {
                const card = document.querySelector(`[data-id="${id}"]`);
                const [productId, categoryId] = id.split('-');
                const categoryProducts = productsByCategory[categoryId];
                const index = categoryProducts.findIndex(p => p.id == productId);
                if (index !== -1) categoryProducts.splice(index, 1);
                card.remove();
            }

            // Set Active Category
            let activeCategory = null;

            function setActiveCategory(categoryId) {
                document.querySelectorAll('.category-card').forEach(item => {
                    item.classList.remove('active');
                });

                const selectedCategory = document.querySelector(`.category-card:nth-child(${categoryId})`);
                if (selectedCategory) {
                    selectedCategory.classList.add('active');
                    activeCategory = categoryId;
                }

                updateProductGrid(categoryId);
            }

            // Set "New Arrivals" as active by default
            window.onload = () => {
                setActiveCategory(2);
            };
        </script>