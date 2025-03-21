<div class="container product-container">
    <div class="row">
        <!-- Left Column: Product Image -->
        <div class="col-md-5">
            <img id="mainImage" src="https://exoticsnacks.com/cdn/shop/files/Buldak-Spicy-Tom-Yum-Hot-Chicken-Flavor-Ramen-Pack_-135g-SamYang-71635967_700x700.png?v=1706831190" alt="Product Image" class="product-image">
            <div class="mt-2 d-flex justify-content-center">
                <!-- Thumbnails -->
                <img src="https://img06.weeecdn.com/product/image/619/255/32A00BE918E9A1E2.png" class="thumbnail active" onclick="changeImage(this)">
                <img src="https://media.starrymart.co.uk/media/catalog/product/cache/342235ea97ac9c8ccfddce16761154bf/8/8/8801073115514-a.jpg" class="thumbnail" onclick="changeImage(this)">
                <img src="https://1212928256.rsc.cdn77.org/content/images/thumbs/000/0009492_samyang-carbo-buldak-bag_480.png" class="thumbnail" onclick="changeImage(this)">
            </div>
        </div>

        <!-- Right Column: Product Info -->
        <div class="col-md-7">
            <span class="badge bg-secondary">Premium</span>
            <h4 class="mt-2">Buddak</h4>
            <p class="text-muted small"><i class="fas fa-star"></i> 4.8 | 245 reviews</p>
            <h5 class="text-danger">$299.99</h5>
            <p class="small">Delicious and good quality</p>
            
            <!-- Color Selection -->
            <div>
                <strong>Color:</strong> Black
                <div class="mt-1">
                    <span class="color-option" style="background-color: black;" onclick="selectColor('Black')"></span>
                    <span class="color-option" style="background-color: lightgray;" onclick="selectColor('Silver')"></span>
                    <span class="color-option" style="background-color: navy;" onclick="selectColor('Blue')"></span>
                </div>
            </div>

            <!-- Quantity Selection -->
            <div class="mt-2">
                <label for="quantity"><strong>Qty:</strong></label>
                <input type="number" id="quantity" class="form-control form-control-sm w-50" value="1" min="1">
            </div>

            <!-- Add to Cart Button -->
            <button class="btn btn-dark btn-sm mt-2 w-100"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
        </div>
    </div>
</div>



<style>
/* Compact Layout */
.product-container {
    max-width: 1000px;
    margin: auto;
    padding: 10px;
    margin-top: 5px; /* Adjusted to 5px */
}

.product-image {
    width: 100%;
    border-radius: 10px;
    object-fit: contain;
}

.thumbnail {
    width: 60px;
    height: 60px;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 5px;
    object-fit: cover;
    transition: transform 0.2s ease-in-out;
}

.thumbnail.active {
    border: 2px solid #000;
    transform: scale(1.05);
}

.color-option {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    margin-right: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .product-container {
        padding: 5px;
    }
    .product-image {
        max-height: 250px;
    }
    .thumbnail {
        width: 50px;
        height: 50px;
    }
}
</style>

<script>
function changeImage(thumbnail) {
    document.getElementById("mainImage").src = thumbnail.src;
    document.querySelectorAll('.thumbnail').forEach(img => img.classList.remove('active'));
    thumbnail.classList.add('active');
}
</script>
