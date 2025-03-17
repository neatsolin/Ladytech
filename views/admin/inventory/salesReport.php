
   
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
        <h2 class="text-xl font-semibold mb-4">Order History</h2>

        <!-- Filters -->
        <div class="flex flex-wrap justify-between mb-4">
            <div>
                <button class="text-red-500 font-medium border-b-2 border-red-500 px-2 pb-1">All Order</button>
                <button class="text-gray-500 font-medium px-2 hover:text-black">Summary</button>
                <button class="text-gray-500 font-medium px-2 hover:text-black">Completed</button>
                <button class="text-gray-500 font-medium px-2 hover:text-black">Cancelled</button>
            </div>
            <div class="flex gap-2">
                <input type="text" id="dateStart" placeholder="Start Date" class="border rounded px-3 py-1 text-sm">
                <input type="text" id="dateEnd" placeholder="End Date" class="border rounded px-3 py-1 text-sm">
            </div>
        </div>

        <!-- Order Table -->
        <!-- Scrollable Table Container with Hidden Scrollbar -->
        <div class="max-h-80 overflow-y-auto border rounded-lg relative" style="scrollbar-width: none; -ms-overflow-style: none;">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm sticky top-0">
                    <tr>
                        <th class="py-2 px-4">Id</th>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Payment</th>
                        <th class="py-2 px-4">Time remaining</th>
                        <th class="py-2 px-4">Type</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Total</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                    <!-- Sample Rows (Repeat as needed for scrolling effect) -->
                    <tr class="border-t hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4">#2632</td>
                        <td class="py-2 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            Brooklyn Zoe
                        </td>
                        <td class="py-2 px-4">Cash</td>
                        <td class="py-2 px-4">15 min</td>
                        <td class="py-2 px-4 text-red-500">Delivery</td>
                        <td class="py-2 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                        </td>
                        <td class="py-2 px-4">£20.00</td>
                        <td class="py-2 px-4 relative">
                            <button class="text-gray-500">⋮</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- CSS to Hide Scrollbar -->
        <style>
            /* Hide scrollbar for Chrome, Safari and Edge */
            div::-webkit-scrollbar {
                display: none;
            }
            /* Hide scrollbar for Firefox */
            div {
                scrollbar-width: none;
            }
        </style>
    </div>
        

    <!-- JavaScript for Dropdown & Date Picker -->
    <script>
        function toggleDropdown(event) {
            const dropdowns = document.querySelectorAll('.absolute');
            dropdowns.forEach(dropdown => dropdown.classList.add('hidden'));
            event.target.nextElementSibling.classList.toggle('hidden');
            event.stopPropagation();
        }
        document.addEventListener('click', () => {
            document.querySelectorAll('.absolute').forEach(dropdown => dropdown.classList.add('hidden'));
        });

        // Date Picker
        flatpickr("#dateStart", { dateFormat: "Y-m-d" });
        flatpickr("#dateEnd", { dateFormat: "Y-m-d" });
    </script>
