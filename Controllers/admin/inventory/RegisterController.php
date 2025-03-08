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
            $role = $_POST['role']; // Make sure the role is included from the form

            // Validate required fields
            if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($role)) {
                $message = "<div style='color: red;'>All fields are required!</div>";
            } else {
                // Register user in the database
                if ($this->model->registerUser($username, $email, $phone, $password, $role)) {
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
