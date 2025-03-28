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
            color: green !important;
            /* Change color to blue on hover */
        }

        .nav-link {
            font-weight: normal;
            /* Default weight */
            transition: color 0.3s ease, font-weight 0.3s ease;
            /* Smooth transition */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link" href=".//home" style="font-size: 1.2rem;">Shops</a>
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
    <div class="text-white text-center" style="background-image: url('https://static.wixstatic.com/media/5a993c_ca61f30c29594f11ba97b009cf6c426d~mv2.png/v1/crop/x_70,y_3,w_16064,h_10077/fill/w_2622,h_1032,fp_0.50_0.50,q_90,usm_0.66_1.00_0.01,enc_avif,quality_auto/ranger%20scout%20low%20smoke%20coil%20(3).png'); background-size: cover; background-position: center; height: 70vh; margin-bottom: 0;">
        <div class="jumbotron-overlay" style="background-color: rgba(0, 0, 0, 0.5); height: 100%; display: flex; align-items: center; justify-content: center;">
        </div>
    </div>

    <!-- card 9 Category -->
    <h2 class="mb-4 text-center m-30">Our Category</h2>
    <div class="row px-3 py-4" id="productList">
        <!-- Product Card 1 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="1">
            <div class="card text-center shadow-sm d-flex flex-column " style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center">
                    <img src="/views/assets/images/Snacks (7)/Buldak hot.png" >
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class=" mb-2">
                        <h6 class="card-title">Buldak hot</h6>  
                    </div>
                    <div class="price mt-auto">Price: $50.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- card 2 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="2">
            <div class="card text-center shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center ">
                    <img src="/views/assets/images/Snacks (7)/Good Noodle.png">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">Good Noodle</h6>
                    </div>
                    <div class="price mt-auto">Price: $40.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- card 3 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="3">
            <div class="card text-center shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                    <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Serum 3" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">Mama Pork pack</h6>
                    </div>
                    <div class="price mt-auto">Price: $45.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 4 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="4">
            <div class="card text-center d-flex flex-column" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Comfort Blue.png" alt="Serum 4" class="img-fluid">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">Comfort Blue</h6>
                    </div>
                    <div class="price mt-auto">Price: $60.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 5 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="5">
            <div class="card text-center d-flex flex-column" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Serum 5" class="img-fluid">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">Fineline Liquid Detergent</h6>
                    </div>
                    <div class="price mt-auto">Price: $55.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 6 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="6">
            <div class="card text-center d-flex flex-column" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Clothing(7)/Pao Pink Detergent.png" alt="Serum 6" class="img-fluid">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">Pao Pink Detergent</h6>
                    </div>
                    <div class="price mt-auto">Price: $42.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 7 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="7">
            <div class="card text-center" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Serum 7" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">keepo purple</h6>
                    </div>
                    <div class="price">Price: $48.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 8 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="8">
            <div class="card text-center" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Serum 8" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">Keepo Green</h6>
                    </div>
                    <div class="price">Price: $52.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Product Card 9 -->
        <div class="col-md-4 col-sm-6 mb-4" data-product-id="9">
            <div class="card text-center" style="border-radius: 10px; overflow: hidden;">
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                    <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Serum 9" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                </div>
                <div class="card-body d-flex flex-column"style="background-color: #ff007f; color: white;">
                    <div class="mb-2">
                        <h6 class="card-title">ACNES</h6>
                    </div>
                    <div class="price">Price: $49.99</div>
                    <button class="btn btn-light mt-3" style="border-radius: 8px;">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>