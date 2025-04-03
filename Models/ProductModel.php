<?php
class ProductModel {
    private $db;
    
    // Constructor to connect to database
    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }
    
    // Get all products from the database
    public function getProducts() {
        $result = $this->db->query("SELECT * FROM products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Get a product by id
    public function getProductById($id) {
        $result = $this->db->query("SELECT * FROM products WHERE id = :id", ['id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Store a product in the database
    public function addProduct($productName, $description, $category, $price, $stockQuantity, $imagePath) {
        $result = $this->db->query(
            "INSERT INTO products (productname, descriptions, categories, price, stockquantity, imageURL) 
            VALUES (:productname, :descriptions, :categories, :price, :stockquantity, :imageURL)", 
            [
                'productname' => $productName, 
                'descriptions' => $description, 
                'categories' => $category, 
                'price' => $price, 
                'stockquantity' => $stockQuantity, 
                'imageURL' => $imagePath
            ]
        );
        
        // NEW: Add stock entry to inventory after product is added
        $productId = $this->db->lastInsertId();
        if ($stockQuantity > 0) {
            $this->addStock($productId, $stockQuantity, 0, date('Y-m-d H:i:s'));
            error_log("Added stockIn for product_id=$productId with quantity=$stockQuantity");
        }
        
        return $result;
    }

    // Add stock entry to inventory (unchanged)
    public function addStock($productId, $stockIn, $stockOut, $updateDate) {
        $result = $this->db->query(
            "INSERT INTO inventory (product_id, stockIn, stockOut, updatedate) 
            VALUES (:product_id, :stockIn, :stockOut, :updatedate)", 
            [
                'product_id' => $productId, 
                'stockIn' => $stockIn, 
                'stockOut' => $stockOut, 
                'updatedate' => $updateDate
            ]
        );
        return $result;
    }

    // Delete stock entry to inventory (unchanged)
    public function deleteStock($productId, $stockIn, $stockOut, $updateDate) {
        $result = $this->db->query(
            "INSERT INTO inventory (product_id, stockIn, stockOut, updatedate) 
            VALUES (:product_id, :stockIn, :stockOut, :updatedate)", 
            [
                'product_id' => $productId, 
                'stockIn' => $stockIn, 
                'stockOut' => $stockOut, 
                'updatedate' => $updateDate
            ]
        );
        return $result;
    }

    // Update a product in the database
    public function updateProduct($productName, $description, $category, $price, $stockQuantity, $imagePath, $id) {
        $result = $this->db->query(
            "UPDATE products SET productname = :productname, descriptions = :descriptions, categories = :categories, price = :price, stockquantity = :stockquantity, imageURL = :imageURL WHERE id = :id", 
            [
                'productname' => $productName, 
                'descriptions' => $description, 
                'categories' => $category, 
                'price' => $price, 
                'stockquantity' => $stockQuantity, 
                'imageURL' => $imagePath,
                'id' => $id
            ]
        );

        // NEW: Update stockIn in inventory if stockQuantity changes
        $existingProduct = $this->getProductById($id);
        $oldStockQuantity = $existingProduct['stockquantity'];
        if ($stockQuantity > $oldStockQuantity) {
            $additionalStock = $stockQuantity - $oldStockQuantity;
            $this->addStock($id, $additionalStock, 0, date('Y-m-d H:i:s'));
            error_log("Updated stockIn for product_id=$id with additional quantity=$additionalStock");
        }

        return $result;
    }

    // Delete a product from the database (unchanged)
    public function deleteProduct($id) {
        $result = $this->db->query("DELETE FROM products WHERE id = :id", ['id' => $id]);
        return $result;
    }
}
?>