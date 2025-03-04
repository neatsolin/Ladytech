<?php
    require_once "Models/ProductModel.php";
    class ProductController extends BaseadminController {
        private $products;
    
        public function __construct(){
            $this->products = new ProductModel();
        }
    
        public function products(){
            $products = $this->products->getProducts();
            $this->view('admin/inventory/products', ['products'=>$products]);
        }
    
        public function addproduct(){
            $this->view('admin/Form/addProduct');
        }
    
        public function store() {
            // Capture text inputs
            $productName = htmlspecialchars($_POST['productname']);
            $description = htmlspecialchars($_POST['descriptions']);
            $category = htmlspecialchars($_POST['categories']);
            $price = htmlspecialchars($_POST['price']);
            $stockQuantity = htmlspecialchars($_POST['stockquantity']);
        
            // Fix typo in $_POST key
            $imagePath = isset($_POST['imageURL']) ? htmlspecialchars($_POST['imageURL']) : '';
        
            // Check if upload directory exists, create it if not
            $uploadDir = 'uploads/'; // Ensure this directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create directory with full permissions
            }
        
            // Check if a file was uploaded
            if (isset($_FILES['imageURL']) && $_FILES['imageURL']['error'] === UPLOAD_ERR_OK) {
                $fileName = time() . "_" . basename($_FILES['imageURL']['name']);
                $targetFilePath = $fileName;
        
                // Validate file type
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        
                if (in_array($fileType, $allowedTypes)) {
                    // Move file to the uploads directory
                    if (move_uploaded_file($_FILES['imageURL']['tmp_name'], $targetFilePath)) {
                        $imagePath = $targetFilePath;
                    } else {
                        die("Error uploading the image.");
                    }
                } else {
                    die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
                }
            } else {
                die("No image uploaded.");
            }
        
            // Save product to database
            $this->products->addProduct($productName, $description, $category, $price, $stockQuantity, $imagePath);
            header('Location:/products');
        }
    }
    
    
?>