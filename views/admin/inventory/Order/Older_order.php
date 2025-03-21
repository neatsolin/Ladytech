<script src="https://cdn.tailwindcss.com"></script>
<div class="p-6 bg-white rounded-lg shadow-md">
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Older Order</h2>
        <input type="text" id="search" placeholder="Search orders..." class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="overflow-y-auto max-h-[450px] scrollbar-hide">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200 sticky top-0 z-10">
                <tr class="bg-gray-200">
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
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">012 400 200</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full"> Brooklyn Zoe
                    </td>
                    <td class="py-2 px-4">Cash</td>
                    <td class="py-2 px-4">2024-02-15</td>
                    <td class="py-2 px-4">
                        <span class="bg-green-100 text-green-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                    </td>
                    <td class="py-2 px-4">$20.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-blue-500 hover:underline">View</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">012 400 200</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full"> Brooklyn Zoe
                    </td>
                    <td class="py-2 px-4">Cash</td>
                    <td class="py-2 px-4">2024-02-15</td>
                    <td class="py-2 px-4">
                        <span class="bg-green-100 text-green-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                    </td>
                    <td class="py-2 px-4">$20.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-green-500 hover:underline">Track</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">012 400 200</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full"> Brooklyn Zoe
                    </td>
                    <td class="py-2 px-4">Cash</td>
                    <td class="py-2 px-4">2024-02-15</td>
                    <td class="py-2 px-4">
                        <span class="bg-green-100 text-green-600 px-2 py-1 text-xs font-semibold rounded-full">Delivered</span>
                    </td>
                    <td class="py-2 px-4">$20.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-gray-500 hover:underline">Detail</button>
                    </td>
                </tr>

                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="py-2 px-4">015 055 700</td>
                    <td class="py-2 px-4 flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full"> Alice Knejlová
                    </td>
                    <td class="py-2 px-4">Paid</td>
                    <td class="py-2 px-4">2024-01-28</td>
                    <td class="py-2 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs font-semibold rounded-full">Cancelled</span>
                    </td>
                    <td class="py-2 px-4">$14.00</td>
                    <td class="py-2 px-4 flex gap-2">
                        <button class="text-yellow-500 hover:underline">Reorder</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<!-- Hide scrollbar -->
<style>
  .scrollbar-hide::-webkit-scrollbar {
      display: none; /* Hide scrollbar for Chrome, Safari */
  }
  .scrollbar-hide {
      -ms-overflow-style: none; /* Hide scrollbar for IE, Edge */
      scrollbar-width: none; /* Hide scrollbar for Firefox */
  }
</style>
