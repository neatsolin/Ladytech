<?php
// Data is passed from the controller
$allOrders = $data['allOrders'] ?? [];
$draftOrders = $data['draftOrders'] ?? [];
$orderedOrders = $data['orderedOrders'] ?? [];
$partialOrders = $data['partialOrders'] ?? [];
$receivedOrders = $data['receivedOrders'] ?? [];
$closedOrders = $data['closedOrders'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Sticky table header styles */
        .table-wrapper { position: relative; overflow: hidden; }
        .table-scroll { overflow-y: auto; max-height: 600px; }
        .table-scroll::-webkit-scrollbar { background: transparent; }
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0; }
        .table-custom thead th { position: sticky; top: 0; background-color: #2C4A6B; color: white; z-index: 10; }
        .table-custom tbody tr { transition: background-color 0.2s; }
        .table-custom tbody tr:hover { background-color: #f8f9fa; }
        .table-custom td { padding: 12px; vertical-align: middle; border-top: 1px solid #e9ecef; }
        .status-badge { padding: 0.4em 0.8em; border-radius: 12px; font-size: 0.9rem; font-weight: 500; }

        /* Modal styles */
        .modal { display: none; position: fixed; z-index: 50; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
        .modal-content { background-color: white; padding: 20px; border-radius: 10px; width: 90%; max-width: 400px; position: relative; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .modal-close { position: absolute; top: 10px; right: 10px; font-size: 24px; cursor: pointer; color: #333; }
        .modal-content img { width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; }

        .status-draft { color: #6B7280; }
        .status-pending { color: #D97706; }
        .status-ordered { color: #2563EB; }
        .status-partial { color: #2563EB; }
        .status-received { color: #EC4899; }
        .status-delivered { color: #16A34A; }
        .status-closed { color: #6B7280; }
        .status-canceled { color: #DC2626; }
    </style>
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
                    <li><button class="tab-btn active px-5 py-2 bg-white text-teal-600 border-t-2 border-teal-500 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-md hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="all">All</button></li>
                    <li><button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="draft">Draft</button></li>
                    <li><button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="ordered">Ordered</button></li>
                    <li><button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="partial">Partial</button></li>
                    <li><button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="received">Received</button></li>
                    <li><button class="tab-btn px-5 py-2 bg-white text-gray-600 font-semibold text-sm uppercase tracking-wide rounded-t-md shadow-sm hover:bg-teal-100 hover:text-teal-700 transition-all duration-300" data-tab="closed">Closed</button></li>
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
                <div id="all" class="tab-content">
                    <div class="table-wrapper">
                        <div class="table-scroll">
                            <?php echo renderOrderTable($allOrders, 'all'); ?>
                        </div>
                    </div>
                </div>
                <div id="draft" class="tab-content hidden">
                    <div class="table-wrapper">
                        <div class="table-scroll">
                            <?php echo renderOrderTable($draftOrders, 'draft'); ?>
                        </div>
                    </div>
                </div>
                <div id="ordered" class="tab-content hidden">
                    <div class="table-wrapper">
                        <div class="table-scroll">
                            <?php echo renderOrderTable($orderedOrders, 'ordered'); ?>
                        </div>
                    </div>
                </div>
                <div id="partial" class="tab-content hidden">
                    <div class="table-wrapper">
                        <div class="table-scroll">
                            <?php echo renderOrderTable($partialOrders, 'partial'); ?>
                        </div>
                    </div>
                </div>
                <div id="received" class="tab-content hidden">
                    <div class="table-wrapper">
                        <div class="table-scroll">
                            <?php echo renderOrderTable($receivedOrders, 'received'); ?>
                        </div>
                    </div>
                </div>
                <div id="closed" class="tab-content hidden">
                    <div class="table-wrapper">
                        <div class="table-scroll">
                            <?php echo renderOrderTable($closedOrders, 'closed'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">×</span>
            <h2 class="text-xl font-bold mb-4">Order Details</h2>
            <div class="flex items-center mb-4">
                <img id="modalProfile" src="" alt="Profile">
                <div>
                    <p id="modalUsername" class="font-semibold"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 mb-4">
                <div><p class="text-gray-600 text-sm">Order No.:</p><p id="modalOrderNo" class="font-medium"></p></div>
                <div><p class="text-gray-600 text-sm">Product Name:</p><p id="modalProductName" class="font-medium"></p></div>
                <div><p class="text-gray-600 text-sm">Destination:</p><p id="modalDestination" class="font-medium"></p></div>
                <div><p class="text-gray-600 text-sm">Status:</p><p id="modalStatus" class="font-medium"></p></div>
                <div><p class="text-gray-600 text-sm">Purchase Time:</p><p id="modalPurchaseTime" class="font-medium"></p></div>
                <div><p class="text-gray-600 text-sm">Expected Arrival:</p><p id="modalExpectedArrival" class="font-medium"></p></div>
            </div>
            <div><p class="text-gray-600 text-sm">Total:</p><p id="modalTotal" class="font-semibold text-lg text-purple-600"></p></div>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">×</span>
            <h2 class="text-xl font-bold mb-4">Edit Order</h2>
            <form id="editOrderForm" action="/update_order_status" method="POST">
                <input type="hidden" id="editOrderId" name="orderId">
                <div class="mb-4">
                    <label for="editOrderStatus" class="block text-gray-600 text-sm mb-2">Order Status</label>
                    <select id="editOrderStatus" name="orderStatus" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        <option value="Pending">Pending</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">Save Changes</button>
            </form>
        </div>
    </div>

    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">×</span>
            <h2 class="text-xl font-bold mb-4">Send Message</h2>
            <form id="sendMessageForm">
                <input type="hidden" id="messageOrderId" name="orderId">
                <div class="mb-4">
                    <label for="messageContent" class="block text-gray-600 text-sm mb-2">Message</label>
                    <textarea id="messageContent" name="messageContent" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-teal-300" rows="4" placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" class="w-full bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 transition">Send Message</button>
            </form>
        </div>
    </div>

    <script>
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

        document.getElementById("search").addEventListener("input", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll(".tab-content:not(.hidden) tbody tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        function toggleDropdown(id) {
            const dropdowns = document.querySelectorAll("[id^='dropdown-']");
            dropdowns.forEach(dropdown => {
                if (dropdown.id !== id) dropdown.classList.add("hidden");
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

        function showDetails(orderNo, productName, username, profile, destination, status, purchaseTime, expectedArrival, total) {
            const modal = document.getElementById("orderModal");
            const modalProfile = document.getElementById("modalProfile");
            const modalUsername = document.getElementById("modalUsername");
            const modalOrderNo = document.getElementById("modalOrderNo");
            const modalProductName = document.getElementById("modalProductName");
            const modalDestination = document.getElementById("modalDestination");
            const modalStatus = document.getElementById("modalStatus");
            const modalPurchaseTime = document.getElementById("modalPurchaseTime");
            const modalExpectedArrival = document.getElementById("modalExpectedArrival");
            const modalTotal = document.getElementById("modalTotal");

            modalProfile.src = profile;
            modalUsername.textContent = username;
            modalOrderNo.textContent = orderNo;
            modalProductName.textContent = productName;
            modalDestination.textContent = destination;
            modalStatus.textContent = status;
            modalPurchaseTime.textContent = purchaseTime;
            modalExpectedArrival.textContent = expectedArrival;
            modalTotal.textContent = `$ ${total}`;

            modalStatus.classList.remove("status-draft", "status-pending", "status-ordered", "status-partial", "status-received", "status-delivered", "status-closed", "status-canceled");
            if (status.toLowerCase() === "draft") modalStatus.classList.add("status-draft");
            else if (status.toLowerCase() === "pending") modalStatus.classList.add("status-pending");
            else if (status.toLowerCase() === "ordered") modalStatus.classList.add("status-ordered");
            else if (status.toLowerCase() === "partial") modalStatus.classList.add("status-partial");
            else if (status.toLowerCase() === "received") modalStatus.classList.add("status-received");
            else if (status.toLowerCase() === "delivered") modalStatus.classList.add("status-delivered");
            else if (status.toLowerCase() === "closed") modalStatus.classList.add("status-closed");
            else if (status.toLowerCase() === "canceled") modalStatus.classList.add("status-canceled");

            modal.style.display = "flex";

            const closeBtn = document.querySelector("#orderModal .modal-close");
            closeBtn.onclick = function() { modal.style.display = "none"; };
            window.onclick = function(event) { if (event.target === modal) modal.style.display = "none"; };
        }

        function showEdit(id, orderstatus) {
            const modal = document.getElementById("editModal");
            const orderIdInput = document.getElementById("editOrderId");
            const statusSelect = document.getElementById("editOrderStatus");

            orderIdInput.value = id;
            statusSelect.value = orderstatus;

            modal.style.display = "flex";

            const closeBtn = document.querySelector("#editModal .modal-close");
            closeBtn.onclick = function() { modal.style.display = "none"; };
            window.onclick = function(event) { if (event.target === modal) modal.style.display = "none"; };
        }

        document.getElementById("editOrderForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const orderId = document.getElementById("editOrderId").value;
            const newStatus = document.getElementById("editOrderStatus").value;

            fetch("/update_order_status", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `orderId=${orderId}&orderStatus=${newStatus}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Order status updated successfully!");
                    document.getElementById("editModal").style.display = "none";
                    location.reload();
                } else {
                    alert("Failed to update order status: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while updating the order status.");
            });
        });

        function showMessage(id) {
            const modal = document.getElementById("messageModal");
            const orderIdInput = document.getElementById("messageOrderId");

            orderIdInput.value = id;
            modal.style.display = "flex";

            const closeBtn = document.querySelector("#messageModal .modal-close");
            closeBtn.onclick = function() { modal.style.display = "none"; };
            window.onclick = function(event) { if (event.target === modal) modal.style.display = "none"; };
        }

        document.getElementById("sendMessageForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const orderId = document.getElementById("messageOrderId").value;
            const messageContent = document.getElementById("messageContent").value;

            if (!messageContent.trim()) {
                alert("Please enter a message.");
                return;
            }

            fetch("/send_message", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `orderId=${orderId}&messageContent=${encodeURIComponent(messageContent)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Message sent successfully!");
                    document.getElementById("messageModal").style.display = "none";
                    document.getElementById("messageContent").value = "";
                } else {
                    alert("Failed to send message: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while sending the message.");
            });
        });

        function deleteOrder(id) {
            if (confirm('Are you sure you want to delete this order?')) {
                fetch("/delete_order", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `orderId=${id}`
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert("Order deleted successfully!");
                        location.reload();
                    } else {
                        alert("Failed to delete order: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while deleting the order: " + error.message);
                });
            }
        }

        function cancelOrder(id) {
            if (confirm('Are you sure you want to cancel this order?')) {
                fetch("/cancel_order", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `orderId=${id}`
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert("Order canceled successfully!");
                        location.reload();
                    } else {
                        alert("Failed to cancel order: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while canceling the order: " + error.message);
                });
            }
        }

        // Log when the page loads to confirm auto-cancellation ran
        window.addEventListener('load', function() {
            console.log("Page loaded, expired pending orders have been checked and canceled if applicable.");
        });
    </script>
</body>
</html>

<?php
function renderOrderTable($orders, $tabPrefix) {
    $statuses = [
        'Draft' => 'bg-gray-200 text-gray-800',
        'Pending' => 'bg-yellow-200 text-yellow-800',
        'Ordered' => 'bg-blue-200 text-blue-800',
        'Partial' => 'bg-blue-200 text-blue-800',
        'Received' => 'bg-pink-200 text-pink-800',
        'Delivered' => 'bg-green-200 text-green-800',
        'Closed' => 'bg-gray-400 text-gray-800',
        'Canceled' => 'bg-red-300 text-red-800',
    ];
    
    ob_start();
    ?>
    <table class="table-custom">
        <thead>
            <tr>
                <th class="py-3 px-2 w-8 text-left text-xs font-semibold uppercase tracking-wider"><input type="checkbox" class="h-4 w-4 text-teal-600"></th>
                <th class="py-3 px-2 w-20 text-left text-xs font-semibold uppercase tracking-wider">Order No.</th>
                <th class="py-3 px-2 w-32 text-left text-xs font-semibold uppercase tracking-wider">Product Name</th>
                <th class="py-3 px-2 w-36 text-left text-xs font-semibold uppercase tracking-wider">Customer</th>
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
                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition" data-order-id="<?php echo $order['id']; ?>">
                        <td class="py-3 px-2 w-8 whitespace-nowrap"><input type="checkbox" class="h-4 w-4 text-teal-600"></td>
                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-blue-600 font-medium truncate"><?php echo $index + 1; ?></td>
                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?></td>
                        <td class="py-3 px-2 w-36 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>" class="w-8 h-8 rounded-full mr-2 border-2 border-purple-300" alt="Profile">
                                <span class="text-sm text-gray-800 font-medium truncate"><?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?></span>
                            </div>
                        </td>
                        <td class="py-3 px-2 w-24 whitespace-nowrap text-sm text-gray-700 truncate">Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?></td>
                        <td class="py-3 px-2 w-20 whitespace-nowrap">
                            <?php $class = $statuses[$order['orderstatus']] ?? 'bg-gray-300 text-gray-900'; ?>
                            <span class="status-cell inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?= $class ?>">
                                <?= htmlspecialchars($order['orderstatus']) ?>
                            </span>
                        </td>
                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-gray-600 truncate">N/A</td>
                        <td class="py-3 px-2 w-20 whitespace-nowrap text-sm text-purple-600 font-semibold truncate">$<?php echo number_format($order['totalprice'], 2); ?></td>
                        <td class="py-3 px-2 w-32 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                        <td class="py-3 px-2 w-28 whitespace-nowrap text-sm text-gray-700 truncate"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?></td>
                        <td class="py-3 px-2 w-16 whitespace-nowrap relative">
                            <button class="text-gray-600 hover:text-teal-600 transition text-2xl p-2 rounded-full hover:bg-gray-100" onclick="toggleDropdown('dropdown-<?= $tabPrefix ?>-<?= $order['id'] ?>')">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div id="dropdown-<?= $tabPrefix ?>-<?= $order['id'] ?>" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                                <button onclick="showDetails('<?php echo $index + 1; ?>', '<?php echo htmlspecialchars($order['product_name'] ?? 'Unknown Product'); ?>', '<?php echo htmlspecialchars($order['username'] ?? 'Unknown User'); ?>', '<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>', 'Loc <?php echo htmlspecialchars($order['location_id'] ?? 'N/A'); ?>', '<?php echo htmlspecialchars($order['orderstatus']); ?>', '<?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?>', '<?php echo htmlspecialchars(date('M d, Y', strtotime($order['orderdate']))); ?>', '<?php echo number_format($order['totalprice'], 2); ?>')"
                                    class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors duration-200 w-full text-left">
                                    <i class="fas fa-eye mr-3 text-lg"></i> View
                                </button>
                                <button onclick="showEdit('<?php echo $order['id']; ?>', '<?php echo htmlspecialchars($order['orderstatus']); ?>')"
                                    class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition-colors duration-200 w-full text-left">
                                    <i class="fas fa-edit mr-3 text-lg"></i> Edit
                                </button>
                                <button onclick="showMessage('<?php echo $order['id']; ?>')"
                                    class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 transition-colors duration-200 w-full text-left">
                                    <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                </button>
                                <button onclick="cancelOrder('<?php echo $order['id']; ?>')"
                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 w-full text-left">
                                    <i class="fas fa-ban mr-3 text-lg"></i> Cancel
                                </button>
                                <button onclick="deleteOrder('<?php echo $order['id']; ?>')"
                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 w-full text-left">
                                    <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}
?>