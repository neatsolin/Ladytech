<?php
require_once "Models/LoginModel.php";

class LoginController extends BaseadminController {
    private $loginModel;

    public function __construct() {
        $this->loginModel = new LoginModel();
    }

    // Load the login page
    public function login() {
        $this->view('admin/inventory/login');
    }

    // Handle login form submission
    public function authenticate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: /login");
                exit();
            }

            $user = $this->loginModel->authenticate($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /dashboard");
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password!";
                header("Location: /login");
                exit();
            }
        }
    }

    // Logout user
    public function logout() {
        session_destroy();
        header("Location: /login");
        exit();
    }

    // Add new user (store)
    public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = trim($_POST['password']);
            $role = trim($_POST['role']);

            if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($role)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: /user-form");
                exit();
            }

            $userExists = $this->loginModel->checkUserExists($email);

            if ($userExists) {
                $_SESSION['error'] = "User already exists!";
                header("Location: /user-form");
                exit();
            }

            $isStored = $this->loginModel->insertUser($username, $email, $phone, $password, $role);

            if ($isStored) {
                $_SESSION['success'] = "User registered successfully!";
                header("Location: /login");
                exit();
            } else {
                $_SESSION['error'] = "An error occurred while registering!";
                header("Location: /user-form");
                exit();
            }
        }
    }
}
?>

