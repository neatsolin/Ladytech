<?php

require_once "Models/RegisterModel.php";

class RegisterController extends BaseadminController {
    private $registers;

    public function __construct() {
        $this->registers = new RegisterModel();
    }

    // Display the registration form
    public function register() {
        $this->view('admin/inventory/register');
    }

    public function store() {
        // Sanitize input data
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);
    
        // Initialize the profile variable to an empty string
        $profile = '';
    
        // Check if a file was uploaded
        if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
            // Get file details
            $fileName = time() . "_" . basename($_FILES['profile']['name']);
            $uploadDir = 'profiles/';  // Ensure this directory exists
    
            // Create the upload directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);  // Create directory with full permissions
            }
    
            // Define the target file path
            $targetFilePath = $uploadDir . $fileName;
    
            // Validate file type (JPG, JPEG, PNG, GIF)
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
            if (in_array($fileType, $allowedTypes)) {
                // Move the uploaded file to the uploads directory
                if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetFilePath)) {
                    $profile = $targetFilePath;  // Store the file path for future use (e.g., in the database)
                } else {
                    die("Error uploading the image.");
                }
            } else {
                die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
            }
        } else {
            echo "No profile image uploaded or there was an error.";
        }
    
        //Save user to database
        $this->registers->registerUser($username, $email, $phone, $password, $profile, $role);
        header('Location:/users');
    }
    
    
}

?>
