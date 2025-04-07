<?php
class ProductModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }
    
    public function getProducts() {
        $result = $this->db->query("SELECT * FROM products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProductById($id) {
        $result = $this->db->query("SELECT * FROM products WHERE id = :id", ['id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

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
        
        $productId = $this->db->lastInsertId();
        if ($stockQuantity > 0) {
            $this->addStock($productId, $stockQuantity, 0, date('Y-m-d H:i:s'));
            error_log("Added stockIn for product_id=$productId with quantity=$stockQuantity");
        }
        
        return $result;
    }

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

        $existingProduct = $this->getProductById($id);
        $oldStockQuantity = $existingProduct['stockquantity'];
        if ($stockQuantity > $oldStockQuantity) {
            $additionalStock = $stockQuantity - $oldStockQuantity;
            $this->addStock($id, $additionalStock, 0, date('Y-m-d H:i:s'));
            error_log("Updated stockIn for product_id=$id with additional quantity=$additionalStock");
        }

        return $result;
    }

    public function deleteProduct($id) {
        $result = $this->db->query("DELETE FROM products WHERE id = :id", ['id' => $id]);
        return $result;
    }

    public function checkDiscountCodeExists($code) {
        $result = $this->db->query("SELECT COUNT(*) FROM promo_codes WHERE code = :code", ['code' => $code]);
        return $result->fetchColumn() > 0;
    }

    public function addDiscountCode($code, $discount_type, $discount_value, $max_usage, $expiry_date) {
        if ($this->checkDiscountCodeExists($code)) {
            return false;
        }
        
        $this->db->query(
            "INSERT INTO promo_codes (code, discount_type, discount_value, max_usage, expiry_date) 
             VALUES (:code, :discount_type, :discount_value, :max_usage, :expiry_date)",
            [
                'code' => $code,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'max_usage' => $max_usage,
                'expiry_date' => $expiry_date
            ]
        );
        return true;
    }

    public function validateCoupon($code, $user_id) {
        $result = $this->db->query(
            "SELECT id, discount_type, discount_value 
             FROM promo_codes 
             WHERE code = :code 
             AND is_active = 1
             AND (max_usage IS NULL OR usage_count < max_usage)
             AND (expiry_date IS NULL OR expiry_date > NOW())",
            ['code' => $code]
        );
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function incrementCouponUsage($promo_code_id, $user_id) {
        $this->db->query(
            "UPDATE promo_codes SET usage_count = usage_count + 1 WHERE id = :id",
            ['id' => $promo_code_id]
        );
    }

    public function getCouponExpiry($promo_code_id) {
        $result = $this->db->query(
            "SELECT expiry_date FROM promo_codes WHERE id = :id",
            ['id' => $promo_code_id]
        );
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['expiry_date'] ?? null;
    }
}
?>