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
        ORDER BY o.orderdate DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':todayStart', $todayStart);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalPages = 1;
    $currentPage = 1;
}
?>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Older Orders</h2>
            <input type="text" id="search" placeholder="Search orders..." class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Orders Table -->
        <div class="overflow-y-auto max-h-[450px] scrollbar-hide">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 sticky top-0 z-10">
                    <tr>
                        <th class="py-2 px-4 text-left">Phone</th>
                        <th class="py-2 px-4 text-left">Customer</th>
                        <th class="py-2 px-4 text-left">Payment</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Status</th>
                        <th class="py-2 px-4 text-left">Total</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="older-orders">
                    <?php if (empty($orders)): ?>
                        <tr class="border-t">
                            <td colspan="7" class="py-2 px-4 text-center text-gray-500">No older orders available.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr class="border-t hover:bg-gray-100 transition">
                                <td class="py-2 px-4"><?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></td>
                                <td class="py-2 px-4 flex items-center gap-2">
                                    <?php if (!empty($order['user_profile'])): ?>
                                        <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" class="w-8 h-8 rounded-full" alt="Profile">
                                    <?php else: ?>
                                        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" alt="Default Profile">
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?>
                                </td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                <td class="py-2 px-4">
                                    <span class="<?php 
                                        echo $order['orderstatus'] === 'Delivered' ? 'bg-green-100 text-green-600' : 
                                             ($order['orderstatus'] === 'Cancelled' ? 'bg-red-100 text-red-600' : 
                                             'bg-gray-100 text-gray-600'); 
                                    ?> px-2 py-1 text-xs font-semibold rounded-full">
                                        <?php echo htmlspecialchars($order['orderstatus']); ?>
                                    </span>
                                </td>
                                <td class="py-2 px-4">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                <td class="py-2 px-4 relative">
                                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown-<?php echo $order['id']; ?>')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01"></path>
                                        </svg>
                                    </button>
                                    <div id="dropdown-<?php echo $order['id']; ?>" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-10">
                                        <a href="view_order.php?id=<?php echo $order['id']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View</a>
                                        <a href="track_order.php?id=<?php echo $order['id']; ?>" class="block px-4 py-2 text-sm text-green-600 hover:bg-gray-100">Track</a>
                                        <a href="detail_order.php?id=<?php echo $order['id']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Detail</a>
                                        <a href="reorder.php?id=<?php echo $order['id']; ?>" class="block px-4 py-2 text-sm text-yellow-600 hover:bg-gray-100">Reorder</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            <a href="?page=<?php echo $currentPage > 1 ? $currentPage - 1 : 1; ?>" 
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 <?php echo $currentPage <= 1 ? 'pointer-events-none opacity-50' : ''; ?>">
                Previous
            </a>
            <span class="text-gray-600">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
            <a href="?page=<?php echo $currentPage < $totalPages ? $currentPage + 1 : $totalPages; ?>" 
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 <?php echo $currentPage >= $totalPages ? 'pointer-events-none opacity-50' : ''; ?>">
                Next
            </a>
        </div>
    </div>

    <!-- CSS -->
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- JavaScript -->
    <script>
        document.getElementById("search").addEventListener("input", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#older-orders tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle("hidden");
        }

        document.addEventListener("click", function (event) {
            const dropdowns = document.querySelectorAll("[id^='dropdown-']");
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target) && !event.target.closest("button")) {
                    dropdown.classList.add("hidden");
                }
            });
        });
    </script>


<?php $conn = null; ?>