<link rel="stylesheet" href="/views/assets/css/product.css">
<style>
                /* General Styles */
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

        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 50px;
            color: #03c92e;
        }
        .sale {
            display: flex;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: green;
            color: white;
            padding: 3px 7px;
            border-radius: 100%;
            position: absolute;
            left: 70%;
            top: 40%;
            align-items: center;
            font-size: 12px;
        }
        .sales{
            display: flex;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: green;
            color: white;
            padding: 3px 7px;
            border-radius: 100%;
            position: absolute;
            left: 95%;
            top: 40%;
            align-items: center;
            font-size: 12px;
        }
        .sale-discount{
            display: flex;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: green;
            color: white;
            padding: 3px 7px;
            border-radius: 100%;
            position: absolute;
            left: 70%;
            top: 125%;
            align-items: center;
            font-size: 12px;
        }
        .shop {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 20%;
            padding: 20px;
            margin-top: 18px;
        
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
            border-color: #ff7488;
            color:  #f05b72;
            margin-top: 10px;
        }

        .filter button:hover {
            color: white;
            background-color: #ff0978d6;
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
        /* Shop Container Styles */
        .shop-container {
            width: 75%;
        }h1{
            text-align: start;
            margin-bottom: 40px;
        }
        .show {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .products {
            display: flex;
            /* justify-content: space-between; */
            flex-wrap: wrap;
            gap: 95px;
        
        }
        #search{
            margin-top: 8px;
            padding:8px;
        }
        .product {
            width: 300px;
            margin-bottom: 10px;
        }
        .product-img , .productes-img, .products-img{
            background: white;
            height: 50vh;
        }

        h3{
            color: gray;
            margin: 10px 0px;
        }
        .name-product{
            display: flex;
            justify-content: space-between;
        }
        .product-img,
        .productes-img,
        .products-img {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }
        .productes-img img{
            width: 70px;
        }
        .products-img img{
            width: 180px;
        }
        .product-title {
            font-size: 18px;
            margin-top: 2px;
        }
        .old-prices {
            margin-top: 5px;
            margin: 5px;
            text-decoration: line-through;
            color: gray;
        }
        .old-price{
            display: flex;
        }
        .product-price {
            margin: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #038d2c;
            margin-top: 5px;
        }

        .rate {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .rating {
            font-size: 20px;
            color: #f39c12;
        }

        .rate button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
        hr{
            margin-top: 40px;
        }
        /* Center the form */
        #searchForm {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 230px;
            height: 36px;
            border: 2px solid #ccc;
            padding: 5px;
            background: #fff;
            margin-top: 20px;
        }
        /* Style the input field */
        #search {
            flex: 1;
            border: none;
            outline: none;
            padding: 5px;
            margin-left: 5px;
            font-size: 12px;
            margin-bottom: 6px;
        }

        /* Style the search button */
        #searchForm button {
                background-color: #007bff;
                height: 36px;
                color: white;
                border: 2px solid #007bff ;
                padding: 8px;
                cursor: pointer;
                font-size: 12px;
                margin-bottom:10px;
                margin-left: 6px;
            }f


        /* Button hover effect */
        #searchForm button:hover {
            background-color: #0056b3;
        }


</style>
    <div class="shop">

        <div class="sidebar">
            <div class="filter">
                <h3>Filter by price</h3>
                <input type="range" id="priceRange" min="0.25" max="13" step="0.25" value="13">
                <span id="priceValue">$0.25-$13</span>
                <form id="searchForm">
                    <input type="text" id="search" name="q" placeholder="Search here">
                    <button type="submit">Search</button>
                </form>
                
                  
            </div>
            <div class="filter-catagories">
                <h3><li><a href="/product">Filter by Categories</a></li></h3>
                <ul>
                    <li><a href="/oral">Oral Health (10)</a></li>
                    <li><a href="#">Feminine Hygiene (10)</a></li>
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
        <span class="hr"></span>
        <div class="shop-container">
            <h1>Shop</h1>
            <div class="show">
                <p>Show 1-10</p>
                <p>Default Sorting</p>
            </div>
            <div class="products">
                <div class="product">
                    <div class="products-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/sofy night.png" alt="Toothpaste">
                    </div>
                    <h3>Sanitary Pads</h3>
                    <div class="name-product">
                        <p class="product-title">Sofy Night</p>
                        <p class="product-price">$1.00</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product">
                    <span class="sale">Sale!</span>
                    <div class="product-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/sofy Day.png" alt="Sanitary Pads">
                    </div>
                    <h3>Sanitary Pads</h3>
                    <div class="name-product">
                        <p class="product-title">Sofy Day</p>
                        <div class="old-price">
                            <p class="old-prices">$1.00</p>
                            <p class="product-price">$0.75</p>
                        </div>
                    </div>
                    
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                
                <div class="product">
                    <span class="sales">Sale!</span>
                    <div class="product-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/Sofy Cooling fresh.png" alt="Toothpaste">
                    </div>
                    <h3>Sanitary Pads</h3>
                    <div class="name-product">
                        <p class="product-title">Sofy Cooling fresh</p>
                        <div class="old-price">
                            <p class="old-prices">$1.00</p>
                            <p class="product-price">$0.75</p>
                        </div>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/Vaseline aloe.png" alt="Sanitary Pads">
                    </div>
                    <h3>Lip Care</h3>
                    <div class="name-product">
                        <p class="product-title">Aloe Vera Lip</p>
                        <p class="product-price">$2.25</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                
                <div class="product">
                    <span class="sale-discount">Sale!</span>
                    <div class="product-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/Vaseline rosy.png" alt="Toothpaste">
                    </div>
                    <h3>Lip Care</h3>
                    <div class="name-product">
                        <p class="product-title">Rosy Lip</p>
                        <div class="old-price">
                            <p class="old-prices">$3.00</p>
                            <p class="product-price">$2.25</p>
                        </div>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product">
                    <div class="products-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/Vaseline Original.png" alt="Sanitary Pads">
                    </div>
                    <h3>Lip Care</h3>
                    <div class="name-product">
                        <p class="product-title">Original Lip</p>
                        <p class="product-price">$2.25</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/Tessa.png" alt="Sanitary Pads">
                    </div>
                    <h3>Tissue Paper</h3>
                    <div class="name-product">
                        <p class="product-title">Tessa Facial</p>
                        <p class="product-price">$3.00</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                
                <div class="product">
                    <div class="products-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/Avene.png" alt="Toothpaste">
                    </div>
                    <h3>Facial Spray</h3>
                    <div class="name-product">
                        <p class="product-title">Avène</p>
                        <p class="product-price">$13.50</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Sanitary Pads">
                    </div>
                    <h3>Face Cleanser</h3>
                    <div class="name-product">
                        <p class="product-title">Acne</p>
                        <p class="product-price">$1.50</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product">
                    <div class="products-img">
                        <img src="/views/assets/images/Feminine Hygiene (10)/berrie.png" alt="Sanitary Pads">
                    </div>
                    <h3>Cotton Pads</h3>
                    <div class="name-product">
                        <p class="product-title">Berrie Cotton</p>
                        <p class="product-price">$1.25</p>
                    </div>
                    <div class="rate">
                        <p class="rating">★★★★★</p>
                        <button>Add to Cart</button>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <script src="/views/assets/js/product.js"></script>    