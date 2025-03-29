<?php
require_once "Models/ProductModel.php";
require_once "Models/cartModel.php";

class CartController extends  BasecustomerController {
    private $cartModel;
    private $productModel;

    public function __construct() {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    // Add item to cart
    public function add() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        $product_id = $this->getPost('product_id');
        $quantity = $this->getPost('quantity', 1);

        error_log("Adding to cart: user_id=$user_id, product_id=$product_id, quantity=$quantity");

        if ($quantity < 1) {
            error_log("Quantity validation failed");
            $this->jsonResponse(false, 'Quantity must be at least 1');
        }

        $product = $this->productModel->getProductById($product_id);
        if (!$product) {
            error_log("Product not found: product_id=$product_id");
            $this->jsonResponse(false, 'Product not found');
        }

        if ($product['stockquantity'] < $quantity) {
            error_log("Insufficient stock: product_id=$product_id, stock={$product['stockquantity']}, requested=$quantity");
            $this->jsonResponse(false, 'Not enough stock available');
        }

        try {
            $success = $this->cartModel->addItem($user_id, $product_id, $quantity);
            if ($success) {
                error_log("Successfully added to cart: user_id=$user_id, product_id=$product_id");
            } else {
                error_log("Failed to add to cart: user_id=$user_id, product_id=$product_id");
            }
            $this->jsonResponse($success, $success ? 'Item added to cart' : 'Failed to add item');
        } catch (Exception $e) {
            error_log("Exception while adding to cart: " . $e->getMessage());
            $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }

    // Get cart items for the user
    public function getItems() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        try {
            $items = $this->cartModel->getCartItems($user_id);
            error_log("Fetched cart items for user_id=$user_id, items_count=" . count($items));
            $this->jsonResponse(true, 'Cart items retrieved', $items);
        } catch (Exception $e) {
            error_log("Exception while fetching cart items: " . $e->getMessage());
            $this->jsonResponse(false, 'Error fetching cart items: ' . $e->getMessage());
        }
    }

    // Remove item from cart
    public function remove() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        $product_id = $this->getPost('product_id');
        
        try {
            $success = $this->cartModel->removeItem($user_id, $product_id);
            if ($success) {
                error_log("Successfully removed from cart: user_id=$user_id, product_id=$product_id");
            } else {
                error_log("Failed to remove from cart: user_id=$user_id, product_id=$product_id");
            }
            $this->jsonResponse($success, $success ? 'Item removed from cart' : 'Failed to remove item');
        } catch (Exception $e) {
            error_log("Exception while removing from cart: " . $e->getMessage());
            $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }

    // Helper methods
    private function verifyUserLoggedIn() {
        if (!isset($_SESSION['user_id'])) {
            error_log("User not logged in");
            $this->jsonResponse(false, 'User not logged in');
        }
    }

    private function getPost($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    private function jsonResponse($success, $message = '', $data = []) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }
    public function viewcart() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        try {
            $cartItems = $this->cartModel->getCartItems($user_id);
            error_log("Fetched cart items for user_id=$user_id, items_count=" . count($cartItems));
            
            // Pass the cart items to the view
            $this->view('pages/payment/viewcart', ['cartItems' => $cartItems]);
        } catch (Exception $e) {
            error_log("Exception while fetching cart items: " . $e->getMessage());
            $this->view('pages/payment/viewcart', ['cartItems' => [], 'error' => 'Error fetching cart items']);
        }
    }

    // Checkout 
    public function checkout() {
        $this->verifyUserLoggedIn();
        $user_id = $_SESSION['user_id'];
    
        try {
            $cartItems = $this->cartModel->getCartItems($user_id);
            if (empty($cartItems)) {
                $this->view('pages/payment/checkout', ['cartItems' => [], 'error' => 'Cart is empty']);
                return;
            }
    
            // Assuming you have a UserModel to fetch user details
            $userModel = new UserModel(); // Add this if not already present
            $user = $userModel->getUserById($user_id);
    
            // Assuming a LocationModel for shipping locations
            // $locationModel = new LocationModel(); // Add this if needed
            // $locations = $locationModel->getAllLocations();
    
            $this->view('pages/payment/checkout', [
                'cartItems' => $cartItems,
                'user' => $user
            ]);
        } catch (Exception $e) {
            error_log("Exception in checkout: " . $e->getMessage());
            $this->view('pages/payment/checkout', [
                'cartItems' => [],
                'error' => 'Error loading checkout: ' . $e->getMessage()
            ]);
        }
    }

    // Update quantity of an item in the cart
    public function update() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        $product_id = $this->getPost('product_id');
        $quantity = $this->getPost('quantity', 1);
    
        error_log("Updating cart: user_id=$user_id, product_id=$product_id, quantity=$quantity");
    
        if ($quantity < 1) {
            error_log("Quantity validation failed");
            $this->jsonResponse(false, 'Quantity must be at least 1');
        }
    
        $product = $this->productModel->getProductById($product_id);
        if (!$product) {
            error_log("Product not found: product_id=$product_id");
            $this->jsonResponse(false, 'Product not found');
        }
    
        if ($product['stockquantity'] < $quantity) {
            error_log("Insufficient stock: product_id=$product_id, stock={$product['stockquantity']}, requested=$quantity");
            $this->jsonResponse(false, 'Not enough stock available');
        }
    
        try {
            $success = $this->cartModel->updateItem($user_id, $product_id, $quantity);
            error_log("Update result: " . ($success ? 'true' : 'false'));
            if ($success) {
                error_log("Successfully updated cart: user_id=$user_id, product_id=$product_id");
            } else {
                error_log("Failed to update cart: user_id=$user_id, product_id=$product_id");
            }
            $this->jsonResponse($success, $success ? 'Quantity updated' : 'Failed to update quantity');
        } catch (Exception $e) {
            error_log("Exception while updating cart: " . $e->getMessage());
            $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }
    
}