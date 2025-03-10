<?php

class UserController extends BaseadminController {
    public function users() {
        require_once 'models/UserModel.php';
        $userModel = new UserModel();
        $users = $userModel->getUsers();

        // Pass data to the view
        $this->view('admin/inventory/usersManagement', ['users' => $users]);
    }

    // Handle Edit User
    public function editUser($id) {
        require_once 'models/UserModel.php';
        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get POST data
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $profile = $_FILES['profile']['name'] ?? $_POST['currentProfile']; // Use current profile if no new one uploaded

            // Upload new profile if a file is selected
            if ($_FILES['profile']['error'] == 0) {
                $uploadDir = 'uploads/profiles/';
                $uploadFile = $uploadDir . basename($_FILES['profile']['name']);
                move_uploaded_file($_FILES['profile']['tmp_name'], $uploadFile);
            }

            // Update user
            if ($userModel->updateUser($id, $username, $email, $phone, $role, $profile)) {
                header('Location: /admin/Form/editUser.php');
            } else {
                echo "Error updating user";
            }
        } else {
            $user = $userModel->getUserById($id);
            $this->view('admin/inventory/editUser', ['user' => $user]);
        }
    }

    // Handle Delete User
    public function deleteUser($id) {
        require_once 'models/UserModel.php';
        $userModel = new UserModel();

        if ($userModel->deleteUser($id)) {
            header('Location: /admin/users');
        } else {
            echo "Error deleting user";
        }
    }
}
