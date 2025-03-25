<?php
require_once __DIR__ . '/../../../../Database/database.php';

// Database connection
$db = new Database("localhost", "dailyneed_db", "root", "");

// SQL query matching your table structure
$products_query = "SELECT 
    p.id,
    p.productname,
    p.descriptions,
    p.categories,
    p.price,
    p.stockquantity,
    p.imageURL,
    p.created_at,
    p.updated_at,
    (p.stockquantity * p.price) AS total_price
    FROM products p
    ORDER BY p.id DESC"; // Descending order by id

try {
    $products_result = $db->query($products_query);
    $products = $products_result->fetchAll(PDO::FETCH_ASSOC);
    if (!$products) {
        echo "No products found.";
    }
} catch (PDOException $e) {
    die("Database Query Error: " . $e->getMessage());
}
?>

<style>
    #stock_level {
        margin-top: 50px;
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

    .product-image {
        width: 50px; /* Reduced size from 70px to 50px */
        height: 50px;
        object-fit: contain; /* Ensure the entire image is visible */
        border-radius: 10px; /* Rounded corners */
        background-color: #fff; /* White background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        padding: 5px; /* Padding to create space around the image */
    }

    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }
        th, td {
            padding: 8px;
        }
        .product-image {
            width: 30px; /* Reduced size for mobile from 50px to 30px */
            height: 30px;
        }
    }
</style>

<h2>Stock History</h2>
<table>
    <thead>
        <tr>
            <th>Image</th>
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
            <td>
                <?php if (!empty($row['imageURL'])): ?>
                    <!-- Debug: Log the imageURL to check its value -->
                    <?php error_log("Image URL for {$row['productname']}: " . $row['imageURL']); ?>
                    <img src="/<?php echo htmlspecialchars($row['imageURL']); ?>" 
                         alt="<?php echo htmlspecialchars($row['productname']); ?>" 
                         class="product-image"
                         onerror="this.onerror=null; this.src='/images/default.jpg';">
                <?php else: ?>
                    <span>No Image</span>
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($row['productname'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($row['stockquantity'] ?? '0'); ?></td>
            <td><?php echo number_format($row['total_price'] ?? 0, 2); ?>$</td>
            <td>
                <?php 
                if (!empty($row['updated_at']) && $row['updated_at'] !== '0000-00-00 00:00:00') {
                    echo date('Y-m-d H:i:s', strtotime($row['updated_at']));
                } else {
                    echo 'N/A';
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" style="text-align:center;">No data available</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<h2 id="stock_level">Stock Level</h2>
<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Stock Quantity</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($products) && is_array($products)): ?>
        <?php foreach ($products as $row): ?>
        <tr>
            <td>
                <?php if (!empty($row['imageURL'])): ?>
                    <!-- Debug: Log the imageURL to check its value -->
                    <?php error_log("Image URL for {$row['productname']}: " . $row['imageURL']); ?>
                    <img src="/<?php echo htmlspecialchars($row['imageURL']); ?>" 
                         alt="<?php echo htmlspecialchars($row['productname']); ?>" 
                         class="product-image"
                         onerror="this.onerror=null; this.src='/images/default.jpg';">
                <?php else: ?>
                    <span>No Image</span>
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($row['productname'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($row['stockquantity'] ?? '0'); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3" style="text-align:center;">No data available</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>