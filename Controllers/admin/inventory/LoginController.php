<?php
    class LoginController extends BaseadminController{
        public function login(){
            $this->view('admin/inventory/login');
        }
        public function userform(){
            $this->view('user/user-form');
        }
    }

?>



 