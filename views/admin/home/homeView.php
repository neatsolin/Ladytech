<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['user_id'])) : ?>



  <!-- [ Main Content ] start -->
  <div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
        <h6 class="mb-2 f-w-400 text-muted">
          <i class="fas fa-eye text-primary fa-2x"></i> <!-- Blue Eye Icon -->
      </h6>

          <h4 class="mb-3">4,42,236 <span class="badge bg-light-primary border border-primary"><i
                class="ti ti-trending-up"></i> 59.3%</span></h4>
          <p class="mb-0 text-muted text-sm">You made an extra <span class="text-primary">35,000</span> this year</p>
        </div>
      </div>
    </div>
    <!-- Total Users Card -->
    <!-- Total Users Card -->
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
      $db = new PDO("mysql:host=localhost;dbname=dailyneed_db", "root", "");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Fetch total users
      $stmt = $db->query("SELECT * FROM users");
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $totalUsers = count($users);

      // Calculate percentage (no subtraction, just scaling based on totalUsers)
      $baselineUsers = 100; // Every 1 user = 1% (divided by 100)
      $percentage = ($totalUsers / $baselineUsers); // Simple scaling, now divided by 100

    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      $users = [];
      $totalUsers = 0;
      $percentage = 0;
    }
    ?>
    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
        <h6 class="mb-2 f-w-400 text-muted">
          <i class="fas fa-users text-success fa-2x"></i> <!-- Green Users Icon -->
      </h6>


          <h4 class="mb-3" id="totalUsers">
            <?php echo number_format($totalUsers); ?>
            <span class="badge bg-light-success border border-success">
              <i class="ti ti-trending-up"></i>
              <?php echo number_format($percentage, 1); ?>%
            </span>
          </h4>
          <p class="mb-0 text-muted text-sm">You made an extra <span class="text-success" id="extraUsers"><?php echo number_format($totalUsers); ?></span> this year</p>
        </div>
      </div>
    </div>
    <!-- Total Orders Card -->
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
      $db = new PDO("mysql:host=localhost;dbname=dailyneed_db", "root", "");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Fetch current total orders
      $stmt = $db->query("SELECT * FROM orders");
      $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $totalOrders = count($orders);

      // Fetch previous total orders (e.g., orders before this year)
      $stmtPrev = $db->query("SELECT COUNT(*) as prev_total FROM orders WHERE orderdate < '2025-01-01'");
      $previousTotalOrders = $stmtPrev->fetch(PDO::FETCH_ASSOC)['prev_total'] ?? 0;

      // Calculate percentage
      if ($previousTotalOrders > 0) {
        // Standard percentage change: (current - previous) / previous * 100
        $percentage = (($totalOrders - $previousTotalOrders) / $previousTotalOrders) * 100;
      } else {
        // No previous data: Scale percentage based on current total relative to a baseline (e.g., 1000 orders)
        $baselineOrders = 1000; // Adjust this value as needed (e.g., expected starting point)
        $percentage = $totalOrders > 0 ? ($totalOrders / $baselineOrders) * 10 : 0;
        // This makes % increase as totalOrders grows: 100 orders = 1%, 500 orders = 5%, 1000 orders = 10%, etc.
      }

      // Calculate extra orders
      $extraOrders = $previousTotalOrders > 0 ? $totalOrders - $previousTotalOrders : $totalOrders;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      $orders = [];
      $totalOrders = 0;
      $previousTotalOrders = 0;
      $percentage = 0;
      $extraOrders = 0;
    }
    ?>
    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
        <h6 class="mb-2 f-w-400 text-muted">
          <i class="fas fa-shopping-cart text-warning fa-2x"></i> <!-- Yellow Cart Icon -->
      </h6>

          <h4 class="mb-3">
            <?php echo number_format($totalOrders); ?>
            <span class="badge bg-light-warning border border-warning">
              <i class="ti ti-trending-<?php echo $percentage >= 0 ? 'up' : 'down'; ?>"></i>
              <?php echo number_format(abs($percentage), 1); ?>%
            </span>
          </h4>
          <p class="mb-0 text-muted text-sm">You made an extra <span class="text-warning"><?php echo number_format($extraOrders); ?></span> this year</p>
        </div>
      </div>
    </div>
    <!-- Total Sales Card -->
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
      $db = new PDO("mysql:host=localhost;dbname=dailyneed_db", "root", "");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Fetch current total sales (sum of totalprice for all orders)
      $stmt = $db->query("SELECT SUM(totalprice) as current_total FROM orders");
      $currentSalesData = $stmt->fetch(PDO::FETCH_ASSOC);
      $totalSales = $currentSalesData['current_total'] ?? 0;

      // Fetch previous total sales (e.g., orders before this year)
      $stmtPrev = $db->query("SELECT SUM(totalprice) as prev_total FROM orders WHERE orderdate < '2025-01-01'");
      $previousSalesData = $stmtPrev->fetch(PDO::FETCH_ASSOC);
      $previousTotalSales = $previousSalesData['prev_total'] ?? 0;

      // Calculate percentage change
      if ($previousTotalSales > 0) {
        $percentage = (($totalSales - $previousTotalSales) / $previousTotalSales) * 100;
      } else {
        // If no previous sales, use a baseline to scale percentage (e.g., $10,000)
        $baselineSales = 10000; // Adjust this value as needed
        $percentage = $totalSales > 0 ? ($totalSales / $baselineSales) * 10 : 0;
        // Scales % based on total sales: $500 = 0.5%, $5000 = 5%, etc.
      }

      // Calculate extra sales
      $extraSales = $previousTotalSales > 0 ? $totalSales - $previousTotalSales : $totalSales;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      $totalSales = 0;
      $previousTotalSales = 0;
      $percentage = 0;
      $extraSales = 0;
    }
    ?>
    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
    
        <h6 class="mb-2 f-w-400 text-muted">
          <i class="bi bi-cash text-danger fs-3"></i>
      </h6>



          <h4 class="mb-3">
            $<?php echo number_format($totalSales, 2); ?>
            <span class="badge bg-light-danger border border-danger">
              <i class="ti ti-trending-<?php echo $percentage >= 0 ? 'up' : 'down'; ?>"></i>
              <?php echo number_format(abs($percentage), 1); ?>%
            </span>
          </h4>
          <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$<?php echo number_format($extraSales, 2); ?></span> this year</p>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-xl-8">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="mb-0">Unique Visitor</h5>
        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-home" type="button" role="tab" aria-controls="chart-tab-home" aria-selected="true">Month</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile" aria-selected="false">Week</button>
          </li>
        </ul>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="tab-content" id="chart-tab-tabContent">
            <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab" tabindex="0">
              <div id="visitor-chart-1"></div>
            </div>
            <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel" aria-labelledby="chart-tab-profile-tab" tabindex="0">
              <div id="visitor-chart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xl-4">
      <h5 class="mb-3">Income Overview</h5>
      <div class="card">
        <div class="card-body">
          <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
          <h3 class="mb-3">$7,650</h3>
          <div id="income-overview-chart"></div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-xl-8">
      <h5 class="mb-3">Recent Orders</h5>
      <div class="card tbl-card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-borderless mb-0">
              <thead>
                <tr>
                  <th>TRACKING NO.</th>
                  <th>PRODUCT NAME</th>
                  <th>TOTAL ORDER</th>
                  <th>STATUS</th>
                  <th class="text-end">TOTAL AMOUNT</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Camera Lens</td>
                  <td>40</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                  </td>
                  <td class="text-end">$40,570</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Laptop</td>
                  <td>300</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                  </td>
                  <td class="text-end">$180,139</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Mobile</td>
                  <td>355</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                  <td class="text-end">$180,139</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Camera Lens</td>
                  <td>40</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                  </td>
                  <td class="text-end">$40,570</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Laptop</td>
                  <td>300</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                  </td>
                  <td class="text-end">$180,139</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Mobile</td>
                  <td>355</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                  <td class="text-end">$180,139</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Camera Lens</td>
                  <td>40</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                  </td>
                  <td class="text-end">$40,570</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Laptop</td>
                  <td>300</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                  </td>
                  <td class="text-end">$180,139</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Mobile</td>
                  <td>355</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                  <td class="text-end">$180,139</td>
                </tr>
                <tr>
                  <td><a href="#" class="text-muted">84564564</a></td>
                  <td>Mobile</td>
                  <td>355</td>
                  <td><span class="d-flex align-items-center gap-2"><i
                        class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                  <td class="text-end">$180,139</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xl-4">
      <h5 class="mb-3">Analytics Report</h5>
      <div class="card">
        <div class="list-group list-group-flush">
          <a href="#"
            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
            Finance Growth<span class="h5 mb-0">+45.14%</span></a>
          <a href="#"
            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
            Expenses Ratio<span class="h5 mb-0">0.58%</span></a>
          <a href="#"
            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Business
            Risk Cases<span class="h5 mb-0">Low</span></a>
        </div>
        <div class="card-body px-2">
          <div id="analytics-report-chart"></div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-xl-8">
      <h5 class="mb-3">Sales Report</h5>
      <div class="card">
        <div class="card-body">
          <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
          <h3 class="mb-0">$7,650</h3>
          <div id="sales-report-chart"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xl-4">
      <h5 class="mb-3">Transaction History</h5>
      <div class="card">
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                  <i class="ti ti-gift f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Order #002434</h6>
                <p class="mb-0 text-muted">Today, 2:00 AM</P>
              </div>
              <div class="flex-shrink-0 text-end">
                <h6 class="mb-1">+ $1,430</h6>
                <p class="mb-0 text-muted">78%</P>
              </div>
            </div>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                  <i class="ti ti-message-circle f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Order #984947</h6>
                <p class="mb-0 text-muted">5 August, 1:45 PM</P>
              </div>
              <div class="flex-shrink-0 text-end">
                <h6 class="mb-1">- $302</h6>
                <p class="mb-0 text-muted">8%</P>
              </div>
            </div>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                  <i class="ti ti-settings f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Order #988784</h6>
                <p class="mb-0 text-muted">7 hours ago</P>
              </div>
              <div class="flex-shrink-0 text-end">
                <h6 class="mb-1">- $682</h6>
                <p class="mb-0 text-muted">16%</P>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php
else:
  $this->redirect("/F_login");
endif;
?>