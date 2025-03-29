<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
    <h3 class="text-center">Welcome to some page</h3>

<?php
else:
    $this->redirect("/login");
endif;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .nav-link:hover {
            font-weight: bold;
            color: blue !important;
            /* Change color to blue on hover */
        }
        body{
            background-color:rgb(179, 205, 231);

        }

        .nav-link {
            font-weight: normal;
            /* Default weight */
            transition: color 0.3s ease, font-weight 0.3s ease;
            /* Smooth transition */
        }

        .text-white {
            height: 70vh;
        }

        .img_some {
            width: 400px;
            height: 400px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link " href=".//home" style="font-size: 1.2rem;">Shops</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/product" style="font-size: 1.2rem;">Product</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/about" style="font-size: 1.2rem;">About</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/contact" style="font-size: 1.2rem;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="text-white text-center">
        <div class="jumbotron-overlay" style="background-color: rgb(141, 172, 230); height: 100%; display: flex; align-items: center; justify-content: center;">
            <img class="img_some" src="/views/assets/images/product.png" alt="">
        </div>
    </div>

    <!-- Product Cards Section -->
    <h2 class="mb-4 mt-5 text-center" style="color: rgb(181, 21, 230);">Our Category</h2>
    <div class="row px-3 py-4" id="productList">
        <!-- Product Card 1 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="1">
            <div class="card text-start" style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Buldak hot.png" alt="Floral Serum" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff007f; color: white;">
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
                    <p class="card-text">Moisturize your skin with this serum.</p>
                    <div class="price ">Price: $50.99</div>
                </div>
            </div>
        </div>
        <!-- card 2 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="2">
            <div class="card text-start" style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Good Noodle.png" alt="Serum 2" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff990f; color: white;">
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
                    <div class="price ">Price: $40.99</div>
                </div>
            </div>
        </div>
        <!-- card 3 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="3">
            <div class="card text-start" style="border-radius: 12px; overflow: hidden; ">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Serum 3" class="img-fluid">
                </div>
                <div class="card-body " style="background-color: #ff00ff; color: white;">
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
                    <div class="price ">Price: $45.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 4 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="4">
            <div class="card text-star" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Comfort Blue.png" alt="Serum 4" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff990f; color: white;">
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
                    <div class="price ">Price: $60.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 5 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="5">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Serum 5" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff00f9; color: white;">
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
                    <div class="price ">Price: $55.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 6 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="6">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Serum 7" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff007f; color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title">Pao Pink Detergent</h6>
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
                    <div class="price">Price: $42.99</div>
                </div>
            </div>
        </div>
        <!-- Product Card 7 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="7">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Serum 7" class="img-fluid">
                </div>
                <div class="card-body"style="background-color: #ff00ff; color: white;">
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
                </div>
            </div>
        </div>
        <!-- Product Card 8 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="8">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Serum 8" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff007f; color: white;">
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
                </div>
            </div>
        </div>
        <!-- Product Card 9 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="9">
            <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Serum 9" class="img-fluid">
                </div>
                <div class="card-body" style="background-color: #ff990f; color: white;">
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
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<style>
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .icon-large {
            font-size: 2.5rem;
        }

        .stats h3 {
            font-size: 1.8rem;
        }
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
        max-height: 180px;
        object-fit: contain;
    }
    .card-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
    }
    .rating .star.filled {
        color: rgb(255, 217, 0);
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
    @media (max-width: 767px) {

        .filter,
        .filter-categories {
            margin: 0 15px 20px;
        }

        .card {
            margin: 0 auto;
            max-width: 300px;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .profile {
            padding: 40px 20px;
            /* Adjust padding for smaller screens */
        }
    }
</style>

</html>