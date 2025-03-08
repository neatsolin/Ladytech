<?php
 class ProductModel{
    private $db;
    
    //constructor to connect to database
    public function __construct(){
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }
    
    //get all products from the database
    public function getProducts(){
        $result = $this->db->query("SELECT * FROM products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //get a product by id
    public function getProductById($id){
        $result = $this->db->query("SELECT * FROM products WHERE id = :id", ['id'=>$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    //store a product in the database
    public function addproduct($productName, $description, $category, $price, $stockQuantity, $imagePath){
        $result = $this->db->query("INSERT INTO products (productname, descriptions, categories, price, stockquantity, imageURL) VALUES (:productname, :descriptions, :categories, :price, :stockquantity, :imageURL)", 
            ['productname'=>$productName, 
            'descriptions'=>$description, 
            'categories'=>$category, 
            'price'=>$price, 
            'stockquantity'=>$stockQuantity, 
            'imageURL'=>$imagePath
        ]);
        return $result;
    }
 }

?>