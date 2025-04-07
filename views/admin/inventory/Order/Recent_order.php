<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle cancel action
    if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id'])) {
        $orderId = $_GET['id'];
        $stmt = $conn->prepare("UPDATE orders SET orderstatus = 'Cancelled' WHERE id = :id");
        $stmt->bindParam(':id', $orderId);
        $stmt->execute();
        
        // Return JSON response for AJAX
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit();
        }
    }

    // Pagination settings
    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Define "today" range (last 24 hours)
    $todayStart = date('Y-m-d H:i:s', strtotime('-24 hours'));

    // Get total number of recent orders (within 24 hours)
    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE orderdate >= :todayStart");
    $totalStmt->bindValue(':todayStart', $todayStart);
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();
    $totalPages = ceil($totalOrders / $itemsPerPage);

    // Fetch recent orders for the current page (sorted by oldest first)
    $stmt = $conn->prepare("
        SELECT o.*, u.username, u.profile AS user_profile, u.phone
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        WHERE o.orderdate >= :todayStart
        ORDER BY o.orderdate ASC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':todayStart', $todayStart);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalPages = 1;
    $currentPage = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .table-container {
            max-height: 60vh;
            overflow-y: auto;
        }
        .sticky-header thead th {
            position: sticky;
            top: 0;
            background-color: #2C4A6B;
        }
        .status-pending {
            background-color: #fef9c3;
            color: #b45309;
        }
        .status-delivered {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-cancelled {
            background-color: #f3f4f6;
            color: #6b7280;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .flash-red {
            animation: redFlash 0.5s ease-in-out;
        }
        @keyframes redFlash {
            0%, 100% { background-color: inherit; }
            50% { background-color: #fee2e2; }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-white text-black border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Recent Orders (Today)</h2>
                    <div class="relative">
                        <input type="text" id="search"
                            placeholder="Search orders..."
                            class="pl-10 pr-4 py-2 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        <i class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</i>
                    </div>
                </div>
            </div>

            <!-- Orders Table with sticky header -->
            <div class="table-container">
                <table class="w-full sticky-header">
                    <thead class="text-white">
                        <tr>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Phone</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Customer</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Payment</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Time</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Total</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody id="order-list" class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="8" class="py-6 px-6 text-center text-gray-600 text-lg">No orders from today.</td>
                            </tr>
                        <?php else: ?>
                            <?php $rowNumber = ($currentPage - 1) * $itemsPerPage + 1; ?>
                            <?php foreach ($orders as $index => $order): ?>
                                <tr id="order-row-<?= $order['id'] ?>" class="<?= $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' ?> hover:bg-teal-50 transition">
                                    <td class="py-4 px-6 text-blue-600 font-medium"><?= $rowNumber ?></td>
                                    <td class="py-4 px-6 text-gray-800 font-medium"><?= htmlspecialchars($order['phone'] ?? 'N/A') ?></td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <img src="<?= htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40') ?>"
                                                class="w-10 h-10 rounded-full mr-3 border-2 border-purple-300" alt="Profile">
                                            <span class="text-gray-800 font-medium"><?= htmlspecialchars($order['username'] ?? 'Unknown Customer') ?></span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-green-600"><?= htmlspecialchars($order['payments'] ?? 'N/A') ?></td>
                                    <td class="py-4 px-6 text-gray-700"><?= htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))) ?></td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            <?= $order['orderstatus'] === 'Delivered' ? 'status-delivered' : 
                                               ($order['orderstatus'] === 'Pending' ? 'status-pending' : 'status-cancelled') ?>">
                                            <?= htmlspecialchars($order['orderstatus']) ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-purple-600 font-semibold">$<?= number_format($order['totalprice'], 2) ?></td>
                                    <td class="py-4 px-6 relative text-center">
                                        <div class="dropdown inline-block">
                                            <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white z-50">
                                                <a href="view_order.php?id=<?= $order['id'] ?>" 
                                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                    <i class="material-icons align-middle text-blue-500">visibility</i>
                                                    <span class="ml-2">View Details</span>
                                                </a>
                                                <a href="message_order.php?id=<?= $order['id'] ?>" 
                                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                    <i class="material-icons align-middle text-green-500">email</i>
                                                    <span class="ml-2">Message</span>
                                                </a>
                                                <?php if ($order['orderstatus'] !== 'Cancelled'): ?>
                                                    <a href="track_order.php?id=<?= $order['id'] ?>" 
                                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="material-icons align-middle text-yellow-500">edit</i>
                                                        <span class="ml-2">Edit</span>
                                                    </a>
                                                    <a href="#" class="cancel-order block px-4 py-2 text-red-700 hover:bg-red-50" 
                                                       data-id="<?= $order['id'] ?>">
                                                        <i class="material-icons align-middle">cancel</i>
                                                        <span class="ml-2">Cancel</span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $rowNumber++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 bg-gray-50 flex justify-between items-center">
                <a href="?page=<?= $currentPage > 1 ? $currentPage - 1 : 1 ?>" 
                   class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                    Previous
                </a>
                <span class="text-gray-700 font-medium">
                    Page <?= $currentPage ?> of <?= $totalPages ?>
                </span>
                <a href="?page=<?= $currentPage < $totalPages ? $currentPage + 1 : $totalPages ?>" 
                   class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                    Next
                </a>
            </div>
        </div>
    </div>

   <?php
// In your controller:
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['id'])) {
    try {
        $orderModel = new OrderModel();
        $success = $orderModel->cancelOrder($_GET['id']);
        
        if ($success) {
            // Return JSON response for AJAX
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit();
            }
            
            // Redirect for non-AJAX requests
            header("Location: /orders?cancel_success=1");
            exit();
        }
    } catch (Exception $e) {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit();
        }
        
        $_SESSION['error'] = $e->getMessage();
        header("Location: /orders");
        exit();
    }
}
?>

<!-- In your view (HTML/JS part): -->
<script>
document.querySelectorAll('.cancel-order').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const orderId = this.getAttribute('data-id');
        const row = document.getElementById(`order-row-${orderId}`);
        
        // Highlight row
        row.classList.add('bg-red-50');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This order will be cancelled and moved to cancelled orders!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/orders?action=cancel&id=${orderId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Fade out and remove row
                        row.style.transition = 'opacity 0.5s';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 500);
                        
                        Swal.fire(
                            'Cancelled!',
                            'The order has been cancelled.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            data.message || 'Failed to cancel order',
                            'error'
                        );
                        row.classList.remove('bg-red-50');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Failed to cancel order',
                        'error'
                    );
                    row.classList.remove('bg-red-50');
                });
            } else {
                row.classList.remove('bg-red-50');
            }
        });
    });
});
</script>

<?php $conn = null; ?>

