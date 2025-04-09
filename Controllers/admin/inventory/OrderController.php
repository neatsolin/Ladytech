<?php
class OrderController extends BaseadminController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function orders() {
        $this->view('admin/inventory/order');
    }

    public function recent_order() {
        $this->view('admin/inventory/Order/Recent_order');
    }

    public function order_history() {
        $this->view('admin/inventory/Order/Order_history');
    }

    public function order_pending() {
        $this->view('admin/inventory/Order/Order_pending');
    }

    public function old_order() {
        $this->view('admin/inventory/Order/Older_order');
    }

    public function order_all() {
        try {
            // Cancel expired pending orders before fetching the list
            $canceledCount = $this->orderModel->cancelExpiredPendingOrders();
            if ($canceledCount > 0) {
                error_log("Automatically canceled $canceledCount expired pending orders.");
            }

            $allOrders = $this->orderModel->getAllOrders();

            $draftOrders = array_filter($allOrders, function($order) {
                return $order['orderstatus'] === 'Draft';
            });
            $orderedOrders = array_filter($allOrders, function($order) {
                return in_array($order['orderstatus'], ['Pending', 'Ordered']);
            });
            $partialOrders = array_filter($allOrders, function($order) {
                return $order['orderstatus'] === 'Partial';
            });
            $receivedOrders = array_filter($allOrders, function($order) {
                return $order['orderstatus'] === 'Received';
            });
            $closedOrders = array_filter($allOrders, function($order) {
                return in_array($order['orderstatus'], ['Closed', 'Delivered', 'Canceled']);
            });

            $data = [
                'allOrders' => $allOrders,
                'draftOrders' => $draftOrders,
                'orderedOrders' => $orderedOrders,
                'partialOrders' => $partialOrders,
                'receivedOrders' => $receivedOrders,
                'closedOrders' => $closedOrders
            ];
            $this->view('admin/inventory/Order/Allorder', $data);
        } catch (Exception $e) {
            error_log("Error in order_all: " . $e->getMessage());
            $data = [
                'allOrders' => [],
                'draftOrders' => [],
                'orderedOrders' => [],
                'partialOrders' => [],
                'receivedOrders' => [],
                'closedOrders' => []
            ];
            $this->view('admin/inventory/Order/Allorder', $data);
        }
    }

    public function deleteOrder() {
        header('Content-Type: application/json; charset=UTF-8');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }
        $orderId = $_POST['orderId'] ?? null;
        if (!$orderId) {
            echo json_encode(['success' => false, 'message' => 'No order ID provided']);
            exit;
        }
        try {
            $this->orderModel->deleteOrder($orderId);
            echo json_encode(['success' => true, 'message' => 'Order deleted successfully']);
        } catch (Exception $e) {
            error_log("Error in deleteOrder: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to delete order: ' . $e->getMessage()]);
        }
        exit;
    }

    public function updateOrderStatus() {
        header('Content-Type: application/json; charset=UTF-8');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }
        $orderId = $_POST['orderId'] ?? null;
        $newStatus = $_POST['orderStatus'] ?? null;
        if (!$orderId || !is_numeric($orderId) || $orderId <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
            exit;
        }
        if (!$newStatus || !in_array($newStatus, ['Pending', 'Delivered', 'Canceled'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid order status']);
            exit;
        }
        try {
            $this->orderModel->updateOrderStatus($orderId, $newStatus);
            echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
        } catch (Exception $e) {
            error_log("Error in updateOrderStatus: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to update order status: ' . $e->getMessage()]);
        }
        exit;
    }

    public function cancelOrder() {
        header('Content-Type: application/json; charset=UTF-8');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }
        $orderId = $_POST['orderId'] ?? null;
        if (!$orderId || !is_numeric($orderId) || $orderId <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
            exit;
        }
        try {
            $this->orderModel->cancelOrder($orderId);
            echo json_encode(['success' => true, 'message' => 'Order canceled successfully']);
        } catch (Exception $e) {
            error_log("Error in cancelOrder: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to cancel order: ' . $e->getMessage()]);
        }
        exit;
    }

    // Optional: Keep this method if you want to trigger it manually via /cancel_expired_orders
    public function cancelExpiredOrders() {
        try {
            $canceledCount = $this->orderModel->cancelExpiredPendingOrders();
            if ($canceledCount > 0) {
                error_log("Automatically canceled $canceledCount expired pending orders.");
                echo "Successfully canceled $canceledCount expired pending orders.";
            } else {
                echo "No expired pending orders found.";
            }
        } catch (Exception $e) {
            error_log("Error in cancelExpiredOrders: " . $e->getMessage());
            echo "Failed to cancel expired orders: " . $e->getMessage();
        }
        exit;
    }
}
?>