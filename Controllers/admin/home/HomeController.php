<?php
    class HomeController extends BaseAdminController{
        public function index(){
            $this->view('admin/home/homeView');
        }
    }
?>