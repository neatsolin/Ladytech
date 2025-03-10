<?php
    require_once 'Models/UserModel.php';
    class UserController extends BaseadminController {
        private $users;

        // Constructor to start the session and initialize the user model
        public function __construct(){
            $this->users = new UserModel();
        }

        // Get all users from the database
        public function users() {
            $users = $this->users->getUsers();

            // Pass data to the view
            $this->view('admin/inventory/usersManagement', ['users' => $users]);
        }

        // Edit user
        public function edit($id) {
            $user = $this->users->getUserById($id);
        }
    }
?>