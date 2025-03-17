
    <title>Recent Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Recent Orders</h2>
            <input type="text" id="search" placeholder="Search orders..." class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Orders Table -->
        <div class="overflow-y-auto max-h-96 scrollbar-hide">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 sticky top-0 z-10">
                    <tr>
                        <th class="py-2 px-4 text-left">Phone</th>
                        <th class="py-2 px-4 text-left">Customer</th>
                        <th class="py-2 px-4 text-left">Payment</th>
                        <th class="py-2 px-4 text-left">Time</th>
                        <th class="py-2 px-4 text-left">Status</th>
                        <th class="py-2 px-4 text-left">Total</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">012 400 200</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full"> Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-green-100 text-green-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">$20.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>

                    <!-- other -->
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="py-2 px-4">015 055 700</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                        </td>
                        <td class="py-2 px-4">Paid</td>
                        <td class="py-2 px-4">49 min ago</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Pending</span>
                        </td>
                        <td class="py-2 px-4">$14.00</td>
                        <td class="py-2 px-4">
                            <button class="text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            <button class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Previous</button>
            <!-- <span>Page 1 of 5</span> -->
            <button class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Next</button>
        </div>
    </div>

    <!-- Add this CSS to hide the scrollbar -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari */
        }
        .scrollbar-hide {
            -ms-overflow-style: none; /* Hide scrollbar for IE, Edge */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
        }
    </style>

    <script>
        // Basic Search Filter
        document.getElementById("search").addEventListener("input", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#order-list tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>

