<?php
// Database connection and processing remains exactly the same
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-1 month'));
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
    $dateFilter = "WHERE o.orderdate BETWEEN :start_date AND :end_date";

    $tabs = [
        'all' => "",
        'completed' => "AND o.orderstatus IN ('Delivered', 'Collected')",
        'cancelled' => "AND o.orderstatus = 'Cancelled'"
    ];

    $currentTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
    $tabFilter = $tabs[$currentTab] ?? "";

    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders o LEFT JOIN users u ON o.user_id = u.id $dateFilter $tabFilter");
    $totalStmt->bindValue(':start_date', $startDate);
    $totalStmt->bindValue(':end_date', $endDate . ' 23:59:59');
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();
    $totalPages = ceil($totalOrders / $itemsPerPage);

    $stmt = $conn->prepare("
        SELECT o.*, u.username, u.profile AS user_profile
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        $dateFilter $tabFilter
        ORDER BY o.orderdate DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':start_date', $startDate);
    $stmt->bindValue(':end_date', $endDate . ' 23:59:59');
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $summaryStmt = $conn->prepare("
        SELECT 
            COUNT(*) as total_orders,
            SUM(CASE WHEN o.orderstatus = 'Delivered' THEN 1 ELSE 0 END) as delivered,
            SUM(CASE WHEN o.orderstatus = 'Collected' THEN 1 ELSE 0 END) as collected,
            SUM(CASE WHEN o.orderstatus = 'Cancelled' THEN 1 ELSE 0 END) as cancelled,
            SUM(CASE WHEN o.orderstatus IN ('Delivered', 'Collected') THEN o.totalprice ELSE 0 END) as total_revenue,
            COUNT(CASE WHEN o.orderstatus IN ('Delivered', 'Collected') THEN 1 END) as completed_count,
            SUM(CASE WHEN o.payments = 'Cash' THEN 1 ELSE 0 END) as cash_payments,
            SUM(CASE WHEN o.payments = 'Paid' THEN 1 ELSE 0 END) as paid_payments
        FROM orders o
        $dateFilter
    ");
    $summaryStmt->bindValue(':start_date', $startDate);
    $summaryStmt->bindValue(':end_date', $endDate . ' 23:59:59');
    $summaryStmt->execute();
    $summary = $summaryStmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalPages = 1;
    $currentPage = 1;
    $summary = ['total_orders' => 0, 'delivered' => 0, 'collected' => 0, 'cancelled' => 0, 'total_revenue' => 0, 'completed_count' => 0, 'cash_payments' => 0, 'paid_payments' => 0];
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    .table-container {
        max-height: 55vh;
        /* Adjusted to medium size */
        overflow-y: auto;

    }


    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #2C4A6B;
    }


    .table-container::-webkit-scrollbar {
        display: none;
    }

    .table-container::-webkit-scrollbar {
        display: none;
    }

    /* Medium-sized table elements */
    .table-md-text th,
    .table-md-text td {
        padding: 0.75rem 1rem;
        font-size: 0.9375rem;
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        font-size: 0.8125rem;/
    }

    .dropdown-item {
        font-size: 0.875rem;
    }

    .user-avatar {
        width: 36px;
        /* Medium avatar */
        height: 36px;
    }

    /* Improved spacing */
    .tab-content {
        margin-top: 1rem;
    }

    /* Better contrast for readability */
    .table-row:hover {
        background-color: #f8fafc;
    }
</style>

