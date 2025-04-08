<?php
// Correct the path to Database.php based on your directory structure
require_once __DIR__ . '/../Database/database.php';

class SalesReportModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }

    // Define the method to fetch monthly sales data
    public function getMonthlySalesData($year = null) {
        if ($year === null) {
            $year = date("Y");  // Use the current year if no year is provided
        }

        // Now place the SQL query inside the method
        $sql = "SELECT
                    MONTH(orderdate) as month,
                    COUNT(totalprice) as totalsales
                FROM
                    orders
                WHERE
                    YEAR(orderdate) = ?
                GROUP BY
                    MONTH(orderdate)
                ORDER BY
                    month ASC";

        // Prepare and execute the query
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$year]);

        // Fetch and return the results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

