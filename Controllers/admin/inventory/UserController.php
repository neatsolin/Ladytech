<?php
    class UserController extends BaseadminController{
        public function users(){
            $this->view('admin/inventory/usersManagement');
        }
    }
?>