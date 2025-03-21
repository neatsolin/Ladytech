<?php
require_once "Models/PaymentModel.php";

class PaymentController extends BaseadminController {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = new PaymentModel();
    }

    // Display the checkout page
    public function checkout() {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect("/login");
        }

        // Fetch the product details from the database
        $productId = $_GET['product_id'] ?? null;
        if ($productId) {
            $product = $this->paymentModel->getProductById($productId);
            if (!$product) {
                die("Product not found.");
            }

            // Fetch locations
            $locations = $this->paymentModel->getLocations();

            // Pass both product and locations to the view
            $this->view('admin/inventory/Payment/checkout', [
                'product' => $product,
                'locations' => $locations
            ]);
        } else {
            $this->redirect("/products");
        }
    }

    // Process the checkout form
    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ensure session is started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                die("User not logged in. Please log in to proceed.");
            }

            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];
            $locationId = $_POST['location_id'];
            $totalPrice = $_POST['total_price'];
            $orderStatus = 'Pending';
            $payments = 'USD';

            // Save the order
            $orderId = $this->paymentModel->createOrder(
                $userId,
                $locationId,
                $totalPrice,
                $orderStatus,
                $payments
            );

            if ($orderId) {
                // Link the product to the order in orderitems
                $this->paymentModel->addOrderItem($orderId, $productId, 1); // Quantity is 1 for now

                // Redirect to payment confirmation
                $this->redirect("/payment-confirmation?order_id=$orderId");
            } else {
                die("Error creating order.");
            }
        }
    }

    // Display the payment confirmation page
    public function paymentConfirmation() {
        $orderId = $_GET['order_id'] ?? null;
        if ($orderId) {
            $order = $this->paymentModel->getOrderById($orderId);
            $this->view('admin/inventory/Payment/payment_confirmation', ['order' => $order]);
        } 
        else {
            $this->redirect("/products");
        }
    }

    // Display the order success page
    
    public function orderSuccess() {
        $orderId = $_GET['order_id'] ?? null;
        if ($orderId) {
            $order = $this->paymentModel->getOrderById($orderId);
            $this->view('admin/inventory/Payment/order_success', ['order' => $order]);
        } else {
            $this->redirect("/products");
        }
    }

    
}
?>