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
            $currency = $_POST['currency']; // Get the selected currency
            $quantity = $_POST['quantity'];
            $orderStatus = $_POST['order_status'];
            $payments = $currency; 
    
            // Save the selected currency in the session
            $_SESSION['currency'] = $currency; // Add this line

            //collect payment information
            $cardNumber = $_POST['card_number'];
            $cardHolderName = $_POST['card_holder_name'];
            $expiryDate = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];

            // Save the selected currency in the session
            $_SESSION['currency'] = $currency;

            // Save the payment method
            $paymentMethodId = $this->paymentModel->addPaymentMethod(
                $userId,
                $cardNumber,
                $cardHolderName,
                $expiryDate,
                $cvv,
                $currency
            );

            // if (!$paymentMethodId) {
            //     die("Error saving payment method.");
            // }
    
            // Save the order
            $orderId = $this->paymentModel->createOrder(
                $userId,
                $locationId,
                $totalPrice,
                $orderStatus,
                $payments // Pass the selected currency
            );
    
            if ($orderId) {
                // Link the product to the order in orderitems
                $this->paymentModel->addOrderItem($orderId, $productId, $quantity);
    
                // Redirect to payment confirmation
                $this->redirect("/payment-confirmation?order_id=$orderId");
            } else {
                die("Error creating order.");
            }
        }
    }

    // Display the payment confirmation page
    public function paymentConfirmation() {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Retrieve the selected currency from the session
        $currency = $_SESSION['currency'] ?? 'USD'; // Default to USD if not set
    
        $orderId = $_GET['order_id'] ?? null;
        if ($orderId) {
            $order = $this->paymentModel->getOrderById($orderId);
    
            // Pass the currency to the view
            $this->view('admin/inventory/Payment/payment_confirmation', [
                'order' => $order,
                'currency' => $currency // Add this line
            ]);
        } else {
            $this->redirect("/products");
        }
    }

    // Handle Confirm Payment action
    public function confirmPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ensure session is started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                die("User not logged in. Please log in to proceed.");
            }

            $orderId = $_POST['order_id'];
            $paymentMethod = $_POST['payment_method'];
            $amount = $_POST['amount'];

            // Insert transaction into the database
            $this->paymentModel->createTransaction($orderId, $paymentMethod, $amount);

            // Redirect to order success page
            $this->redirect("/order-success?order_id=$orderId");
        }
    }

    // Display the order success page
    public function orderSuccess() {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Retrieve the selected currency from the session
        $currency = $_SESSION['currency'] ?? 'USD'; // Default to USD if not set
    
        $orderId = $_GET['order_id'] ?? null;
        if ($orderId) {
            $order = $this->paymentModel->getOrderById($orderId);
    
            // Pass the currency to the view
            $this->view('admin/inventory/Payment/order_success', [
                'order' => $order,
                'currency' => $currency // Add this line
            ]);
        } else {
            $this->redirect("/products");
        }
    }
    public function payment(){
        require_once __DIR__. '/../../../views/admin/inventory/Payment/payment.php';
    }
}
?>