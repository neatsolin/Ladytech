<style>
.icon-cart {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.icon-cart svg {
    width: 24px;
    height: 24px;
    color: #333; /* Adjust color if needed */
}

.icon-cart span {
    position: absolute;
    top: -5px;
    right: -8px;
    background-color: red;
    width: 20px;
    height: 20px;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.cartTab {
    position: fixed;
    top: 0;
    right: 0;
    width: 300px;
    height: 100%;
    background-color: #fff;
    box-shadow: -4px 0 6px rgba(0, 0, 0, 0.2);
    padding: 20px;
    z-index: 9999;
    overflow-y: auto;
    transform: translateX(100%);
    transition: transform 0.3s ease-in-out;
}

.cartTab.active {
    transform: translateX(0);
}

.cartTab h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.listCart {
    margin-bottom: 20px;
}

.cartTab .item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.cartTab .item img {
    width: 50px;
    height: 50px;
    object-fit: cover;
}

.cartTab .item .name {
    flex: 1;
    padding: 0 10px;
}

.cartTab .item .totalPrice {
    font-weight: bold;
    color: #333;
}

.cartTab .btn {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.cartTab .btn button {
    width: 48%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
}

.cartTab .btn .close {
    background-color: #ccc;
    color: #fff;
}

.cartTab .btn .checkOut {
    background-color: #007bff;
    color: #fff;
}

.cartTab .btn .checkOut:hover {
    background-color: #0056b3;
}

.cartTab .btn .close:hover {
    background-color: #999;
}

@media screen and (max-width: 768px) {
    .cartTab {
        width: 100%;
    }
}


</style>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="/">
                    <img src="/views/assets/images/logo.png" alt="Logo">
                </a>
                
                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item me-3">
                            <a class="nav-link active lang" data-en="Shops" data-km="ហាង" href="/">Shops</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link lang" data-en="Product" data-km="ប្រភេទ" href="/product">Product</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link lang" data-en="product Detail" data-km="លំអិតផលិតផល" href="/product_detail">Product Detail</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link lang" data-en="Dashboard" data-km="ផ្ទាំងគ្រប់គ្រង" href="/admin">Dashboard</a>
                        </li>
                    </ul>
    
                    <div class="d-flex align-items-center gap-4">
                        <a class="nav-link lang text-nowrap" data-en="About" data-km="អំពី" href="/about">About</a>
                        <a class="nav-link lang text-nowrap" data-en="Contact" data-km="ទំនាក់ទំនង" href="/contact">Contact</a>
                        <a class="nav-link lang text-nowrap" data-en="Login" data-km="ចូល" href="/F_login">Login</a>
                        <!-- <a class="nav-link lang text-nowrap" data-en="Contact" data-km="ចុះឈ្មោះ" href="/F_register">Register</a> -->
                    <!-- Right-side Menu -->
                        
                        <!-- Cart & Profile Icons with Offcanvas Sidebar -->
                        <div class="icon-cart">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                            </svg>
                            <span>0</span>
                        </div>

                        <div class="listProduct"></div>

                        <!-- Cart -->
                        <div class="cartTab" style="display: none;">
                            <h1>Shopping Cart</h1>
                            <div class="listCart"></div>
                            <div class="btn">
                                <button class="close">CLOSE</button>
                                <button class="checkOut">Check Out</button>
                            </div>
                        </div>


                        <i class="bi bi-person-fill ms-2" style="color:#007bff; font-size: 24px;"></i>
                        

    
                        <!-- Language Toggle Button -->
                        <button class="btn btn-outline-primary btn-sm text-nowrap" id="langToggle">ភាសាខ្មែរ</button>
                    </div>
                </div>                        
            </div>
        </nav>
    
        <!-- Offcanvas Shopping Cart -->
       
</div>
    </header>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
            // Select all navbar links
            const navLinks = document.querySelectorAll(".nav-link");

            // Function to remove active class from all links
            function removeActiveClass() {
                navLinks.forEach(link => link.classList.remove("active"));
            }

            // Add click event to each link
            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    removeActiveClass();  // Remove active class from all links
                    this.classList.add("active");  // Add active class to the clicked link
                });
            });

            // Set active class based on current URL (for page reloads)
            const currentPath = window.location.pathname;
            navLinks.forEach(link => {
                if (link.getAttribute("href") === currentPath) {
                    removeActiveClass();
                    link.classList.add("active");
                }
            });
        });

    </script>
    