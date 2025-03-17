<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">All Orders</h1>

        <!-- Filters -->
        <div class="flex flex-wrap justify-between mb-4">
            <div>
                <button class="text-red-500 font-medium border-b-2 border-red-500 px-2 pb-1">All</button>
                <button class="text-gray-500 font-medium px-2 hover:text-black">Pending</button>
                <button class="text-gray-500 font-medium px-2 hover:text-black">Completed</button>
                <button class="text-gray-500 font-medium px-2 hover:text-black">Cancelled</button>
            </div>
            <div class="flex gap-2">
                <input type="text" placeholder="Search orders..." class="px-4 py-2 border rounded-lg w-full md:w-1/3">
            </div>
        </div>

        <!-- Order Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b text-left">Order ID</th>
                        <th class="py-2 px-4 border-b text-left">Customer</th>
                        <th class="py-2 px-4 border-b text-left">Date</th>
                        <th class="py-2 px-4 border-b text-left">Payment</th>
                        <th class="py-2 px-4 border-b text-left">Total</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Order 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">#1001</td>
                        <td class="py-2 px-4 border-b">John Doe</td>
                        <td class="py-2 px-4 border-b">2023-10-01</td>
                        <td class="py-2 px-4 border-b">Cash</td>
                        <td class="py-2 px-4 border-b">$50.00</td>
                        <td class="py-2 px-4 border-b text-green-500">Delivered</td>
                        <td class="py-2 px-4 border-b">
                            <button class="bg-blue-500 text-white px-4 py-1 rounded">View</button>
                        </td>
                    </tr>
                    <!-- Order 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">#1002</td>
                        <td class="py-2 px-4 border-b">Jane Smith</td>
                        <td class="py-2 px-4 border-b">2023-10-02</td>
                        <td class="py-2 px-4 border-b">Credit Card</td>
                        <td class="py-2 px-4 border-b">$75.00</td>
                        <td class="py-2 px-4 border-b text-yellow-500">Processing</td>
                        <td class="py-2 px-4 border-b">
                            <button class="bg-blue-500 text-white px-4 py-1 rounded">Track</button>
                        </td>
                    </tr>
                    <!-- Order 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">#1003</td>
                        <td class="py-2 px-4 border-b">Alice Johnson</td>
                        <td class="py-2 px-4 border-b">2023-10-03</td>
                        <td class="py-2 px-4 border-b">PayPal</td>
                        <td class="py-2 px-4 border-b">$30.00</td>
                        <td class="py-2 px-4 border-b text-red-500">Cancelled</td>
                        <td class="py-2 px-4 border-b">
                            <button class="bg-blue-500 text-white px-4 py-1 rounded">Reorder</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>