<body class="bg-gray-100">
    <div class="container mx-auto my-6 px-4">
        <div class="bg-white rounded-lg p-6 shadow border border-[#2C4A6B]">
            <h4 class="mb-4 font-semibold text-[#2C4A6B] text-xl">Order History</h4>

            <ul class="flex flex-wrap -mb-px" id="orderTabs" role="tablist">
                <li class="mr-1" role="presentation">
                    <a class="inline-flex items-center justify-center p-3 px-4 text-sm font-medium rounded-t-lg transition-all duration-300 ease-in-out
            <?php echo $currentTab === 'all' ?
                'bg-[#2C4A6B] text-white shadow-md' :
                'text-gray-500 hover:text-[#2C4A6B] hover:bg-gray-100 border-b-2 border-transparent hover:border-[#2C4A6B]'; ?>"
                        href="?tab=all&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>"
                        role="tab">
                        <i class="fas fa-list-alt mr-2"></i> All Orders
                    </a>
                </li>
                <li class="mr-1" role="presentation">
                    <a class="inline-flex items-center justify-center p-3 px-4 text-sm font-medium rounded-t-lg transition-all duration-300 ease-in-out
            <?php echo $currentTab === 'summary' ?
                'bg-[#2C4A6B] text-white shadow-md' :
                'text-gray-500 hover:text-[#2C4A6B] hover:bg-gray-100 border-b-2 border-transparent hover:border-[#2C4A6B]'; ?>"
                        href="?tab=summary&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>"
                        role="tab">
                        <i class="fas fa-chart-pie mr-2"></i> Summary
                    </a>
                </li>
                <li class="mr-1" role="presentation">
                    <a class="inline-flex items-center justify-center p-3 px-4 text-sm font-medium rounded-t-lg transition-all duration-300 ease-in-out
            <?php echo $currentTab === 'completed' ?
                'bg-[#2C4A6B] text-white shadow-md' :
                'text-gray-500 hover:text-[#2C4A6B] hover:bg-gray-100 border-b-2 border-transparent hover:border-[#2C4A6B]'; ?>"
                        href="?tab=completed&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>"
                        role="tab">
                        <i class="fas fa-check-circle mr-2"></i> Completed
                    </a>
                </li>
                <li class="mr-1" role="presentation">
                    <a class="inline-flex items-center justify-center p-3 px-4 text-sm font-medium rounded-t-lg transition-all duration-300 ease-in-out
            <?php echo $currentTab === 'cancelled' ?
                'bg-[#2C4A6B] text-white shadow-md' :
                'text-gray-500 hover:text-[#2C4A6B] hover:bg-gray-100 border-b-2 border-transparent hover:border-[#2C4A6B]'; ?>"
                        href="?tab=cancelled&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>"
                        role="tab">
                        <i class="fas fa-times-circle mr-2"></i> Cancelled
                    </a>
                </li>
            </ul>

            <form class="flex justify-end mb-4 mt-4" method="GET">
                <input type="hidden" name="tab" value="<?php echo $currentTab; ?>">
                <input type="date" name="start_date" class="border border-[#2C4A6B] rounded px-3 py-1.5 mr-2 w-auto text-base" value="<?php echo $startDate; ?>">
                <input type="date" name="end_date" class="border border-[#2C4A6B] rounded px-3 py-1.5 mr-2 w-auto text-base" value="<?php echo $endDate; ?>">
                <button type="submit" class="bg-[#2C4A6B] text-white px-4 py-1.5 rounded hover:bg-[#1E3550] transition-colors border border-[#2C4A6B] text-base">Filter</button>
            </form>

            <div class="tab-content" id="orderTabsContent">
                <div class="<?php echo $currentTab === 'all' ? 'block' : 'hidden'; ?>" id="all" role="tabpanel">
                    <div class="table-container">
                    <table class="w-full border-collapse">
    <thead>
        <tr class="bg-[#2C4A6B] text-white sticky-header">
            <th class="p-3 text-left">NO</th>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Payment</th>
            <th class="p-3 text-left">Date & Time</th>
            <th class="p-3 text-left">Type</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Total</th>
            <th class="p-3 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = ($currentPage - 1) * $itemsPerPage + 1;
        foreach ($orders as $order): ?>
            <tr class="hover:bg-gray-50 transition-colors border-b border-gray-200">
                <td class="p-3 font-medium text-blue-500"><?php echo $counter++; ?></td>
                <td class="p-3">
                    <div class="flex items-center">
                        <img src="<?php echo htmlspecialchars($order['user_profile'] ?: 'https://via.placeholder.com/40'); ?>"
                            class="rounded-full mr-3 user-avatar"
                            alt="avatar">
                        <span class="font-medium"><?php echo htmlspecialchars($order['username'] ?? 'Unknown'); ?></span>
                    </div>
                </td>
                <td class="p-3 text-green-600 font-medium"><?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?></td>
                <td class="p-3"><?php echo htmlspecialchars(date('M j, Y H:i', strtotime($order['orderdate']))); ?></td>
                <td class="p-3"><?php echo htmlspecialchars($order['ordertype'] ?? 'N/A'); ?></td>
                <td class="p-3">
                    <span class="status-badge rounded-full font-medium <?php
                        if ($order['orderstatus'] === 'Pending') {
                            echo 'bg-yellow-200 text-yellow-600';
                        } elseif ($order['orderstatus'] === 'Delivered') {
                            echo 'bg-green-200 text-green-600';
                        } elseif ($order['orderstatus'] === 'Cancelled') {
                            echo 'bg-pink-200 text-pink-600';
                        } elseif ($order['orderstatus'] === 'Collected') {
                            echo 'bg-green-200 text-green-600';
                        } else {
                            echo 'bg-pink-200 text-pink-600';
                        }
                    ?>">
                        <?php echo htmlspecialchars($order['orderstatus']); ?>
                    </span>
                </td>
                <td class="p-3 font-medium text-purple-600">$<?php echo number_format($order['totalprice'], 2); ?></td>
                <td class="p-3">
                    <div class="relative inline-block">
                        <button class="text-gray-500 hover:text-gray-700 p-2" onclick="toggleDropdown('dropdown-<?php echo $order['id']; ?>')">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div id="dropdown-<?php echo $order['id']; ?>" class="hidden absolute right-0 z-10 mt-2 w-52 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                            <a href="view_order.php?id=<?php echo $order['id']; ?>" class="block px-3 py-2 hover:bg-gray-100 dropdown-item">
                                <i class="fas fa-eye text-blue-600 mr-2"></i> View
                            </a>
                            <a href="message_order.php?id=<?php echo $order['id']; ?>" class="block px-3 py-2 hover:bg-gray-100 dropdown-item">
                                <i class="fas fa-envelope text-purple-600 mr-2"></i> Message
                            </a>
                            <a href="edit_order.php?id=<?php echo $order['id']; ?>" class="block px-3 py-2 hover:bg-gray-100 dropdown-item">
                                <i class="fas fa-edit text-green-600 mr-2"></i> Edit
                            </a>
                            <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                class="block px-3 py-2 hover:bg-gray-100 dropdown-item"
                                onclick="return confirm('Are you sure you want to delete this order?');">
                                <i class="fas fa-times-circle mr-3 text-lg"></i>  cancel
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                    </div>

                    <?php if ($currentTab !== 'summary' && $totalPages > 1): ?>
                        <nav class="mt-4">
                            <ul class="flex justify-center space-x-2">
                                <li class="<?php echo $currentPage <= 1 ? 'pointer-events-none opacity-50' : ''; ?>">
                                    <a class="px-3 py-1.5 border border-[#2C4A6B] rounded text-base"
                                        href="?tab=<?php echo $currentTab; ?>&page=<?php echo $currentPage - 1; ?>&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>">Previous</a>
                                </li>
                                <li class="px-3 py-1.5 border border-[#2C4A6B] rounded text-base">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></li>
                                <li class="<?php echo $currentPage >= $totalPages ? 'pointer-events-none opacity-50' : ''; ?>">
                                    <a class="px-3 py-1.5 border border-[#2C4A6B] rounded text-base"
                                        href="?tab=<?php echo $currentTab; ?>&page=<?php echo $currentPage + 1; ?>&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>

                <div class="<?php echo $currentTab === 'summary' ? 'block' : 'hidden'; ?>" id="summary" role="tabpanel">
                    <div class="p-4 border border-[#2C4A6B] rounded-lg">
                        <h5 class="mb-4 font-semibold text-[#2C4A6B] text-lg">Order Summary (<?php echo date('m/d/Y', strtotime($startDate)); ?> to <?php echo date('m/d/Y', strtotime($endDate)); ?>)</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h6 class="text-gray-500 mb-3 text-sm">Order Statistics</h6>
                                <ul class="divide-y border border-[#2C4A6B] rounded-lg mb-4 text-base">
                                    <li class="flex justify-between items-center p-3">
                                        Total Orders
                                        <span class="bg-[#2C4A6B] text-white rounded-full px-3 py-1 text-sm"><?php echo $summary['total_orders']; ?></span>
                                    </li>
                                    <li class="flex justify-between items-center p-3">
                                        Delivered
                                        <span class="bg-green-100 text-green-800 rounded-full px-3 py-1 text-sm"><?php echo $summary['delivered']; ?></span>
                                    </li>
                                    <li class="flex justify-between items-center p-3">
                                        Collected
                                        <span class="bg-green-100 text-green-800 rounded-full px-3 py-1 text-sm"><?php echo $summary['collected']; ?></span>
                                    </li>
                                    <li class="flex justify-between items-center p-3">
                                        Cancelled
                                        <span class="bg-pink-100 text-pink-800 rounded-full px-3 py-1 text-sm"><?php echo $summary['cancelled']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="text-gray-500 mb-3 text-sm">Financial Overview</h6>
                                <ul class="divide-y border border-[#2C4A6B] rounded-lg mb-4 text-base">
                                    <li class="flex justify-between items-center p-3">
                                        Total Revenue (Completed Orders)
                                        <span class="text-[#2C4A6B] font-bold">$<?php echo number_format($summary['total_revenue'], 2); ?></span>
                                    </li>
                                    <li class="flex justify-between items-center p-3">
                                        Average Order Value (Completed)
                                        <span class="text-[#2C4A6B] font-bold">$<?php echo $summary['completed_count'] > 0 ? number_format($summary['total_revenue'] / $summary['completed_count'], 2) : '0.00'; ?></span>
                                    </li>
                                </ul>
                                <h6 class="text-gray-500 mb-3 text-sm">Payment Methods</h6>
                                <ul class="divide-y border border-[#2C4A6B] rounded-lg text-base">
                                    <li class="flex justify-between items-center p-3">
                                        Cash Payments
                                        <span class="bg-gray-200 text-gray-800 rounded-full px-3 py-1 text-sm"><?php echo $summary['cash_payments']; ?></span>
                                    </li>
                                    <li class="flex justify-between items-center p-3">
                                        Paid (Online/Card)
                                        <span class="bg-gray-200 text-gray-800 rounded-full px-3 py-1 text-sm"><?php echo $summary['paid_payments']; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');

            allDropdowns.forEach(d => {
                if (d.id !== id) {
                    d.classList.add('hidden');
                }
            });

            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            if (!event.target.matches('[onclick^="toggleDropdown"]') && !event.target.closest('[onclick^="toggleDropdown"]')) {
                const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
    <?php $conn = null; ?>