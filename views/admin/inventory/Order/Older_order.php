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

    // Define "older" range (older than 24 hours)
    $todayStart = date('Y-m-d H:i:s', strtotime('-24 hours'));

    // Get total number of older orders
    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE orderdate < :todayStart");
    $totalStmt->bindValue(':todayStart', $todayStart);
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();
    $totalPages = ceil($totalOrders / $itemsPerPage);

    // Fetch older orders for the current page
    $stmt = $conn->prepare("
        SELECT o.*, u.username, u.profile AS user_profile, u.phone
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        WHERE o.orderdate < :todayStart
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


<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* Custom scrollbar */
    .scrollable-table {
        max-height: 60vh;
        overflow-y: scroll;
    }

    /* Make scrollbar always visible */
    .scrollable-table::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 10px;
    }

    /* Sticky header */
    .sticky-header thead tr th {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #2C4A6B;
    }
</style>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-white text-black border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Older Orders</h2>
                    <div class="relative">
                        <input type="text" id="search"
                            placeholder="Search orders..."
                            class="pl-10 pr-4 py-2 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="scrollable-table">
                <table class="w-full sticky-header">
                    <thead class="bg-[#2C4A6B] text-white">
                        <tr>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Phone</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Customer</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Payment</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Date</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Total</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody id="older-orders" class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="8" class="py-6 px-6 text-center text-gray-600 text-lg">No older orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php $rowNumber = ($currentPage - 1) * $itemsPerPage + 1; ?>
                            <?php foreach ($orders as $index => $order): ?>
                                <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition">
                                    <td class="py-4 px-6 text-blue-600 font-medium"><?php echo $rowNumber; ?></td>
                                    <td class="py-4 px-6 text-gray-800 font-medium"><?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>"
                                                class="w-10 h-10 rounded-full mr-3 border-2 border-purple-300" alt="Profile">
                                            <span class="text-gray-800 font-medium"><?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-green-600"><?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?></td>
                                    <td class="py-4 px-6 text-gray-700"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php
                                                                                                                            echo $order['orderstatus'] === 'Delivered' ? 'bg-green-200 text-green-800' : ($order['orderstatus'] === 'Pending' ? 'bg-yellow-200 text-yellow-800' :
                                                                                                                                    'bg-red-200 text-red-800');
                                                                                                                            ?>">
                                            <?php echo htmlspecialchars($order['orderstatus']); ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-purple-600 font-semibold">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                    <td class="py-4 px-6 relative">
                                        <button class="text-gray-600 hover:text-teal-600 transition text-xl p-2 rounded-full hover:bg-gray-100"
                                            onclick="toggleDropdown('dropdown-<?php echo $order['id']; ?>')">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div id="dropdown-<?php echo $order['id']; ?>"
                                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                                            <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50">
                                                <i class="fas fa-eye mr-3 text-lg"></i> View Details
                                            </a>
                                            <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50">
                                                <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                            </a>
                                            <a href="track_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50">
                                                <i class="fas fa-pen mr-3 text-lg"></i> Edit
                                            </a>
                                            <a href="detail_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-times-circle mr-3 text-lg"></i> Cancel
                                            </a>
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
                <a href="?page=<?php echo $currentPage > 1 ? $currentPage - 1 : 1; ?>"
                    class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition <?php echo $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                    Previous
                </a>
                <span class="text-gray-700 font-medium">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
                <a href="?page=<?php echo $currentPage < $totalPages ? $currentPage + 1 : $totalPages; ?>"
                    class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition <?php echo $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                    Next
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById("search").addEventListener("input", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#older-orders tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        function toggleDropdown(id) {
            // Close all dropdowns first
            const dropdowns = document.querySelectorAll("[id^='dropdown-']");
            dropdowns.forEach(dropdown => {
                if (dropdown.id !== id) {
                    dropdown.classList.add("hidden");
                }
            });

            // Toggle the clicked dropdown
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