<?php

require_once __DIR__ . "/../../../models/RegisterModel.php"; // Adjust the path if necessary

class RegisterController extends BaseadminController {
    private $model;

    public function __construct() {
        $this->model = new RegisterModel(); // Initialize the model
    }

    public function register() {
        $message = ""; // Initialize message variable

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $profileImage = null; // Default to null

            // Check if an image is uploaded
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $uploadDir = __DIR__ . "/../../../uploads/"; // Adjust path as needed
                $imageName = time() . "_" . basename($_FILES["profile_image"]["name"]);
                $targetFile = $uploadDir . $imageName;

                // Validate file type (only allow images)
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $allowedTypes = ["jpg", "jpeg", "png", "gif"];

                if (!in_array($imageFileType, $allowedTypes)) {
                    $message = "<div style='color: red;'>Only JPG, JPEG, PNG, and GIF files are allowed.</div>";
                } elseif (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
                    $profileImage = $imageName; // Store filename in DB
                } else {
                    $message = "<div style='color: red;'>Error uploading image.</div>";
                }
            }

            // Validate required fields
            if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($role)) {
                $message = "<div style='color: red;'>All fields are required!</div>";
            } else {
                // Register user in the database
                if ($this->model->registerUser($username, $email, $phone, $password, $role, $profileImage)) {
                    $message = "<div style='color: green;'>Registration successful!</div>";
                } else {
                    $message = "<div style='color: red;'>Error: Unable to register.</div>";
                }
            }
        }

        // Load the registration view and pass the message
        $this->view('admin/inventory/register', ['message' => $message]);
    }
}

?>
