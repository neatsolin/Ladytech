<?php
// All PHP processing code remains exactly the same
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
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalPages = 1;
    $currentPage = 1;
    $summary = ['total_orders' => 0, 'delivered' => 0, 'collected' => 0, 'cancelled' => 0, 'total_revenue' => 0, 'completed_count' => 0, 'cash_payments' => 0, 'paid_payments' => 0];
}
?>


    <style>
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .table-custom thead th {
            background-color: #2C4A6B; /* Already set to #2C4A6B */
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 12px;
            border-bottom: none;
        }
        .table-custom tbody tr {
            transition: background-color 0.2s;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table-custom td {
            padding: 12px;
            vertical-align: middle;
            border-top: 1px solid #e9ecef;
        }
        .status-badge {
            padding: 0.4em 0.8em;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .status-pending {
            background-color: #FFF9C4; /* Light yellow for Pending */
            color: #8D6E63; /* Brown text for Pending */
        }
        .status-delivered {
            background-color: #C8E6C9; /* Light green for Delivered */
            color: #388E3C; /* Dark green text for Delivered */
        }
        .status-cancelled {
            background-color: #FFCDD2; /* Light pink for Cancelled */
            color: #D32F2F; /* Red text for Cancelled */
        }
        .status-collected {
            background-color: #C8E6C9; /* Same as Delivered for Collected */
            color: #388E3C;
        }
        .status-default {
            background-color: #E0E0E0; /* Default gray for other statuses */
            color: #424242;
        }
        .payment-text {
            color: #28a745; /* Green color for Payment */
        }
        .avatar {
            object-fit: cover;
            border: 2px solid #e9ecef;
            border-radius: 50%;
        }
        .action-icon-btn {
            border: none;
            background: none;
            padding: 5px;
            font-size: 1.2rem;
            cursor: pointer;
        }
        .action-icon-btn:hover {
            opacity: 0.8;
        }
        /* Custom Filter Button Style */
        .btn-custom-filter {
            background-color: #2C4A6B; /* Match table header color */
            border-color: #2C4A6B;
            color: white;
        }
        .btn-custom-filter:hover {
            background-color: #233a57; /* Slightly darker shade for hover */
            border-color: #233a57;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="bg-white rounded p-4 shadow">
            <h4 class="mb-3">Order History</h4>

            <!-- Tabs remain unchanged -->
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

            <!-- Date Filter with updated button color -->
            <form class="d-flex justify-content-end mb-3" method="GET">
                <input type="hidden" name="tab" value="<?php echo $currentTab; ?>">
                <input type="date" name="start_date" class="form-control w-auto me-2" value="<?php echo $startDate; ?>">
                <input type="date" name="end_date" class="form-control w-auto me-2" value="<?php echo $endDate; ?>">
                <button type="submit" class="btn btn-custom-filter">Filter</button>
            </form>

            <div class="tab-content" id="orderTabsContent">
                <div class="tab-pane fade <?php echo $currentTab === 'all' ? 'show active' : ''; ?>" id="all" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-custom">
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
                            <tbody>
                                <?php if (empty($orders)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">No orders found.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td class="fw-medium text-primary">#<?php echo htmlspecialchars($order['id']); ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo htmlspecialchars($order['user_profile'] ?: 'https://via.placeholder.com/40'); ?>" 
                                                         class="avatar me-2" 
                                                         alt="avatar" 
                                                         width="40" 
                                                         height="40">
                                                    <span class="fw-medium"><?php echo htmlspecialchars($order['username'] ?? 'Unknown'); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="payment-text"><?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?></span>
                                            </td>
                                            <td><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                            <td><?php echo htmlspecialchars($order['ordertype'] ?? 'N/A'); ?></td>
                                            <td>
                                                <span class="status-badge <?php 
                                                    if ($order['orderstatus'] === 'Pending') {
                                                        echo 'status-pending';
                                                    } elseif ($order['orderstatus'] === 'Delivered') {
                                                        echo 'status-delivered';
                                                    } elseif ($order['orderstatus'] === 'Cancelled') {
                                                        echo 'status-cancelled';
                                                    } elseif ($order['orderstatus'] === 'Collected') {
                                                        echo 'status-collected';
                                                    } else {
                                                        echo 'status-default';
                                                    }
                                                ?>">

                                                
                                                    <?php echo htmlspecialchars($order['orderstatus']); ?>
                                                </span>
                                            </td>
                                            <td class="fw-medium text-purple-300">$<?php echo number_format($order['totalprice'], 2); ?></td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="refund_order.php?id=<?php echo $order['id']; ?>" 
                                                       class="action-icon-btn text-warning" 
                                                       title="Refund">
                                                        <i class="bi bi-arrow-return-left"></i>
                                                    </a>
                                                    <a href="message_order.php?id=<?php echo $order['id']; ?>" 
                                                       class="action-icon-btn text-primary" 
                                                       title="Message">
                                                        <i class="bi bi-chat-left-text"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination remains unchanged -->
                    <?php if ($currentTab !== 'summary'): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
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
                <!-- Summary Tab remains unchanged -->
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
                                        <span class="badge status-delivered rounded-pill"><?php echo $summary['delivered']; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Collected
                                        <span class="badge status-collected rounded-pill"><?php echo $summary['collected']; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Cancelled
                                        <span class="badge status-cancelled rounded-pill"><?php echo $summary['cancelled']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Financial Overview</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Revenue (Completed Orders)
                                        <span class="fw-bold">$<?php echo number_format($summary['total_revenue'], 2); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Average Order Value (Completed)
                                        <span class="fw-bold">$<?php echo $summary['completed_count'] > 0 ? number_format($summary['total_revenue'] / $summary['completed_count'], 2) : '0.00'; ?></span>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $conn = null; ?>