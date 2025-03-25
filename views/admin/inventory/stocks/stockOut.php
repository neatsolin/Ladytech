<?php
require_once __DIR__ . '/../../../../Database/database.php';
$db = new Database("localhost", "dailyneed_db", "root", "");

// Example of deleting a product
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    try {
        // Fetch the product's stock quantity before deletion (removed last_update_date from query)
        $fetch_query = "SELECT productname, stockquantity, price FROM products WHERE id = :id";
        $stmt = $db->prepare($fetch_query);
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the stock quantity is 0 or less, log stockout
        if ($product['stockquantity'] <= 0) {
            // Here you can add any logic to log stockouts (optional)
            echo "Stockout detected for product ID: " . $delete_id . " (Stock Quantity: " . $product['stockquantity'] . ")";
        }

        // Proceed to delete the product from the products table
        $delete_query = "DELETE FROM products WHERE id = :id";
        $stmt = $db->prepare($delete_query);
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();

        // Provide success message
        echo "Product deleted successfully.";
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>

<style>

#stock_level {
    margin-top: 50px;
    font-size: px;
    color: rgb(3, 43, 80);

}

h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 15px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background-color: #0A2A4A;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #dde7f1;
    transition: 0.3s;
}

td {
    color: #333;
    font-size: 16px;
}

@media (max-width: 768px) {
    table {
        font-size: 12px;
    }
    th, td {
        padding: 8px;
    }
}
</style>

<h2>Stockout Products</h2>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Stock Quantity</th>
            <th>Price</th>
            <th>Last Update Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch products with stock quantity <= 0 from the database
        $query = "SELECT productname, stockquantity, price FROM products WHERE stockquantity <= 0";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($products)) {
            foreach ($products as $product) {
                echo "<tr>
                    <td>" . htmlspecialchars($product['productname']) . "</td>
                    <td>" . htmlspecialchars($product['stockquantity']) . "</td>
                    <td>" . number_format($product['price'], 2) . "$</td>
                    <td>" . htmlspecialchars($product['last_update_date']) . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No stockout products.</td></tr>";
        }
        ?>
    </tbody>
</table>
