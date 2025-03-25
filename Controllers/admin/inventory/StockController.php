<?php
    class StockController extends BaseadminController{
        public function stock(){
            $this->view('admin/inventory/stock');
        }
        public function stockIn(){
            $this->view('admin/inventory/stocks/stockIn');
        }
        public function stockOut(){
            $this->view('admin/inventory/stocks/stockOut');
        }
       
    }
   
    
    


?>