<?php

class UserController extends BaseadminController {
    public function users() {
        require_once 'models/UserModel.php';
        $userModel = new UserModel();
        $users = $userModel->getUsers();

        // Pass data to the view
        $this->view('admin/inventory/usersManagement', ['users' => $users]);
    }
}
?>