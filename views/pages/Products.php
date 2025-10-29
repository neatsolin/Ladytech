<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /F_login");
    exit();
}

$host = 'localhost';
$dbname = 'ladytech_db';
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$applied_coupon = null;
if (isset($_SESSION['applied_coupon']) && !empty($_SESSION['applied_coupon']['code'])) {
    $stmt = $pdo->prepare(
        "SELECT discount_type, discount_value, expiry_date 
         FROM promo_codes 
         WHERE code = :code"
    );
    $stmt->execute(['code' => $_SESSION['applied_coupon']['code']]);
    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($coupon && (!$coupon['expiry_date'] || strtotime($coupon['expiry_date']) >= time())) {
        $applied_coupon = $coupon;
    } else {
        unset($_SESSION['applied_coupon']);
    }
}

function getDiscountedPrice($price, $coupon) {
    if (!$coupon) return $price;
    if ($coupon['discount_type'] === 'percentage') {
        return $price * (1 - $coupon['discount_value'] / 100);
    } else {
        return max(0, $price - $coupon['discount_value']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop Products</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: #f5f5f5;
        min-height: 100vh;
        font-family: Arial, sans-serif;
        margin-top: 50px;
    }

    /* Remove side space */
    .shop.container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .shop .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    .shop .col-md-3 {
        padding-left: 0 !important;
        margin-left: 0 !important;
    }

    /* Sticky sidebar (optional) */
    .filter, .filter-categories {
        position: sticky;
        top: 80px;
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
        font-size: 16px;
    }

    /* Product card */
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

    .price-discounted {
        color: #28a745;
        font-weight: bold;
    }

    .price-original {
        text-decoration: line-through;
        color: #6c757d;
        margin-right: 5px;
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
            position: relative;
            top: 0;
            margin: 0 15px 20px;
        }
        .card {
            margin: 0 auto;
            max-width: 300px;
        }
    }
</style>
</head>
<body>

<div class="shop container-fluid px-0">
    <div class="row">
        <!-- FILTER SIDEBAR -->
        <div class="col-md-3">
            <!-- <div class="filter">
                <h3>Filter by Price</h3>
                <input type="range" id="priceRange" min="1" max="100" step="1" value="100" class="form-range">
                <span id="priceValue">$1 - $100</span>
                <form id="searchForm">
                    <input type="text" id="search" name="q" placeholder="Search by product name" class="form-control mt-3">
                    <button type="submit" class="btn btn-primary mt-2 w-100">Search</button>
                </form>
            </div> -->

            <!-- <div class="filter-categories mt-4">
                <h3>Filter by Categories</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="/oral"><i class="fas fa-tooth me-3" style="color:rgb(12,230,242);"></i>Oral Health</a></li>
                    <li class="list-group-item"><a href="/feminine"><i class="fas fa-female me-3" style="color:rgb(155,24,215);"></i>Feminine Hygiene</a></li>
                    <li class="list-group-item"><a href="/houeshold"><i class="fas fa-home me-3" style="color:rgb(41,8,161);"></i>Household Hygiene</a></li>
                    <li class="list-group-item"><a href="/tissue"><i class="fas fa-toilet-paper me-3" style="color:rgb(16,198,168);"></i>Tissue Roll</a></li>
                    <li class="list-group-item"><a href="/drinking"><i class="fas fa-tint me-3" style="color:rgb(109,200,239);"></i>Drinking Water</a></li>
                    <li class="list-group-item"><a href="/beverage"><i class="fas fa-coffee me-3" style="color:rgb(209,179,10);"></i>Beverages</a></li>
                    <li class="list-group-item"><a href="/saop"><i class="fas fa-soap me-3" style="color:rgb(210,17,129);"></i>Soap</a></li>
                    <li class="list-group-item"><a href="/cooking"><i class="fas fa-utensils me-3" style="color:rgb(12,211,188);"></i>Cooking Ingredients</a></li>
                    <li class="list-group-item"><a href="/snacks"><i class="fas fa-cookie me-3" style="color:rgb(121,201,22);"></i>Snacks</a></li>
                </ul>
            </div> -->
        </div>

        <!-- PRODUCTS -->
        <div class="col-md-9">
            <div class="row px-3 py-4" id="productList">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): 
                        $original_price = floatval($product['price']);
                        $discounted_price = getDiscountedPrice($original_price, $applied_coupon);
                    ?>
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="<?= htmlspecialchars($product['id']) ?>">
                        <div class="card text-start shadow-sm d-flex flex-column">
                            <div class="bg-light d-flex justify-content-center align-items-center position-relative" style="height: 180px;">
                                <img src="<?= htmlspecialchars($product['imageURL']) ?>" alt="<?= htmlspecialchars($product['productname']) ?>" class="img-fluid" onerror="this.src='/public/images/products/placeholder.jpg';">
                                <button class="view-details-btn" onclick="viewDetails(<?= htmlspecialchars($product['id']) ?>)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title"><?= htmlspecialchars($product['productname']) ?></h6>
                                    <i class="bi bi-heart" data-heart-id="<?= htmlspecialchars($product['id']) ?>" onclick="toggleFavorite(<?= htmlspecialchars($product['id']) ?>)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="star" data-star="<?= $i ?>" onclick="setRating(<?= htmlspecialchars($product['id']) ?>, <?= $i ?>)">★</span>
                                    <?php endfor; ?>
                                    <span class="rating-value" data-rating-id="<?= htmlspecialchars($product['id']) ?>">(0)</span>
                                </div>
                                <p class="card-text"><?= htmlspecialchars($product['descriptions']) ?></p>
                                <div class="price mt-auto">
                                    <?php
                                    if ($applied_coupon && $discounted_price < $original_price) {
                                        echo '<span class="price-original">$' . number_format($original_price, 2) . '</span>';
                                        echo '<span class="price-discounted">$' . number_format($discounted_price, 2) . '</span>';
                                    } else {
                                        echo '$' . number_format($original_price, 2);
                                    }
                                    ?>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(<?= htmlspecialchars($product['id']) ?>)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center text-muted">No products available.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFavorite(productId) {
    const heart = document.querySelector(`[data-heart-id="${productId}"]`);
    heart.classList.toggle('bi-heart');
    heart.classList.toggle('bi-heart-fill');
}

function setRating(productId, rating) {
    const stars = document.querySelectorAll(`[data-product-id="${productId}"] .star`);
    const ratingValue = document.querySelector(`[data-rating-id="${productId}"]`);
    stars.forEach((star, index) => {
        star.classList.toggle('filled', index < rating);
    });
    ratingValue.textContent = `(${rating})`;
}

function addToCart(productId) {
    alert(`Added product ${productId} to cart!`);
}

function viewDetails(productId) {
    alert(`Viewing details for product ${productId}`);
}

document.getElementById('priceRange').addEventListener('input', function() {
    const priceValue = this.value;
    document.getElementById('priceValue').textContent = `$1 - $${priceValue}`;
    const cards = document.querySelectorAll('[data-product-id]');
    cards.forEach(card => {
        const priceText = card.querySelector('.price').textContent;
        const match = priceText.match(/\$([\d.]+)/g);
        const price = parseFloat(match[match.length - 1].replace('$', ''));
        card.style.display = price <= priceValue ? '' : 'none';
    });
});

document.getElementById('search').addEventListener('input', function() {
    const value = this.value.toLowerCase().trim();
    const cards = document.querySelectorAll('[data-product-id]');
    cards.forEach(card => {
        const name = card.querySelector('.card-title').textContent.toLowerCase();
        card.style.display = name.includes(value) ? '' : 'none';
    });
});
</script>

</body>
</html>
