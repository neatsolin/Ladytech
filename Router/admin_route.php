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

    //dashboard
    
    //products management
    $route->get('/products', [ProductController::class, 'products']);
    $route->get('/add-product', [ProductController::class, 'addproduct']);
    $route->post('/products/store', [ProductController::class, 'store']);
    $route->get('/products/edit/{id}', [ProductController::class, 'edit']);
    $route->post('/products/update/{id}', [ProductController::class, 'update']);
    $route->delete('/products/delete/{id}', [ProductController::class, 'delete']);


    //stock management
    $route->get('/stock', [StockController::class, 'stock']);

    //sales report
    $route->get('/salesreport', [SalesreportController::class, 'salesreport']);

    //user management

    $route->get('/users', [UserController::class, 'users']);
    $route->get('/users/edit/{id}', [UserController::class, 'editUser']);
    $route->put('/users/update/{id}', [UserController::class, 'updateUser']); 
    $route->delete('/users/delete/{id}', [UserController::class, 'deleteUser']);   



    //order management
    $route->get('/orders', [OrderController::class, 'orders']);

    //login management
    $route->get('/login', [LoginController::class, 'login']);
    $route->post('/login/authenticate', [LoginController::class, 'authenticate']);
    $route->get('/user-form', [UserFormController::class, 'userform']);


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

    //product detail
    $route->get('/product_detail', [DetailController::class, 'index']);

    //about
    $route->get('/about', [AboutController::class, 'index']);

    //contact
    $route->get('/contact', [ContactController::class, 'index']);


    //Login
    $route->get('/F_login', [FrontLoginController::class, 'index']);

    //Register
    $route->get('/F_register', [FrontRegisterController::class, 'index']);

    
    $route->route();
?>