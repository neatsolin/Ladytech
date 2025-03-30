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

    // Get total number of pending orders
    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE orderstatus = 'Pending'");
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();
    $totalPages = ceil($totalOrders / $itemsPerPage);

    // Fetch pending orders for the current page
    $stmt = $conn->prepare("
        SELECT o.*, u.username, u.profile AS user_profile, u.phone
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        WHERE o.orderstatus = 'Pending'
        ORDER BY o.orderdate DESC
        LIMIT :limit OFFSET :offset
    ");
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


    <title>Pending Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-semibold text-gray-800">Pending Orders</h2>
            <input type="text" id="search" placeholder="Search orders..." class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg">
        </div>

        <!-- Orders Table -->
        <div class="overflow-y-auto max-h-[450px] scrollbar-hide">
            <table class="w-full border-collapse">
                <thead class="bg-[#2C4A6B] text-white sticky top-0 z-10">
                    <tr>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">ID</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Phone</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Customer</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Payment</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Date</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Total</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody id="pending-orders" class="divide-y divide-gray-200 bg-white">
                    <?php if (empty($orders)): ?>
                        <tr class="hover:bg-teal-50 transition">
                            <td colspan="8" class="py-4 px-6 text-center text-lg text-gray-600">No pending orders available.</td>
                        </tr>
                    <?php else: ?>
                        <?php $rowNumber = $offset + 1; // Start numbering based on the offset for the current page 
                        ?>
                        <?php foreach ($orders as $order): ?>
                            <tr class="hover:bg-teal-50 transition">
                                <td class="py-4 px-6 text-base text-blue-600 font-medium"><?php echo $rowNumber; ?></td>
                                <td class="py-4 px-6 text-base text-gray-700"><?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></td>
                                <td class="py-4 px-6 flex items-center gap-3">
                                    <?php if (!empty($order['user_profile'])): ?>
                                        <img src="<?php echo htmlspecialchars($order['user_profile']); ?>" class="w-10 h-10 rounded-full border-2 border-teal-300" alt="Profile">
                                    <?php else: ?>
                                        <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full border-2 border-teal-300" alt="Default Profile">
                                    <?php endif; ?>
                                    <span class="text-base text-gray-800 font-medium"><?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?></span>
                                </td>
                                <td class="py-4 px-6 text-base  text-green-600 font-medium">
                                    <?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?>
                                </td>
                                <td class="py-4 px-6 text-base text-gray-700"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-200 text-yellow-800 shadow-sm">
                                        <?php echo htmlspecialchars($order['orderstatus']); ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-base text-purple-600 font-semibold">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                <td class="py-4 px-6 relative">
                                    <button class="text-gray-500 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100 focus:outline-none"
                                        onclick="toggleDropdown('dropdown-<?php echo $order['id']; ?>')">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div id="dropdown-<?php echo $order['id']; ?>"
                                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                                            <a href="view_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50">
                                                <i class="fas fa-eye mr-3 text-lg"></i> View Details
                                            </a>
                                            <a href="track_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50">
                                                <i class="fas fa-pen mr-3 text-lg"></i> Edit
                                            </a>
                                            <a href="detail_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                            </a>
                                            <a href="message_order.php?id=<?php echo $order['id']; ?>"
                                                class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50">
                                                <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                            </a>
                                        </div>
                            </tr>
                            <?php $rowNumber++; // Increment for the next row 
                            ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            <a href="?page=<?php echo $currentPage > 1 ? $currentPage - 1 : 1; ?>"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-base <?php echo $currentPage <= 1 ? 'pointer-events-none opacity-50' : ''; ?>">
                Previous
            </a>
            <span class="text-gray-600 text-base">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
            <a href="?page=<?php echo $currentPage < $totalPages ? $currentPage + 1 : $totalPages; ?>"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-base <?php echo $currentPage >= $totalPages ? 'pointer-events-none opacity-50' : ''; ?>">
                Next
            </a>
        </div>
    </div>

    <!-- Hide scrollbar CSS -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <!-- JavaScript -->
    <script>
        document.getElementById("search").addEventListener("input", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#pending-orders tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        function toggleDropdown(id) {
            // បិទ dropdown ទាំងអស់សិន
            const dropdowns = document.querySelectorAll("[id^='dropdown-']");
            dropdowns.forEach(dropdown => {
                if (dropdown.id !== id) {
                    dropdown.classList.add("hidden");
                }
            });

            // បើក/បិទ dropdown ដែលចុច
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