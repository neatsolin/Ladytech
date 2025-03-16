<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if (isset($_SESSION['user_id'])) : ?>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container my-4">
    <!-- Top Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/add-product" class="btn btn-primary">+ Add New Product</a>
        <a href="import-products.html" class="btn btn-secondary">Import Products</a>
    </div>

    <!-- Search Filter -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search Products name">
        <button class="btn btn-outline-secondary">Filter</button>
    </div>

    <!-- Product Grid -->
     <div class="row g-4">
        <!-- Product Card 1 -->
        <?php foreach($products as $product):?>
        <div class="col-md-4 d-flex">
            <div class="product-card border rounded shadow-sm p-3 w-100">
                <div class="product-image">
                    <img src="<?=$product['imageURL'] ?>" alt="Rosy Lip" class="img-fluid" style="max-height: 150px;">
                </div>

                <div class="mt-3">
                    <div class="product-details">
                        <span class="product-title"><?=$product['productname'] ?></span>
                        <span class="product-category"><?=$product['categories'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <div class="price-rating">
                            <p class="product-price mb-1"><?=$product['price'] ?>$</p>
                            <div class="rating">★☆☆☆☆</div>
                        </div>
                        <div class="buttons">
                            <a href="/products/edit/<?= $product['id']?>"><i class="material-icons">edit</i></a>
                            <a href="/products/delete/<?= $product['id']?>" class="material-icons text-danger delete-user">
                                <i class="material-icons">delete</i>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php endforeach;?>
    </div>   <!-- Repeat other product cards -->
</div>
<?php 
else: 
    $this->redirect("/login"); 
endif;   
?>