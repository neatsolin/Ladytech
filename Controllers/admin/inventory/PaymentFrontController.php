<?php
require_once "Models/OrderModel.php";
require_once "Models/PaymentModelF.php";
require_once "Models/TransactionModel.php";

class payController extends BasecustomerController {
    private $orderModel;
    private $paymentModelF;
    private $transactionModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->orderModel = new OrderModel();
        $this->paymentModelF = new PaymentModelF();
        $this->transactionModel = new TransactionModel();
    }

    // Confirm payment page
    public function index() {
        $this->verifyUserLoggedIn();
        $order_id = $_GET['order_id'] ?? null;

        if (!$order_id) {
            $this->view('pages/payment/confirmPayment', ['error' => 'No order specified']);
            return;
        }

        $orderDetails = $this->orderModel->getOrderById($order_id);
        if (empty($orderDetails)) {
            $this->view('pages/payment/confirmPayment', ['error' => 'Order not found']);
            return;
        }

        $order = $orderDetails[0]; // First row contains the order details
        $payment_method = null;
        $payment_type = 'Unknown';

        // Use session data for payment_type if available, otherwise fall back to guessing
        if (isset($_SESSION['confirm_data']) && $_SESSION['confirm_data']['order_id'] == $order_id) {
            $payment_type = $_SESSION['confirm_data']['payment_type'] ?? 'Unknown';
        } else {
            if ($order['payment_method_id']) {
                $payment_method = $this->paymentModelF->getPaymentMethodById($order['payment_method_id']);
                if ($payment_method) {
                    $payment_type = $this->guessPaymentType($payment_method['card_number']);
                } else {
                    error_log("Payment method not found for payment_method_id: " . $order['payment_method_id']);
                }
            } else {
                error_log("No payment method associated with order_id: $order_id");
            }
        }

        error_log("payController::index - Order ID: $order_id, Payment Type: $payment_type");

        $this->view('pages/payment/confirmPayment', [
            'order' => $order,
            'orderItems' => $orderDetails,
            'payment_method' => $payment_method,
            'currency' => $order['payments'],
            'payment_type' => $payment_type
        ]);
    }

    // Confirm payment submission
    public function confirmPayment() {
        $this->verifyUserLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/confirmpayment');
            return;
        }

        $order_id = $_POST['order_id'] ?? null;
        $amount = floatval($_POST['amount'] ?? 0);
        $payment_type = $_POST['payment_type'] ?? 'Unknown'; // Use payment_type from form

        if (!$order_id || $amount <= 0) {
            $this->redirect('/confirmpayment?order_id=' . $order_id . '&error=Invalid order or amount');
            return;
        }

        try {
            $orderDetails = $this->orderModel->getOrderById($order_id);
            if (empty($orderDetails)) {
                $this->redirect('/confirmpayment?order_id=' . $order_id . '&error=Order not found');
                return;
            }

            $order = $orderDetails[0];

            error_log("payController::confirmPayment - Order ID: $order_id, Amount: $amount, Payment Type: $payment_type");

            // Insert into transactions using the payment_type from the form
            $this->transactionModel->createTransaction($order_id, $payment_type, $amount);

            // Clear session data to prevent reuse
            unset($_SESSION['confirm_data']);

            $this->redirect('/orderSuccess?order_id=' . $order_id);
        } catch (Exception $e) {
            error_log("Error confirming payment: " . $e->getMessage());
            $this->redirect('/confirmpayment?order_id=' . $order_id . '&error=Error confirming payment: ' . $e->getMessage());
        }
    }

    // Order success page
    public function OrderSuccess() {
        $this->verifyUserLoggedIn();
        $order_id = $_GET['order_id'] ?? null;

        if (!$order_id) {
            $this->view('pages/payment/ordersuccess', ['error' => 'No order specified']);
            return;
        }

        $orderDetails = $this->orderModel->getOrderById($order_id);
        if (empty($orderDetails)) {
            $this->view('pages/payment/ordersuccess', ['error' => 'Order not found']);
            return;
        }

        $this->view('pages/payment/ordersuccess', [
            'order' => $orderDetails[0],
            'orderItems' => $orderDetails
        ]);
    }

    private function verifyUserLoggedIn() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/F_login');
        }
    }

    private function guessPaymentType($card_number) {
        if (empty($card_number)) {
            return 'Unknown';
        }
        $card_number = preg_replace('/\s+/', '', $card_number);
        if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $card_number)) {
            return 'Visa';
        } elseif (preg_match('/^5[1-5][0-9]{14}$/', $card_number)) {
            return 'MasterCard';
        } elseif (preg_match('/^3[47][0-9]{13}$/', $card_number)) {
            return 'Amex';
        } else {
            return 'Unknown';
        }
    }
}