<?php
// Database connection (adjust these details based on your setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch all orders with the corresponding product name and user profile
    $stmt = $conn->prepare("
        SELECT o.*, 
               (SELECT p.productname 
                FROM products p 
                JOIN orderitems oi ON p.id = oi.product_id 
                WHERE oi.order_id = o.id 
                LIMIT 1) AS product_name, 
               u.username, 
               u.profile AS user_profile 
        FROM orders o 
        LEFT JOIN users u ON o.user_id = u.id
    ");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = []; // Fallback to empty array if query fails
}
?>

<div class="container my-4">
    <div class="bg-white rounded p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4>Purchase Orders</h4>
                <p class="text-muted">The inventory section on the ShopZen page provides a snapshot of product availability.</p>
            </div>
            <button class="btn btn-primary">Create Purchase Order</button>
        </div>
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">Draft</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ordered-tab" data-bs-toggle="tab" data-bs-target="#ordered" type="button" role="tab" aria-controls="ordered" aria-selected="false">Ordered</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="partial-tab" data-bs-toggle="tab" data-bs-target="#partial" type="button" role="tab" aria-controls="partial" aria-selected="false">Partial</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button" role="tab" aria-controls="received" aria-selected="false">Received</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="closed-tab" data-bs-toggle="tab" data-bs-target="#closed" type="button" role="tab" aria-controls="closed" aria-selected="false">Closed</button>
            </li>
        </ul>
        <!-- Search and Filter -->
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-center">
                <input type="checkbox" class="form-check-input me-2">
                <div class="input-group w-auto">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <button class="btn btn-outline-secondary ms-2" type="button">
                    <i class="bi bi-funnel"></i>
                </button>
                <button class="btn btn-outline-secondary ms-2" type="button">
                    <i class="bi bi-plus"></i> Add
                </button>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-2" type="button">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <span class="text-muted">1/1</span>
                <button class="btn btn-outline-secondary ms-2" type="button">
                    <i class="bi bi-chevron-right"></i>
                </button>
                <button class="btn btn-outline-secondary ms-2" type="button">
                    <i class="bi bi-three-dots"></i>
                </button>
            </div>
        </div>
        <!-- Tab Content -->
        <div class="tab-content" id="orderTabsContent">
            <!-- All Tab -->
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase order</th>
                            <th>Product Name</th>
                            <th>Profile User</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Total</th>
                            <th>Expected arrival</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input"></td>
                                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                    <td>
                                        <?php if (!empty($order['user_profile'])): ?>
                                            <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>
                                    </td>
                                    <td>Location <?php echo htmlspecialchars($order['location_id']); ?></td>
                                    <td>
                                        <span class="<?php echo $order['orderstatus'] === 'Pending' ? 'text-warning' : 'text-muted'; ?>">
                                            ● <?php echo htmlspecialchars($order['orderstatus']); ?>
                                        </span>
                                    </td>
                                    <td>N/A</td>
                                    <td><?php echo htmlspecialchars($order['payments'] . ' ' . number_format($order['totalprice'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Draft Tab -->
            <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase order</th>
                            <th>Product Name</th>
                            <th>Profile User</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Total</th>
                            <th>Expected arrival</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $draftOrders = array_filter($orders, function($order) {
                            return $order['orderstatus'] === 'Draft';
                        });
                        if (empty($draftOrders)):
                        ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No draft orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($draftOrders as $order): ?>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input"></td>
                                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                    <td>
                                        <?php if (!empty($order['user_profile'])): ?>
                                            <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>
                                    </td>
                                    <td>Location <?php echo htmlspecialchars($order['location_id']); ?></td>
                                    <td><span class="text-muted">● <?php echo htmlspecialchars($order['orderstatus']); ?></span></td>
                                    <td>N/A</td>
                                    <td><?php echo htmlspecialchars($order['payments'] . ' ' . number_format($order['totalprice'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Ordered Tab -->
            <div class="tab-pane fade" id="ordered" role="tabpanel" aria-labelledby="ordered-tab">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase order</th>
                            <th>Product Name</th>
                            <th>Profile User</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Total</th>
                            <th>Expected arrival</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orderedOrders = array_filter($orders, function($order) {
                            return $order['orderstatus'] === 'Pending' || $order['orderstatus'] === 'Ordered';
                        });
                        if (empty($orderedOrders)):
                        ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No ordered orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orderedOrders as $order): ?>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input"></td>
                                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                    <td>
                                        <?php if (!empty($order['user_profile'])): ?>
                                            <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>
                                    </td>
                                    <td>Location <?php echo htmlspecialchars($order['location_id']); ?></td>
                                    <td><span class="text-warning">● <?php echo htmlspecialchars($order['orderstatus']); ?></span></td>
                                    <td>N/A</td>
                                    <td><?php echo htmlspecialchars($order['payments'] . ' ' . number_format($order['totalprice'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Partial Tab -->
            <div class="tab-pane fade" id="partial" role="tabpanel" aria-labelledby="partial-tab">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase order</th>
                            <th>Product Name</th>
                            <th>Profile User</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Total</th>
                            <th>Expected arrival</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $partialOrders = array_filter($orders, function($order) {
                            return $order['orderstatus'] === 'Partial';
                        });
                        if (empty($partialOrders)):
                        ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No partial orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($partialOrders as $order): ?>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input"></td>
                                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                    <td>
                                        <?php if (!empty($order['user_profile'])): ?>
                                            <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>
                                    </td>
                                    <td>Location <?php echo htmlspecialchars($order['location_id']); ?></td>
                                    <td><span class="text-info">● <?php echo htmlspecialchars($order['orderstatus']); ?></span></td>
                                    <td>N/A</td>
                                    <td><?php echo htmlspecialchars($order['payments'] . ' ' . number_format($order['totalprice'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Received Tab -->
            <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="received-tab">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase order</th>
                            <th>Product Name</th>
                            <th>Profile User</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Total</th>
                            <th>Expected arrival</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $receivedOrders = array_filter($orders, function($order) {
                            return $order['orderstatus'] === 'Received';
                        });
                        if (empty($receivedOrders)):
                        ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No received orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($receivedOrders as $order): ?>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input"></td>
                                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                    <td>
                                        <?php if (!empty($order['user_profile'])): ?>
                                            <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>
                                    </td>
                                    <td>Location <?php echo htmlspecialchars($order['location_id']); ?></td>
                                    <td><span class="text-success">● <?php echo htmlspecialchars($order['orderstatus']); ?></span></td>
                                    <td>N/A</td>
                                    <td><?php echo htmlspecialchars($order['payments'] . ' ' . number_format($order['totalprice'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Closed Tab -->
            <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase order</th>
                            <th>Product Name</th>
                            <th>Profile User</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Total</th>
                            <th>Expected arrival</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $closedOrders = array_filter($orders, function($order) {
                            return $order['orderstatus'] === 'Closed';
                        });
                        if (empty($closedOrders)):
                        ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No closed orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($closedOrders as $order): ?>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input"></td>
                                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                    <td>
                                        <?php if (!empty($order['user_profile'])): ?>
                                            <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>
                                    </td>
                                    <td>Location <?php echo htmlspecialchars($order['location_id']); ?></td>
                                    <td><span class="text-danger">● <?php echo htmlspecialchars($order['orderstatus']); ?></span></td>
                                    <td>N/A</td>
                                    <td><?php echo htmlspecialchars($order['payments'] . ' ' . number_format($order['totalprice'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Close the database connection
$conn = null;
?>