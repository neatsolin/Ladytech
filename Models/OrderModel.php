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

    public function getAllOrders() {
        try {
            $result = $this->db->query(
                "SELECT o.*, 
                        (SELECT p.productname 
                         FROM products p 
                         JOIN orderitems oi ON p.id = oi.product_id 
                         WHERE oi.order_id = o.id 
                         LIMIT 1) AS product_name, 
                        u.username, 
                        u.profile AS user_profile 
                 FROM orders o 
                 LEFT JOIN users u ON o.user_id = u.id 
                 ORDER BY o.orderdate ASC"
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching all orders: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteOrder($order_id) {
        try {
            // Delete related transactions
            $this->db->query(
                "DELETE FROM transactions WHERE order_id = :order_id",
                ['order_id' => $order_id]
            );

            // Delete the order (orderitems will be deleted automatically due to ON DELETE CASCADE)
            $this->db->query(
                "DELETE FROM orders WHERE id = :order_id",
                ['order_id' => $order_id]
            );

            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Error deleting order: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateOrderStatus($order_id, $new_status) {
        try {
            // Check if the order exists
            $orderExists = $this->db->query(
                "SELECT id FROM orders WHERE id = :order_id",
                ['order_id' => $order_id]
            )->fetch(PDO::FETCH_ASSOC);
    
            if (!$orderExists) {
                throw new Exception("Order with ID $order_id does not exist.");
            }
    
            // Update the order status
            $this->db->query(
                "UPDATE orders SET orderstatus = :orderstatus WHERE id = :order_id",
                [
                    'orderstatus' => $new_status,
                    'order_id' => $order_id
                ]
            );
    
            return true;
        } catch (Exception $e) {
            error_log("Error updating order status: " . $e->getMessage());
            throw $e;
        }
    }

    public function cancelOrder($order_id) {
        try {
            // Check if the order exists and is in a cancellable state (Pending)
            $order = $this->db->query(
                "SELECT orderstatus FROM orders WHERE id = :order_id",
                ['order_id' => $order_id]
            )->fetch(PDO::FETCH_ASSOC);

            if (!$order) {
                throw new Exception("Order with ID $order_id does not exist.");
            }

            if ($order['orderstatus'] !== 'Pending') {
                throw new Exception("Order cannot be canceled: Current status is {$order['orderstatus']}. Only Pending orders can be canceled.");
            }

            // Call the stored procedure to cancel the order and update inventory
            $this->db->query(
                "CALL CancelOrder(:order_id)",
                ['order_id' => $order_id]
            );

            // Log a notification for the user
            $this->db->query(
                "INSERT INTO notifications (user_id, message, notedate) 
                 SELECT user_id, CONCAT('Your order #', :order_id, ' has been canceled due to expiration.'), NOW() 
                 FROM orders WHERE id = :order_id",
                ['order_id' => $order_id]
            );

            return true;
        } catch (Exception $e) {
            error_log("Error canceling order: " . $e->getMessage());
            throw $e;
        }
    }

    public function cancelExpiredPendingOrders() {
        try {
            // Select all Pending orders older than 48 hours
            $result = $this->db->query(
                "SELECT id 
                 FROM orders 
                 WHERE orderstatus = 'Pending' 
                 AND orderdate <= DATE_SUB(NOW(), INTERVAL 48 HOUR)"
            );
            $expiredOrders = $result->fetchAll(PDO::FETCH_ASSOC);

            if (empty($expiredOrders)) {
                return 0; // No orders to cancel
            }

            $canceledCount = 0;
            foreach ($expiredOrders as $order) {
                $this->cancelOrder($order['id']); // Use the existing cancelOrder method
                $canceledCount++;
            }

            return $canceledCount; // Return the number of orders canceled
        } catch (Exception $e) {
            error_log("Error canceling expired pending orders: " . $e->getMessage());
            throw $e;
        }
    }
}
?>