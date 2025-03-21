<?php
require_once "Models/LoginModel.php";
class LoginController extends BaseadminController {
    private $users;

    // Constructor to start the session and initialize the user model
    public function __construct(){
        $this->users = new LoginModel();
    }

    // Show login form
    public function login(){
        require_once __DIR__ . '/../../../views/admin/inventory/login.php';
    }

    // User authenticate
    public function authenticate(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Start session only if not already started
        }

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $user = $this->users->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_phone'] = $user['phone'];
            $_SESSION['user_profile'] = $user['profile'];

            $this->redirect("/users");
        } else {
            $_SESSION['error'] = "incorrect email or password"; // Store error message in session
            $this->redirect("/login"); // Redirect to login page
        }
    }

    // Logout function
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Start session only if not already started
        }
        session_destroy(); // Destroy the session
        $this->redirect("/login"); // Redirect to login page
    }
}
?>
