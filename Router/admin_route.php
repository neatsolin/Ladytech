<?php
    require_once "Router.php";
    require_once "Controllers/admin/BaseadminController.php";
    require_once "Database/database.php";
    require_once "Controllers/admin/home/HomeController.php";



    $route = new Router();
    //home admin
    $route->get('/', [HomeController::class, 'index']);
    
    $route->route();
?>