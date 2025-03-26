<?php
    require_once "Router.php";
    require_once "Controllers/admin/BaseadminController.php";
    require_once "Database/database.php";
    require_once "Controllers/admin/home/HomeController.php";
    require_once "Controllers/admin/inventory/ProductController.php";
    require_once "Controllers/admin/inventory/StockController.php";
    require_once "Controllers/admin/inventory/SalesreportController.php";
    require_once "Controllers/admin/inventory/UserController.php";
    require_once "Controllers/admin/inventory/OrderController.php";
    require_once "Controllers/admin/inventory/LoginController.php";
    require_once "Controllers/admin/inventory/RegisterController.php";
    require_once "Controllers/admin/inventory/SomepageController.php";
    require_once "Controllers/admin/inventory/PaymentController.php";
    require_once "Controllers/admin/inventory/DiscountController.php";

    //customer
    require_once "Controllers/admin/basecustomerController.php";
    require_once "Controllers/admin/page/HomeController.php";
    require_once "Controllers/admin/page/ProductController.php";
    require_once "Controllers/admin/page/DetailproductController.php";
    require_once "Controllers/admin/page/AboutController.php";
    require_once "Controllers/admin/page/ContactControler.php";
    require_once "Controllers/admin/page/LoginController.php";
    require_once "Controllers/admin/page/RegisterController.php";



    $route = new Router();
    //home admin
    $route->get('/admin', [HomeController::class, 'index']);
    $route->get('/somepage', [HomeController::class, 'somepage']);

    //dashboard
    
    //products management
    $route->get('/products', [ProductController::class, 'products']);
    $route->get('/add-product', [ProductController::class, 'addproduct']);
    $route->post('/products/store', [ProductController::class, 'store']);
    $route->get('/products/edit/{id}', [ProductController::class, 'edit']);
    $route->post('/products/update/{id}', [ProductController::class, 'update']);
    $route->delete('/products/delete/{id}', [ProductController::class, 'delete']);
    $route->get("/add-stock", [ProductController::class, 'addstock']);
    $route->get('/products/discount', [ProductController::class, 'discount']);
    $route->get('/products/pro-discount', [ProductController::class, 'pro_discount']);
    $route->get('/products/view/{id}', [ProductController::class, 'show']);




    //stock management
    $route->get('/stock', [StockController::class, 'stock']);
    $route->get('/stock/in', [StockController::class, 'stockIn']);
    $route->get('/stock/out', [StockController::class, 'stockOut']);

    //sales report
    $route->get('/salesreport', [SalesreportController::class, 'salesreport']);

    //user management

    $route->get('/users', [UserController::class, 'users']);
    $route->get('/users/edit/{id}', [UserController::class, 'editUser']);
    $route->put('/users/update/{id}', [UserController::class, 'updateUser']); 
    $route->delete('/users/delete/{id}', [UserController::class, 'deleteUser']);
    $route->get('/users/trash', [UserController::class, 'trashUser']);   
    $route->get('/users/active', [UserController::class, 'active']);
    $route->get('/users/restore/{id}', [UserController::class, 'restoreUser']);  
    $route->delete('/users/permanent-delete/{id}', [UserController::class, 'permanentlyDeleteUser']); 



    //order management
    $route->get('/orders', [OrderController::class, 'orders']);
    $route->get('/All_order', [OrderController::class, 'order_all']);
    $route->get('/recent_order', [OrderController::class, 'recent_order']);
    $route->get('/order_history', [OrderController::class, 'order_history']);
    $route->get('/order_pending', [OrderController::class, 'order_pending']);
    $route->get('/old_order', [OrderController::class, 'old_order']);

    //login management
    // Unified login management (for both users and admins)
    $route->get('/admin-login', [LoginController::class, 'login_admin']);
    $route->post('/authenticate', [LoginController::class, 'authenticate']);
    $route->get('/logout', [LoginController::class, 'logout']);



    //register management
    $route->get('/register', [RegisterController::class, 'register']);
    $route->post('/register/store', [RegisterController::class, 'store']);


    //somepage management
    $route->get('/somepage', [SomepageController::class, 'somepage']);



    //customer
    //home
    $route->get('/', [CustomerController::class, 'index']);

    //product
    $route->get('/product', [products::class, 'index']);
    $route->get('/oral', [products::class, 'oral']);
    $route->get('/beverage', [products::class, 'beverage']);
    $route->get('/cooking', [products::class, 'cooking']);
    $route->get('/drinking', [products::class, 'drinking']);
    $route->get('/feminine', [products::class, 'feminine']);
    $route->get('/houeshold', [products::class, 'houeshold']);
    $route->get('/saop', [products::class, 'saop']);
    $route->get('/snacks', [products::class, 'snacks']);
    $route->get('/tissue', [products::class, 'tissue']);
    

    //product detail
    $route->get('/product_detail', [DetailController::class, 'index']);

    //about
    $route->get('/about', [AboutController::class, 'index']);

    //contact
    $route->get('/contact', [ContactController::class, 'index']);


    //Login
    $route->get('/F_login', [LoginController::class, 'login']);

    //Register
    $route->get('/F_register', [FrontRegisterController::class, 'index']);

    // today
    // Checkout
    $route->get('/checkout', [PaymentController::class, 'checkout']);
    $route->post('/checkout/process', [PaymentController::class, 'processCheckout']);
    $route->get('/checkout/payment', [PaymentController::class, 'payment']);

    // Payment Confirmation
    $route->get('/payment-confirmation', [PaymentController::class, 'paymentConfirmation']);
    $route->post('/confirm-payment', [PaymentController::class, 'confirmPayment']);

    // Order Success
    $route->get('/order-success', [PaymentController::class, 'orderSuccess']);
   

    $route->route();
?>