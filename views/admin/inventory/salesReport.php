<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <h1>Sales Report</h1>
    <style>
        h1{
            color:gray;
            margin-bottom: 40px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .left-section {
            flex: 2;
        }
        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .btn-container {
            margin-bottom: 15px;
        }
        button {
            margin: 5px;
            padding: 8px 15px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        canvas {
            width: 100% !important;
            height: 100% !important;
        }
        h3{
            font-size:30px;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            /* background-color: #007bff; */
            color: black;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .action-buttons .material-icons {
            font-size: 24px;
            cursor: pointer;
        }
        .edit-btn {
            color: #007bff;
        }
        .delete-btn {
            color: #dc3545;
        }
        .sales-table{
            margin-top: 50px;
        }
        .chart-container {
            height: 450px; /* Increased chart height */
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds depth */
            padding: 20px;
            margin-bottom: 20px; /* Adds space below the chart */
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 5px; /* Reduced space between icons */
        }

        .action-buttons .material-icons {
            width: 20px;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        /* .action-buttons .edit-btn:hover {
            background: rgba(0, 123, 255, 0.1);
        } */

        .action-buttons .delete-btn {
            color: #dc3545;
        }

        /* .action-buttons .delete-btn:hover {
            background: rgba(220, 53, 69, 0.1);
        } */


    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="btn-container">
                <button onclick="updateChart('monthly')">Monthly</button>
                <button onclick="updateChart('weekly')">Weekly</button>
                <button onclick="updateChart('yearly')">Yearly</button>
            </div>
            <div class="chart-container">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
        <div class="right-section">
    <div class="customer-table">
        <h3>Customer List</h3>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Purchased Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="customerTableBody"></tbody>
        </table>
    </div>
</div>

<script>
    // Sample customer data with image URLs
    const customers = [
        { 
            profile: "", 
            name: "John Doe", 
            purchased: "Laptop, Mouse"
        },
        { 
            profile: "https://via.placeholder.com/50", 
            name: "Jane Smith", 
            purchased: "Smartphone, Headphones"
        },
        { 
            profile: "https://via.placeholder.com/50", 
            name: "Michael Brown", 
            purchased: "Tablet, Keyboard"
        }
    ];

    // Function to populate the table
    function populateCustomerTable() {
        const tableBody = document.getElementById("customerTableBody");

        customers.forEach(customer => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td><img src="${customer.profile}" alt="Profile" width="50" height="50" style="border-radius:50%;"></td>
                <td>${customer.name}</td>
                <td>${customer.purchased}</td>
                <td><button onclick="alert('View Details of ${customer.name}')">View</button></td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Load data when the page loads
    document.addEventListener("DOMContentLoaded", populateCustomerTable);
</script>

    </div>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-pending { background-color: #fceabb; color: #a67c00; }
        .status-active { background-color: #d4edda; color: #155724; }
        .status-inactive { background-color: #f8d7da; color: #721c24; }
        .status-on-sale { background-color: #cce5ff; color: #004085; }
        .status-bouncing { background-color: #e2d9f3; color: #4b0082; }
        .product-img { width: 40px; height: 40px; border-radius: 50%; }
        .action-menu {
            position: relative;
            display: inline-block;
        }
        .action-menu-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 100px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .action-menu-content a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: black;
        }
        .action-menu-content a:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
<h2 class="mt-4">Product Table</h2>
    <div class="container-table mt-5">

        <!-- Product Table -->
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Profile</th>
                    <th>Product Name</th>
                    <th>Product ID</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = [
                    [
                        "name" => "Cherry Delight",
                        "id" => "#KP267400",
                        "price" => "$90.50",
                        "stock" => "350 pcs",
                        "type" => "Dessert",
                        "status" => "Pending",
                        "image" => "profiles/1741660533_avatar-4.jpg"
                    ],
                    [
                        "name" => "Kiwi",
                        "id" => "#TL651535",
                        "price" => "$12.00",
                        "stock" => "650 kg",
                        "type" => "Fruits",
                        "status" => "Active",
                        "image" => "profiles/1741612553_avatar-5.jpg"
                    ],
                    [
                        "name" => "Mango Magic",
                        "id" => "#GB651535",
                        "price" => "$100.50",
                        "stock" => "1200 pcs",
                        "type" => "Ice Cream",
                        "status" => "Inactive",
                        "image" => "profiles/1741660533_avatar-4.jpg"
                    ]
                ];
                
                foreach ($products as $index => $product) {
                    $statusClass = strtolower(str_replace(' ', '-', $product["status"]));
                    echo "<tr>";
                    echo "<td><img src='{$product["image"]}' alt='{$product["name"]}' class='product-img'></td>";
                    echo "<td>{$product["name"]}</td>";
                    echo "<td>{$product["id"]}</td>";
                    echo "<td>{$product["price"]}</td>";
                    echo "<td>{$product["stock"]}</td>";
                    echo "<td>{$product["type"]}</td>";
                    echo "<td><span class='status-badge status-{$statusClass}'>{$product["status"]}</span></td>";
                    echo "<td>
                            <div class='action-menu'>
                                <i class='fas fa-ellipsis-v' onclick='toggleMenu($index)'></i>
                                <div class='action-menu-content' id='menu-$index'>
                                    <a href='#' onclick='editProduct($index)'><i class='fas fa-edit'></i> Edit</a>
                                    <a href='#' onclick='deleteProduct($index)'><i class='fas fa-trash'></i> Delete</a>
                                </div>
                            </div>
                            </td>";
                    echo "</tr>";
                }
               ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleMenu(index) {
            let menu = document.getElementById("menu-" + index);
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function editProduct(index) {
            alert("Edit product " + index);
        }

        function deleteProduct(index) {
            if (confirm("Are you sure you want to delete this product?")) {
                alert("Product " + index + " deleted!");
            }
        }

        // Close menu if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.fa-ellipsis-v')) {
                let dropdowns = document.getElementsByClassName("action-menu-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    let openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>


    <script>
        var chartData = {
            monthly: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                data: [200, 300, 250, 400, 500, 600, 450, 550, 700, 650, 720, 800]
            },
            weekly: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                data: [100, 150, 200, 180, 220, 250, 300]
            },
            yearly: {
                labels: ["2020", "2021", "2022", "2023", "2024","2025"],
                data: [5000, 6000, 7500, 8000, 9000, 10000]
            }
        };

        function loadChart() {
            var ctx = document.getElementById("myBarChart").getContext("2d");
            window.myBarChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: chartData.monthly.labels,
                    datasets: [{
                        label: "Sales",
                        data: chartData.monthly.data,
                        backgroundColor: "rgba(75, 192, 192, 0.6)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: "#ddd" } }
                    }
                }
            });
        }

        function updateChart(type) {
            window.myBarChart.data.labels = chartData[type].labels;
            window.myBarChart.data.datasets[0].data = chartData[type].data;
            window.myBarChart.update();
        }

        var customerData = [
            { name: "John Doe", purchased: 5, profile: "profiles/1741660533_avatar-4.jpg" },
            { name: "Jane Smith", purchased: 8, profile: "profiles/1741612553_avatar-5.jpg" },
            { name: "Mike Johnson", purchased: 3, profile: "profiles/1741660533_avatar-4.jpg" }
        ];

        function loadCustomerTable() {
            var tableBody = document.getElementById("customerTableBody");
            tableBody.innerHTML = "";
            customerData.forEach((customer, index) => {
                var row = tableBody.insertRow();
                row.insertCell(0).innerHTML = `<img src="${customer.profile}" alt="Profile" class="profile-img">`;
                row.insertCell(1).innerText = customer.name;
                row.insertCell(2).innerText = customer.purchased;
                row.insertCell(3).innerHTML = `
                    <div class="action-buttons">
                        <span class="material-icons edit-btn" onclick="editCustomer(${index})">edit</span>
                        <span class="material-icons delete-btn" onclick="deleteCustomer(${index})">delete</span>
                    </div>
                `;
            });
        }

        window.onload = function() {
            loadChart();
            loadCustomerTable();
        };
    </script>
</body>
</html>
