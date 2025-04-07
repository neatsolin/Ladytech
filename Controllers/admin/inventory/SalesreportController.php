<?php
// Ensure the correct path to the model file
require_once  'Models/SalesReportModel.php';  // Adjust the path as necessary

// Inherit from the base admin controller
class SalesreportController extends BaseadminController {


    // Method to render the view for the sales report
    public function salesreport() {
        $this->view('admin/inventory/salesReport');
    }

    // Method to get sales report data
    public function getSalesReport() {
        // Fetch the sales data using the model
        $data = $this->salesReportModel->getSalesData();
        // You can process the data here or pass it to a view
        return $data;
    }
}
?>
