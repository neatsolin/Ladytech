<?php
    class OrderController extends BaseadminController{
        public function orders(){
            $this->view('admin/inventory/order');
        }

        public function recent_order(){
            $this->view('admin/inventory/Order/Recent_order');
        }

        public function order_history(){
            $this->view('admin/inventory/Order/Order_history');
        }

        public function order_pending(){
            $this->view('admin/inventory/Order/Order_pending');
        }

        public function old_order(){
            $this->view('admin/inventory/Order/Older_order');
        }

        public function order_all(){
            $this->view('admin/inventory/Order/Allorder');
        }
    }
?>

