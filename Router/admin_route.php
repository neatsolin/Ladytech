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



    $route = new Router();
    //home admin
    $route->get('/', [HomeController::class, 'index']);

    //dashboard
    
    //products management
    $route->get('/products', [ProductController::class, 'products']);

    //stock management
    $route->get('/stock', [StockController::class, 'stock']);

    //sales report
    $route->get('/salesreport', [SalesreportController::class, 'salesreport']);

    //user management
    $route->get('/users', [UserController::class, 'users']);

    //order management
    $route->get('/orders', [OrderController::class, 'orders']);

    //login management
    $route->get('/login', [LoginController::class, 'login']);

    //register management
    $route->get('/register', [RegisterController::class, 'register']);

    //somepage management
    $route->get('/somepage', [SomepageController::class, 'somepage']);
    
    $route->route();
?>