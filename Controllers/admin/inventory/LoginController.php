<?php
    require_once "Models/LoginModel.php";
    class LoginController extends BaseadminController{
        private $users;

        // Constructor to start the session and initialize the user model
        public function __construct(){
            $this->users = new LoginModel();
        }

        // show login form
        public function login(){
            $this->view('admin/inventory/login');
        }

        // user authebicate
        public function authenticate(){
            session_start();
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $user = $this->users->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])){
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_phone'] = $user['phone'];
                $_SESSION['user_profile'] = $user['profile'];
                $this->redirect("/users");
            }else {
                $this->view("admin/inventory/login", ['error' => 'Invalid email or password']);
            }
        }
    }
?>

