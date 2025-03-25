<?php
// Include the database class file
require_once __DIR__ . '/../../../../Database/database.php';

// Database connection
$db = new Database("localhost", "dailyneed_db", "root", "");

// Corrected SQL query
$products_query = "SELECT 
    p.productname, 
    p.id,
    p.stockquantity,
    p.price AS latest_price,  -- Keep the original price
    (p.stockquantity * p.price) AS total_price,  -- Multiply price × stock
    (SELECT i.updatedate FROM inventory i WHERE i.product_id = p.id ORDER BY i.updatedate DESC LIMIT 1) AS last_update
    FROM products p";

try {
    $products_result = $db->query($products_query);
    $products = $products_result->fetchAll(PDO::FETCH_ASSOC);

    if (!$products) {
        echo "No products found."; // Debugging message
    }
} catch (PDOException $e) {
    die("Database Query Error: " . $e->getMessage()); // Check for SQL errors
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

<h2>Stock History</h2>
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
    <?php if (!empty($products) && is_array($products)): ?>
    <?php foreach ($products as $row): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['productname'] ?? 'N/A'); ?></td>
        <td><?php echo htmlspecialchars($row['stockquantity'] ?? '0'); ?></td>
        <td><?php echo number_format($row['total_price'] ?? 0, 2); ?>$</td>  <!-- Show total price -->
        <td><?= (!empty($row['updatedate']) && $row['updatedate'] !== '0000-00-00 00:00:00') 
            ? date('Y-m-d H:i:s', strtotime($row['updatedate'])) 
            : 'N/A'; ?>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4" style="text-align:center;">No data available</td>
    </tr>
<?php endif; ?>

</tbody>


</table>



</table>
<h2 id="stock_level">Stock Level</h2>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Stock Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products) && is_array($products)): ?>
            <?php foreach ($products as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['productname']); ?></td>
                <td><?php echo htmlspecialchars($row['stockquantity']); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No products found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>