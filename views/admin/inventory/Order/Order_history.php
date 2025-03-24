<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pagination settings
    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Date filter
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-1 month'));
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
    $dateFilter = "WHERE o.orderdate BETWEEN :start_date AND :end_date";

    // Tab-specific queries
    $tabs = [
        'all' => "",
        'completed' => "AND o.orderstatus IN ('Delivered', 'Collected')",
        'cancelled' => "AND o.orderstatus = 'Cancelled'"
    ];

    // Current tab
    $currentTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
    $tabFilter = $tabs[$currentTab] ?? "";

    // Total orders for pagination
    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders o LEFT JOIN users u ON o.user_id = u.id $dateFilter $tabFilter");
    $totalStmt->bindValue(':start_date', $startDate);
    $totalStmt->bindValue(':end_date', $endDate . ' 23:59:59');
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();
    $totalPages = ceil($totalOrders / $itemsPerPage);

    // Fetch orders for the current tab and page
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

    // Summary statistics
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
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalPages = 1;
    $currentPage = 1;
    $summary = ['total_orders' => 0, 'delivered' => 0, 'collected' => 0, 'cancelled' => 0, 'total_revenue' => 0, 'completed_count' => 0, 'cash_payments' => 0, 'paid_payments' => 0];
}
?>


    <div class="container my-4">
        <div class="bg-white rounded p-4 shadow">
            <h4 class="mb-3">Order History</h4>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo $currentTab === 'all' ? 'active' : ''; ?>" href="?tab=all&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>" role="tab">All Orders</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo $currentTab === 'summary' ? 'active' : ''; ?>" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" role="tab">Summary</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo $currentTab === 'completed' ? 'active' : ''; ?>" href="?tab=completed&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>" role="tab">Completed</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo $currentTab === 'cancelled' ? 'active' : ''; ?>" href="?tab=cancelled&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>" role="tab">Cancelled</a>
                </li>
            </ul>

            <!-- Date Filter -->
            <form class="d-flex justify-content-end mb-3" method="GET">
                <input type="hidden" name="tab" value="<?php echo $currentTab; ?>">
                <input type="date" name="start_date" class="form-control w-auto me-2" value="<?php echo $startDate; ?>">
                <input type="date" name="end_date" class="form-control w-auto me-2" value="<?php echo $endDate; ?>">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <!-- Tab Content -->
            <div class="tab-content" id="orderTabsContent">
                <!-- All Orders Tab -->
                <div class="tab-pane fade <?php echo $currentTab === 'all' ? 'show active' : ''; ?>" id="all" role="tabpanel">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="all-orders">
                            <?php if (empty($orders)): ?>
                                <tr><td colspan="8" class="text-center">No orders found.</td></tr>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td>
                                            <img src="<?php echo htmlspecialchars($order['user_profile'] ?: 'https://via.placeholder.com/40'); ?>" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                            <?php echo htmlspecialchars($order['username'] ?? 'Unknown'); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td><?php echo htmlspecialchars($order['ordertype'] ?? 'N/A'); ?></td>
                                        <td>
                                            <span class="<?php 
                                                echo $order['orderstatus'] === 'Delivered' ? 'text-warning' : 
                                                     ($order['orderstatus'] === 'Collected' ? 'text-success' : 
                                                     ($order['orderstatus'] === 'Cancelled' ? 'text-danger' : 'text-muted')); 
                                            ?>">● <?php echo htmlspecialchars($order['orderstatus']); ?></span>
                                        </td>
                                        <td>€<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="refund_order.php?id=<?php echo $order['id']; ?>">Refund</a></li>
                                                    <li><a class="dropdown-item" href="message_order.php?id=<?php echo $order['id']; ?>">Message</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <?php if ($currentTab !== 'summary'): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?tab=<?php echo $currentTab; ?>&page=<?php echo $currentPage - 1; ?>&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>">Previous</a>
                                </li>
                                <li class="page-item disabled"><span class="page-link">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span></li>
                                <li class="page-item <?php echo $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?tab=<?php echo $currentTab; ?>&page=<?php echo $currentPage + 1; ?>&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>

                <!-- Summary Tab -->
                <div class="tab-pane fade <?php echo $currentTab === 'summary' ? 'show active' : ''; ?>" id="summary" role="tabpanel">
                    <div class="p-3">
                        <h5 class="mb-3">Order Summary (<?php echo date('m-d-Y', strtotime($startDate)); ?> to <?php echo date('m-d-Y', strtotime($endDate)); ?>)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Order Statistics</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Orders
                                        <span class="badge bg-primary rounded-pill"><?php echo $summary['total_orders']; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Delivered
                                        <span class="badge bg-warning text-dark rounded-pill"><?php echo $summary['delivered']; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Collected
                                        <span class="badge bg-success rounded-pill"><?php echo $summary['collected']; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Cancelled
                                        <span class="badge bg-danger rounded-pill"><?php echo $summary['cancelled']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Financial Overview</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Revenue (Completed Orders)
                                        <span class="fw-bold">€<?php echo number_format($summary['total_revenue'], 2); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Average Order Value (Completed)
                                        <span class="fw-bold">€<?php echo $summary['completed_count'] > 0 ? number_format($summary['total_revenue'] / $summary['completed_count'], 2) : '0.00'; ?></span>
                                    </li>
                                </ul>
                                <h6 class="text-muted mt-3">Payment Methods</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Cash Payments
                                        <span class="badge bg-secondary rounded-pill"><?php echo $summary['cash_payments']; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Paid (Online/Card)
                                        <span class="badge bg-secondary rounded-pill"><?php echo $summary['paid_payments']; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed and Cancelled Tabs use the same data as 'all' with different filters -->
            </div>
        </div>
    </div>



<?php $conn = null; ?>