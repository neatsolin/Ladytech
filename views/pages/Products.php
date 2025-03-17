<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #F7F6F2;
        height: auto;
        width: 100%;
    }
    .btn-green {
        background-color: #28a745; /* Custom green */
        color: white;
        font-weight: bold;
    }

    .btn-green:hover {
        background-color: #218838;
    }
    h1 {
        font-weight: bold;
        color: #03c92e;
    }
    .sidebar {
        width: 20%;
        padding: 20px;
    
    }
    h3{
        list-style: none;
    }
    .filter{
        width: 100%;
        height: 25vh;
        background: white;
        padding: 10px;
    }
    .filter h3, .filter-catagories h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .filter input[type="range"] {
        width: 100%;
    }

    .filter button {
        display: block;
        width: 50%;
        padding: 10px;
        background-color: white;
        margin-top: 10px;
    }

    .filter button:hover {
        color: white;
    }

    .filter-catagories ul {
        list-style: none;
        margin-top: 30px;
    }

    .filter-catagories li {
        margin: 15px 0;
    }

    .filter-catagories a {
        text-decoration: none;
        color: #333;
    }

    .filter-catagories a:hover {
        color: #049d22;
    }
    .filter-catagories{
        width: 100%;
        height: 65vh;
        background: white;
        padding: 10px;
        margin-top: 30px;  
    }
    .filter-catagories h3{
        color: gray;
        margin-left: 35px;
    }
    #searchForm{
        display: flex;

    }
    #search {
        width: 170px;
        height: 40px;
    }
    #sumit{
        width: 100px;
        height: 40px;
       position: relative;
       bottom: 10px;
       text-align: center;
       border:none;
       background: blue;
       color: #ffff;
    }
    .Product{
        margin-bottom: 200px;

    }
    .card-body{
        margin-top: 10px;
    }

</style>
    <div class="product-container my-4">
        <div class="row  g-3">
            <!-- Sidebar Filters -->
            <div class="sidebar col-md-3 ">
                <div class=" filter ">
                    <h5>Filter by price</h5>
                    <input type="range" id="priceRange" min="0.25" max="13" step="0.25" value="13">
                    <span id="priceValue">$0.25-$13</span>
                    <form id="searchForm">
                        <input type="text" id="search" name="q" placeholder="Search here">
                        <button type="submit" id ="sumit">Search</button>
                    </form>

                </div>
                <div class="filter-catagories">
                    <h3><li><a href="/product">Filter by Categories</a></li></h3>
                    <ul>
                        <li><a href="#">Oral Health (10)</a></li>
                        <li><a href="/feminine">Feminine Hygiene (10)</a></li>
                        <li><a href="/houeshold">Household Hygiene (11)</a></li>
                        <li><a href="/tissue">Tissue Roll (11)</a></li>
                        <li><a href="/drinking">Drinking Water (5)</a></li>
                        <li><a href="/beverage">Beverages (8)</a></li>
                        <li><a href="/saop">Saop (7)</a></li>
                        <li><a href="/cooking">Cooking Ingredients (20)</a></li>
                        <li><a href="/snacks">Snacks (5)</a>
                    </ul>
                </div>
            </div>
            

            <!-- Product Grid -->
            <div class="col-md-9 my-3">
                <h1 class="">Shop</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0">Showing 1-10</p>
                    <select class="form-select w-auto">
                        <option>Default Sorting</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>

                <div class="row g-3">
                    <!-- Product Card -->
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Oral Health (10)/Colgate cool.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="max-width: 100%; height: 330px; object-fit: cover;">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Toothpaste</h5>
                            <div class="d-flex justify-content-between align-items-center ">
                                <p class=" text-muted mb-0">Colgate</p>
                                <p class="text-success fw-bold mb-0">$1.50</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Feminine Hygiene (10)/sofy night.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width: 70%; height: 260px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Sanitary Pads</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Sofy Night</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/House Hold Hygiene (11)/Ranger Smoke.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width: 200px; height: 270px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Mosquito Coil</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Ranger Smoke</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Tissue (6)/Keepo pink.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width:190px; height: 180px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Tissue Paper</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Keepo Pink</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Drinking Water (2)/Eau Kulen big.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width: 78px; height: 268px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Drinking Water</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Eau Kulen</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Beverages (6)/Bear Brand.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width:200px; height: 170px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Milk Drink</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Bear Brand</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width: 200px; height: 240px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Liquid Laundry Detergen</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Fineline</p>
                                <p class="text-success fw-bold mb-0">$7.10</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Cooking ingredients (20)/Oyster Sauce.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="max-width: 100%; height: 300px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Sauce</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Oyster Sauce</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                           
                    <div class="Product col-md-4">
                        <div class="card h-100 p-4 text-center justify-content-center shadow-sm">
                            <a href="/oral">
                            <img src="/views/assets/images/Snacks (7)/Buldak hot.png" class="img-fluid mx-auto d-block" alt="Toothpaste" style="width: 190px; height: 200px; object-fit: cover;">

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">Instant Ramen</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class=" text-muted mb-0">Buldak Hot</p>
                                <p class="text-success fw-bold mb-0">$0.75</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="text-warning mb-0">★★★★★</p>
                                <button class="btn btn-green btn-sm">Add to Cart</button>

                            </div>
                        </div>
                    </div>                                                    
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
<script src="/views/assets/js/product.js"></script>