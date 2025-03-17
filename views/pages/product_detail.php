<div class="container product-container">
    <div class="row">
        <!-- Left Column: Product Image -->
        <div class="col-md-6">
            <img id="mainImage" src="https://exoticsnacks.com/cdn/shop/files/Buldak-Spicy-Tom-Yum-Hot-Chicken-Flavor-Ramen-Pack_-135g-SamYang-71635967_700x700.png?v=1706831190" alt="Product Image" class="product-image">
            <div class="mt-3 d-flex">
                <!-- Thumbnails -->
                <img src="https://img06.weeecdn.com/product/image/619/255/32A00BE918E9A1E2.png" class="thumbnail active" onclick="changeImage(this)">
                <img src="https://media.starrymart.co.uk/media/catalog/product/cache/342235ea97ac9c8ccfddce16761154bf/8/8/8801073115514-a.jpg" class="thumbnail" onclick="changeImage(this)">
                <img src="https://1212928256.rsc.cdn77.org/content/images/thumbs/000/0009492_samyang-carbo-buldak-bag_480.png" class="thumbnail" onclick="changeImage(this)">
            </div>
        </div>

        <!-- Right Column: Product Info -->
        <div class="col-md-6">
            <span class="badge bg-secondary">Premium Collection</span>
            <h2 class="mt-2">Premium Wireless Headphones</h2>
            <p class="text-muted"><i class="fas fa-star"></i> 4.8 | 245 reviews | SKU: WH-1000XM5</p>
            <h4 class="text-danger">$299.99</h4>
            <p>Experience unparalleled sound quality with active noise cancellation, 40-hour battery life, and luxurious memory foam ear cushions.</p>
            
            <!-- Color Selection -->
            <div>
                <strong>Color:</strong> Midnight Black
                <div class="mt-2">
                    <span class="color-option" style="background-color: black;" onclick="selectColor('Midnight Black')"></span>
                    <span class="color-option" style="background-color: lightgray;" onclick="selectColor('Silver')"></span>
                    <span class="color-option" style="background-color: navy;" onclick="selectColor('Blue')"></span>
                </div>
            </div>

            <!-- Quantity Selection -->
            <div class="mt-3">
                <label for="quantity"><strong>Quantity:</strong></label>
                <input type="number" id="quantity" class="form-control w-25" value="1" min="1">
            </div>

            <!-- Add to Cart Button -->
            <button class="btn btn-dark mt-3 w-100"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            
            <p class="mt-3"><i class="fas fa-truck"></i> Free Shipping | <i class="fas fa-shield-alt"></i> 2-Year Warranty</p>
        </div>
    </div>
</div>
<!-- feature -->
<div class="container mt-5">
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#description" onclick="showTab('description')">Description</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#features" onclick="showTab('features')">Features</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#specifications" onclick="showTab('specifications')">Specifications</a>
        </li>
    </ul>

    <div class="tab-content" id="tab-content">
        <div id="description" class="tab-pane fade show active">
            <h1>Product Description</h1>
            <p>
                Experience unparalleled audio quality with our Premium Wireless Headphones. Designed for audiophiles and casual listeners alike, these headphones combine cutting-edge technology with exceptional comfort for an immersive listening experience.
            </p>
        </div>
        <div id="features" class="tab-pane fade">
            <h1>Features</h1>
            <ul class="feature-list">
                <li><span class="feature-icon">></span> Industry-leading noise cancellation</li>
                <li><span class="feature-icon">></span> 40-hour battery life</li>
                <li><span class="feature-icon">></span> Intuitive touch controls</li>
                <li><span class="feature-icon">></span> Premium memory foam ear cushions</li>
            </ul>
        </div>
        <div id="specifications" class="tab-pane fade">
            <h1>Specifications</h1>
            <ul class="spec-list">
                <li><span class="spec-icon">></span> Bluetooth 5.0</li>
                <li><span class="spec-icon">></span> Weight: 250 grams</li>
                <li><span class="spec-icon">></span> Battery: Lithium-ion</li>
                <li><span class="spec-icon">></span> Range: 10 meters</li>
            </ul>
        </div>
    </div>
</div>

<style>
   /* Ensure margin below fixed navbar */
.product-container {
    max-width: 1100px;
    margin: auto;
    padding: 20px;
    margin-top: 90px; /* Adjusted to ensure space from navbar */
}

.product-image {
    width: 100%; /* Ensure the main image is fully responsive */
    height: auto; /* Maintain aspect ratio */
    border-radius: 10px;
    object-fit: contain; /* Ensures image fits within the container */
}

.thumbnail {
    width: 80px; /* Set a fixed width for the thumbnails */
    height: 80px; /* Set a fixed height for the thumbnails */
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
    object-fit: cover; /* Make sure the thumbnail images fill the space without distortion */
    transition: transform 0.2s ease-in-out;
}

.thumbnail.active {
    border: 2px solid #000;
    transform: scale(1.1);
}

.color-option {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    margin-right: 10px;
}

/* Responsive adjustment */
@media (max-width: 768px) {
    .product-container {
        margin-top: 110px; /* More margin for mobile */
    }
}

</style>

<script>
    function changeImage(thumbnail) {
    // Get the main image element
    var mainImage = document.getElementById("mainImage");
    
    // Update the main image source to the source of the clicked thumbnail
    mainImage.src = thumbnail.src;
    
    // Remove the active class from all thumbnails
    document.querySelectorAll('.thumbnail').forEach(img => img.classList.remove('active'));
    
    // Add the active class to the clicked thumbnail
    thumbnail.classList.add('active');
}

// feature
function showTab(tabName) {
            const content = document.getElementById('tab-content');
            let contentText = '';

            if (tabName === 'description') {
                contentText = `<h1>Product Description</h1>
                <p>Experience unparalleled audio quality with our Premium Wireless Headphones. Designed for audiophiles and casual listeners alike, these headphones combine cutting-edge technology with exceptional comfort for an immersive listening experience.</p>`;
            } else if (tabName === 'features') {
                contentText = `<h1>Features</h1>
                <ul>
                    <li>Industry-leading noise cancellation</li>
                    <li>40-hour battery life</li>
                    <li>Intuitive touch controls</li>
                    <li>Premium memory foam ear cushions</li>
                </ul>`;
            } else if (tabName === 'specifications') {
                contentText = `<h1>Specifications</h1>
                <ul>
                    <li>Bluetooth 5.0</li>
                    <li>Weight: 250 grams</li>
                    <li>Battery: Lithium-ion</li>
                    <li>Range: 10 meters</li>
                </ul>`;
            }

            content.innerHTML = contentText;

            // Update active tab
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelector(`.tab[onclick*='${tabName}']`).classList.add('active');
        }
</script>
