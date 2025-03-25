<?php

require_once "Models/RegisterModel.php";

class RegisterController extends BaseadminController {
    private $registers;

    public function __construct() {
        $this->registers = new RegisterModel();
    }

    // Display the registration form
    public function register() {
        require_once __DIR__ . '/../../../views/admin/inventory/register.php';
    }

    public function store() {
        // Sanitize input data
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $password = $_POST['password'];
        $role = htmlspecialchars($_POST['role']);
    
        // fix role
        $role = ($role === 'users') ? 'users' : $role;
    
        // Check if email already exists
        if ($this->registers->emailExists($email)) {
            $_SESSION['error'] = "This email is already registered!";
            header('Location:/F_register');
            exit();
        }
    
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
                if (!move_uploaded_file($_FILES['profile']['tmp_name'], $targetFilePath)) {
                    $_SESSION['error'] = "Error uploading the image.";
                    header('Location:/F_register');
                    exit();
                }
                $profile = $targetFilePath;
            } else {
                $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
                header('Location:/F_register');
                exit();
            }
        }
    
        // Save user to database and get the result
        $result = $this->registers->registerUser($username, $email, $phone, $password, $profile, $role);
        
        if ($result) {
            $_SESSION['success'] = "Registration successful!";
            header('Location:/F_login'); // Redirect to register page to show success alert
            exit();
        } else {
            $_SESSION['error'] = "Registration failed! Please try again.";
            header('Location:/F_register');
        }
        exit();
    }
    
    
}

?>
