<?php
// Database connection (unchanged)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all orders with the corresponding product name, user profile, and purchase time
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
        ORDER BY o.id DESC
    ");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
}
?>


    <script src="https://cdn.tailwindcss.com"></script>
   
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-[#2C4A6B] text-white border-b border-gray-200 shadow-sm">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="bg-teal-500 p-3 rounded-full">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-white tracking-tight">Purchase Orders</h2>
                            <p class="text-gray-200 text-sm mt-1 italic">Track and manage your ShopZen inventory with ease.</p>
                        </div>
                    </div>
                    <button class="px-5 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Create Purchase Order
                    </button>
                </div>
            </div>

            <!-- Tabs -->
            <div class="p-4 bg-[#2C4A6B] border-b border-gray-200 shadow-sm">
                <ul class="flex space-x-2 max-w-full justify-center">
                    <li>
                        <button class="tab-btn active px-5 py-2 bg-white text-teal-600 border-t-2 border-teal-500 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-md hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="all">
                            All
                        </button>
                    </li>
                    <li>
                        <button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="draft">
                            Draft
                        </button>
                    </li>
                    <li>
                        <button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="ordered">
                            Ordered
                        </button>
                    </li>
                    <li>
                        <button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="partial">
                            Partial
                        </button>
                    </li>
                    <li>
                        <button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="received">
                            Received
                        </button>
                    </li>
                    <li>
                        <button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="closed">
                            Closed
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Search and Filter -->
            <div class="p-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" class="h-5 w-5 text-teal-600">
                    <div class="relative">
                        <input type="text" id="search" placeholder="Search orders..." class="pl-10 pr-4 py-2 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"><i class="fas fa-chevron-left"></i></button>
                    <span class="text-gray-600">1/1</span>
                    <button class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"><i class="fas fa-chevron-right"></i></button>
                    <button class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"><i class="fas fa-ellipsis-v"></i></button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="p-4">
                <!-- All Tab -->
                <div id="all" class="tab-content">
                    <table class="min-w-full">
                        <thead class="bg-[#2C4A6B] text-white">
                            <tr>
                                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Purchase Order</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Profile User</th>
                                <th class="py-3 px-2 w-24 text-left text-xs font-semibold uppercase tracking-wider">Destination</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Received</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Purchase Time</th>
                                <th class="py-3 px-2 w-28 text-left text-xs font-semibold uppercase tracking-wider">Expected Arrival</th>
                                <th class="py-3 px-2 w-16 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="11" class="py-4 px-2 text-center text-sm text-gray-600">No orders available.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($orders as $index => $order): ?>
                                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate">#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                    class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                                            <?php
                                            $statuses = [
                                                'Draft' => 'bg-gray-200 text-gray-800',
                                                'Pending' => 'bg-yellow-200 text-yellow-800', // Yellow
                                                'Ordered' => 'bg-blue-200 text-blue-800', // Light blue
                                                'Partial' => 'bg-blue-200 text-blue-800',
                                                'Received' => 'bg-pink-200 text-pink-800', // Pink
                                                'Delivered' => 'bg-green-200 text-green-800', // Green for Delivered
                                                'Closed' => 'bg-gray-400 text-gray-800',
                                                'Canceled' => 'bg-red-300 text-red-800', // Red for canceled
                                            ];

                                            // Default to gray if status is not found
                                            $class = $statuses[$order['orderstatus']] ?? 'bg-gray-300 text-gray-900';
                                            ?>

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?= $class ?>">
                                                <?= htmlspecialchars($order['orderstatus']) ?>
                                            </span>


                                        </td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100"
                                                onclick="toggleDropdown('dropdown-all-<?php echo $order['id']; ?>')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div id="dropdown-all-<?php echo $order['id']; ?>"
                                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">

                                                <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                                    <i class="fas fa-eye mr-3 text-lg"></i> View
                                                </a>

                                                <a href="edit_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition-colors duration-200">
                                                    <i class="fas fa-edit mr-3 text-lg"></i> Edit
                                                </a>

                                                <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 transition-colors duration-200">
                                                    <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                                </a>

                                                <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                                    <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Draft Tab -->
                <div id="draft" class="tab-content hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#2C4A6B] text-white">
                            <tr>
                                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Purchase Order</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Profile User</th>
                                <th class="py-3 px-2 w-24 text-left text-xs font-semibold uppercase tracking-wider">Destination</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Received</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Purchase Time</th>
                                <th class="py-3 px-2 w-28 text-left text-xs font-semibold uppercase tracking-wider">Expected Arrival</th>
                                <th class="py-3 px-2 w-16 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php
                            $draftOrders = array_filter($orders, function ($order) {
                                return $order['orderstatus'] === 'Draft';
                            });
                            if (empty($draftOrders)):
                            ?>
                                <tr>
                                    <td colspan="11" class="py-4 px-2 text-center text-sm text-gray-600">No draft orders available.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($draftOrders as $index => $order): ?>
                                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate">#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                    class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                                            <?php
                                            $statuses = [
                                                'Draft' => 'bg-gray-200 text-gray-800',
                                                'Pending' => 'bg-yellow-200 text-yellow-800', // Yellow
                                                'Ordered' => 'bg-blue-200 text-blue-800', // Light blue
                                                'Partial' => 'bg-blue-200 text-blue-800',
                                                'Received' => 'bg-pink-200 text-pink-800', // Pink
                                                'Delivered' => 'bg-green-200 text-green-800', // Green for Delivered
                                                'Closed' => 'bg-gray-400 text-gray-800',
                                                'Canceled' => 'bg-red-300 text-red-800', // Red for canceled
                                            ];

                                            // Default to gray if status is not found
                                            $class = $statuses[$order['orderstatus']] ?? 'bg-gray-300 text-gray-900';
                                            ?>

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?= $class ?>">
                                                <?= htmlspecialchars($order['orderstatus']) ?>
                                            </span>



                                        </td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100"
                                                onclick="toggleDropdown('dropdown-draft-<?php echo $order['id']; ?>')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div id="dropdown-draft-<?php echo $order['id']; ?>" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                                                <a href="view_order.php?id=<?php echo $order['id']; ?>" class="flex items-center px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                                                    <i class="fas fa-eye mr-2 text-blue-600  text-2xl"></i> View
                                                </a>
                                                <a href="edit_order.php?id=<?php echo $order['id']; ?>" class="flex items-center px-4 py-2 text-sm hover:bg-green-50">
                                                    <i class="fas fa-edit mr-2 text-green-600 text-2xl"></i> Edit
                                                </a>
                                                <a href="message_order.php?id=<?php echo $order['id']; ?>" class="flex items-center px-4 py-2 text-sm  hover:bg-purple-50">
                                                    <i class="fas fa-envelope mr-2 text-purple-600 text-2xl"></i> Message
                                                </a>
                                                <a href="delete_order.php?id=<?php echo $order['id']; ?>" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50" onclick="return confirm('Are you sure you want to delete this order?');">
                                                    <i class="fas fa-trash mr-2 text-red-600 text-2xl"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Ordered Tab -->
                <div id="ordered" class="tab-content hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#2C4A6B] text-white">
                            <tr>
                                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Purchase Order</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Profile User</th>
                                <th class="py-3 px-2 w-24 text-left text-xs font-semibold uppercase tracking-wider">Destination</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Received</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Purchase Time</th>
                                <th class="py-3 px-2 w-28 text-left text-xs font-semibold uppercase tracking-wider">Expected Arrival</th>
                                <th class="py-3 px-2 w-16 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php
                            $orderedOrders = array_filter($orders, function ($order) {
                                return $order['orderstatus'] === 'Pending' || $order['orderstatus'] === 'Ordered';
                            });
                            if (empty($orderedOrders)):
                            ?>
                                <tr>
                                    <td colspan="11" class="py-4 px-2 text-center text-sm text-gray-600">No ordered orders available.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($orderedOrders as $index => $order): ?>
                                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate">#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                    class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                                            <?php
                                            $statuses = [
                                                'Draft' => 'bg-gray-200 text-gray-800',
                                                'Pending' => 'bg-yellow-200 text-yellow-800', // Lighter yellow
                                                'Ordered' => 'bg-blue-200 text-blue-800', // Light sea blue
                                                'Partial' => 'bg-blue-200 text-blue-800',
                                                'Received' => 'bg-pink-300 text-pink-800', // Pink color
                                                'Closed' => 'bg-pink-200 text-pink-800'
                                            ];

                                            // Default to green if status is not found
                                            $class = $statuses[$order['orderstatus']] ?? 'bg-green-300 text-green-800';
                                            ?>

                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium truncate <?= $class ?>">
                                                <?= htmlspecialchars($order['orderstatus']) ?>
                                            </span>

                                        </td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100"
                                                onclick="toggleDropdown('dropdown-ordered-<?php echo $order['id']; ?>')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <div id="dropdown-ordered-<?php echo $order['id']; ?>"
                                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">

                                                <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                                    <i class="fas fa-eye mr-3 text-lg"></i> View
                                                </a>

                                                <a href="edit_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition-colors duration-200">
                                                    <i class="fas fa-edit mr-3 text-lg"></i> Edit
                                                </a>

                                                <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 transition-colors duration-200">
                                                    <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                                </a>

                                                <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                                    <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Partial Tab -->
                <div id="partial" class="tab-content hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#2C4A6B] text-white">
                            <tr>
                                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Purchase Order</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Profile User</th>
                                <th class="py-3 px-2 w-24 text-left text-xs font-semibold uppercase tracking-wider">Destination</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Received</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Purchase Time</th>
                                <th class="py-3 px-2 w-28 text-left text-xs font-semibold uppercase tracking-wider">Expected Arrival</th>
                                <th class="py-3 px-2 w-16 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php
                            $partialOrders = array_filter($orders, function ($order) {
                                return $order['orderstatus'] === 'Partial';
                            });
                            if (empty($partialOrders)):
                            ?>
                                <tr>
                                    <td colspan="11" class="py-4 px-2 text-center text-sm text-gray-600">No partial orders available.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($partialOrders as $index => $order): ?>
                                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate">#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                    class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium truncate <?php
                                                                                                                                        echo $order['orderstatus'] === 'Draft' ? 'bg-gray-200 text-gray-800' : ($order['orderstatus'] === 'Pending' || $order['orderstatus'] === 'Ordered' ? 'bg-yellow-300 text-yellow-800' : ($order['orderstatus'] === 'Partial' ? 'bg-blue-200 text-blue-800' : ($order['orderstatus'] === 'Received' ? 'bg-green-300 text-green-800' : ($order['orderstatus'] === 'Closed' ? 'bg-pink-200 text-pink-800' : 'bg-gray-200 text-gray-800'))));
                                                                                                                                        ?>">
                                                <?php echo htmlspecialchars($order['orderstatus']); ?>
                                            </span>
                                        </td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100"
                                                onclick="toggleDropdown('dropdown-partial-<?php echo $order['id']; ?>')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div id="dropdown-partial-<?php echo $order['id']; ?>"
                                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">

                                                <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                                    <i class="fas fa-eye mr-3 text-lg"></i> View
                                                </a>

                                                <a href="edit_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition-colors duration-200">
                                                    <i class="fas fa-edit mr-3 text-lg"></i> Edit
                                                </a>

                                                <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 transition-colors duration-200">
                                                    <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                                </a>

                                                <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                                    <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                                </a>
                                            </div>

                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Received Tab -->
                <div id="received" class="tab-content hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#2C4A6B] text-white">
                            <tr>
                                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Purchase Order</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Profile User</th>
                                <th class="py-3 px-2 w-24 text-left text-xs font-semibold uppercase tracking-wider">Destination</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Received</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Purchase Time</th>
                                <th class="py-3 px-2 w-28 text-left text-xs font-semibold uppercase tracking-wider">Expected Arrival</th>
                                <th class="py-3 px-2 w-16 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php
                            $receivedOrders = array_filter($orders, function ($order) {
                                return $order['orderstatus'] === 'Received';
                            });
                            if (empty($receivedOrders)):
                            ?>
                                <tr>
                                    <td colspan="11" class="py-4 px-2 text-center text-sm text-gray-600">No received orders available.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($receivedOrders as $index => $order): ?>
                                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate">#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                    class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium truncate <?php
                                                                                                                                        echo $order['orderstatus'] === 'Draft' ? 'bg-gray-200 text-gray-800' : ($order['orderstatus'] === 'Pending' || $order['orderstatus'] === 'Ordered' ? 'bg-yellow-300 text-yellow-800' : ($order['orderstatus'] === 'Partial' ? 'bg-blue-200 text-blue-800' : ($order['orderstatus'] === 'Received' ? 'bg-green-300 text-green-800' : ($order['orderstatus'] === 'Closed' ? 'bg-pink-200 text-pink-800' : 'bg-gray-200 text-gray-800'))));
                                                                                                                                        ?>">
                                                <?php echo htmlspecialchars($order['orderstatus']); ?>
                                            </span>
                                        </td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100"
                                                onclick="toggleDropdown('dropdown-received-<?php echo $order['id']; ?>')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                           
                                                <div id="dropdown-received-<?php echo $order['id']; ?>"
                                                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">

                                                    <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                        class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                                        <i class="fas fa-eye mr-3 text-lg"></i> View
                                                    </a>

                                                    <a href="edit_order.php?id=<?php echo $order['id']; ?>"
                                                        class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition-colors duration-200">
                                                        <i class="fas fa-edit mr-3 text-lg"></i> Edit
                                                    </a>

                                                    <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                        class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 transition-colors duration-200">
                                                        <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                                    </a>

                                                    <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                                        class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to delete this order?');">
                                                        <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                                    </a>
                                                </div>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Draft Tab -->
                <div id="draft" class="tab-content hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#2C4A6B] text-white">
                            <tr>
                                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Purchase Order</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Profile User</th>
                                <th class="py-3 px-2 w-24 text-left text-xs font-semibold uppercase tracking-wider">Destination</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Received</th>
                                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Purchase Time</th>
                                <th class="py-3 px-2 w-28 text-left text-xs font-semibold uppercase tracking-wider">Expected Arrival</th>
                                <th class="py-3 px-2 w-16 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php
                            $draftOrders = array_filter($orders, function ($order) {
                                return $order['orderstatus'] === 'Draft';
                            });
                            if (empty($draftOrders)):
                            ?>
                                <tr>
                                    <td colspan="11" class="py-4 px-2 text-center text-sm text-gray-600">No draft orders available.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($draftOrders as $index => $order): ?>
                                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate">#<?php echo htmlspecialchars($order['id']); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                    class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium truncate bg-gray-200 text-gray-800">
                                                <?php echo htmlspecialchars($order['orderstatus']); ?>
                                            </span>
                                        </td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100"
                                                onclick="toggleDropdown('dropdown-draft-<?php echo $order['id']; ?>')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div id="dropdown-draft-<?php echo $order['id']; ?>"
                                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">

                                                <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                                    <i class="fas fa-eye mr-3 text-lg"></i> View
                                                </a>

                                                <a href="edit_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition-colors duration-200">
                                                    <i class="fas fa-edit mr-3 text-lg"></i> Edit
                                                </a>

                                                <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 transition-colors duration-200">
                                                    <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                                </a>

                                                <a href="delete_order.php?id=<?php echo $order['id']; ?>"
                                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                                    <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    // Tab Switching
                    const tabButtons = document.querySelectorAll('.tab-btn');
                    const tabContents = document.querySelectorAll('.tab-content');

                    tabButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            tabButtons.forEach(btn => {
                                btn.classList.remove('active', 'text-teal-600', 'border-t-2', 'border-teal-500', 'shadow-md');
                                btn.classList.add('text-gray-600', 'shadow-sm');
                            });
                            button.classList.add('active', 'text-teal-600', 'border-t-2', 'border-teal-500', 'shadow-md');
                            button.classList.remove('text-gray-600', 'shadow-sm');

                            tabContents.forEach(content => content.classList.add('hidden'));
                            document.getElementById(button.getAttribute('data-tab')).classList.remove('hidden');
                        });
                    });

                    // Search Functionality
                    document.getElementById("search").addEventListener("input", function() {
                        let filter = this.value.toLowerCase();
                        let rows = document.querySelectorAll(".tab-content:not(.hidden) tbody tr");
                        rows.forEach(row => {
                            let text = row.innerText.toLowerCase();
                            row.style.display = text.includes(filter) ? "" : "none";
                        });
                    });

                    // Dropdown Toggle
                    function toggleDropdown(id) {
                        const dropdowns = document.querySelectorAll("[id^='dropdown-']");
                        dropdowns.forEach(dropdown => {
                            if (dropdown.id !== id) {
                                dropdown.classList.add("hidden");
                            }
                        });
                        const dropdown = document.getElementById(id);
                        dropdown.classList.toggle("hidden");
                    }

                    document.addEventListener("click", function(event) {
                        const dropdowns = document.querySelectorAll("[id^='dropdown-']");
                        dropdowns.forEach(dropdown => {
                            if (!dropdown.contains(event.target) && !event.target.closest("button")) {
                                dropdown.classList.add("hidden");
                            }
                        });
                    });
                </script>

<?php $conn = null; ?>