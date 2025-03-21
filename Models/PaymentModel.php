<?php
class PaymentModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }

    // Get product by ID
    public function getProductById($id) {
        try {
            $result = $this->db->query("SELECT * FROM products WHERE id = :id", ['id' => $id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching product: " . $e->getMessage());
        }
    }

    // Create a new order
    public function createOrder($userId, $locationId, $totalPrice, $orderStatus, $payments) {
        try {
            $result = $this->db->query(
                "INSERT INTO orders (user_id, location_id, totalprice, orderstatus, payments, orderdate) 
                 VALUES (:user_id, :location_id, :totalprice, :orderstatus, :payments, NOW())",
                [
                    'user_id' => $userId,
                    'location_id' => $locationId,
                    'totalprice' => $totalPrice,
                    'orderstatus' => $orderStatus,
                    'payments' => $payments // Ensure this is passed correctly
                ]
            );
            return $this->db->lastInsertId(); // Return the new order ID
        } catch (PDOException $e) {
            die("Error creating order: " . $e->getMessage());
        }
    }

    // Add an item to the order
    public function addOrderItem($orderId, $productId, $quantity) {
        try {
            $this->db->query(
                "INSERT INTO orderitems (order_id, product_id, quantity) 
                 VALUES (:order_id, :product_id, :quantity)",
                [
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]
            );
        } catch (PDOException $e) {
            die("Error adding order item: " . $e->getMessage());
        }
    }

    // Get order by ID
    public function getOrderById($id) {
        try {
            $result = $this->db->query(
                "SELECT o.*, p.productname, p.price, p.imageURL 
                 FROM orders o 
                 JOIN orderitems oi ON o.id = oi.order_id
                 JOIN products p ON oi.product_id = p.id 
                 WHERE o.id = :id",
                ['id' => $id]
            );
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching order: " . $e->getMessage());
        }
    }

    // Get all locations
    public function getLocations() {
        try {
            $result = $this->db->query("SELECT * FROM locations");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching locations: " . $e->getMessage());
        }
    }

    // Create a new transaction
    public function createTransaction($orderId, $paymentMethod, $amount) {
        try {
            $this->db->query(
                "INSERT INTO transactions (order_id, payment_method, amount) 
                 VALUES (:order_id, :payment_method, :amount)",
                [
                    'order_id' => $orderId,
                    'payment_method' => $paymentMethod,
                    'amount' => $amount
                ]
            );
        } catch (PDOException $e) {
            die("Error creating transaction: " . $e->getMessage());
        }
    }
}
?>