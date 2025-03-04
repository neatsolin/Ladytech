
<?php
    class ProductController extends BaseadminController {
        private $products;
    
        public function __construct(){
            // $this->products = new ProductModel();
        }
    
        public function products(){
            $this->view('admin/inventory/products');
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
    
            // Check if a file was uploaded
            if (isset($_FILES['imageURL']) && $_FILES['imageURL']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/'; // Ensure this directory exists
                if (!is_dir($uploadDir)) {
                    die("Upload directory does not exist.");
                }
    
                $fileName = time() . "_" . basename($_FILES['imageURL']['name']);
                $targetFilePath = $uploadDir . $fileName;
    
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
    
            // Debugging output
            var_dump($productName, $description, $category, $price, $stockQuantity);
            exit; // Ensure output is displayed immediately after var_dump()
        }
    }
    
    
?>