<?php
class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }

    public function createOrder($user_id, $payment_method_id, $location_id, $total_price, $order_status, $currency) {
        try {
            $result = $this->db->query(
                "INSERT INTO orders (user_id, payment_method_id, location_id, totalprice, orderstatus, payments, orderdate) 
                VALUES (:user_id, :payment_method_id, :location_id, :totalprice, :orderstatus, :payments, NOW())",
                [
                    'user_id' => $user_id,
                    'payment_method_id' => $payment_method_id,
                    'location_id' => $location_id,
                    'totalprice' => $total_price,
                    'orderstatus' => $order_status,
                    'payments' => $currency
                ]
            );
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            error_log("Error creating order: " . $e->getMessage());
            throw $e;
        }
    }

    public function addOrderItem($order_id, $product_id, $quantity) {
        try {
            $this->db->query(
                "INSERT INTO orderitems (order_id, product_id, quantity) 
                VALUES (:order_id, :product_id, :quantity)",
                [
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'quantity' => $quantity
                ]
            );
        } catch (Exception $e) {
            error_log("Error adding order item: " . $e->getMessage());
            throw $e;
        }
    }

    public function getOrderById($order_id) {
        try {
            $result = $this->db->query(
                "SELECT o.*, oi.product_id, oi.quantity, p.productname, p.price, p.imageURL, l.location_name 
                FROM orders o 
                LEFT JOIN orderitems oi ON o.id = oi.order_id 
                LEFT JOIN products p ON oi.product_id = p.id 
                LEFT JOIN locations l ON o.location_id = l.id 
                WHERE o.id = :id",
                ['id' => $order_id]
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching order: " . $e->getMessage());
            throw $e;
        }
    }
}