<?php
require_once __DIR__ . '/../../../../Database/database.php';

// Database connection
$db = new Database("localhost", "dailyneed_db", "root", "");

// Check if delete request is received
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    try {
        // Fetch the product details before deletion
        $fetch_query = "SELECT id, productname, descriptions, categories, price, stockquantity, imageURL, created_at, updated_at 
                        FROM products WHERE id = :id";
        $stmt = $db->prepare($fetch_query);
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Store deleted product details
            $insert_query = "INSERT INTO deleted_products (product_id, productname, descriptions, categories, price, stockquantity, imageURL, created_at, deleted_at) 
                             VALUES (:product_id, :productname, :descriptions, :categories, :price, :stockquantity, :imageURL, :created_at, NOW())";
            $stmt = $db->prepare($insert_query);
            $stmt->bindParam(':product_id', $product['id'], PDO::PARAM_INT);
            $stmt->bindParam(':productname', $product['productname'], PDO::PARAM_STR);
            $stmt->bindParam(':descriptions', $product['descriptions'], PDO::PARAM_STR);
            $stmt->bindParam(':categories', $product['categories'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $product['price'], PDO::PARAM_STR);
            $stmt->bindParam(':stockquantity', $product['stockquantity'], PDO::PARAM_INT);
            $stmt->bindParam(':imageURL', $product['imageURL'], PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $product['created_at'], PDO::PARAM_STR);
            $stmt->execute();

            // Delete product from the products table
            $delete_query = "DELETE FROM products WHERE id = :id";
            $stmt = $db->prepare($delete_query);
            $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "Product deleted and archived successfully.";
        } else {
            echo "Product not found.";
        }
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}

// Fetch all products for display
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

