<div class="container my-4">
        <div class="bg-white rounded p-4 shadow">
            <h4 class="mb-3">Order History</h4>
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All Order</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="false">Summary</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</button>
                </li>
            </ul>
            <!-- Date Filter -->
            <div class="d-flex justify-content-end mb-3">
                <input type="date" class="form-control w-auto me-2" value="2021-11-03">
                <input type="date" class="form-control w-auto" value="2021-03-02">
            </div>
            <!-- Tab Content -->
            <div class="tab-content" id="orderTabsContent">
                <!-- All Orders Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Payment</th>
                                <th>Time remaining</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="all-orders">
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Brooklyn Zoe
                                </td>
                                <td>Cash</td>
                                <td>13 min</td>
                                <td>Delivery</td>
                                <td><span class="text-warning">● Delivered</span></td>
                                <td>€12.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Alice Krejčová
                                </td>
                                <td>Paid</td>
                                <td>48 min</td>
                                <td>Collection</td>
                                <td><span class="text-success">● Collected</span></td>
                                <td>€14.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Jurian van
                                </td>
                                <td>Cash</td>
                                <td>07 min</td>
                                <td>Delivery</td>
                                <td><span class="text-danger">● Cancelled</span></td>
                                <td>€18.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Ya Chin-Ho
                                </td>
                                <td>Paid</td>
                                <td>48 min</td>
                                <td>Collection</td>
                                <td><span class="text-success">● Collected</span></td>
                                <td>€26.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Shaamikh Ali
                                </td>
                                <td>Cash</td>
                                <td>00 min</td>
                                <td>Delivery</td>
                                <td><span class="text-warning">● Delivered</span></td>
                                <td>€26.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Niek Bove
                                </td>
                                <td>Paid</td>
                                <td>00 min</td>
                                <td>Collection</td>
                                <td><span class="text-danger">● Cancelled</span></td>
                                <td>€75.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Uruwe Himona
                                </td>
                                <td>Cash</td>
                                <td>15 min</td>
                                <td>Delivery</td>
                                <td><span class="text-warning">● Delivered</span></td>
                                <td>€19.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Summary Tab -->
                <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                    <div class="p-3">
                        <h5 class="mb-3">Order Summary (11-03-2021 to 03-02-2021)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Order Statistics</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Orders
                                        <span class="badge bg-primary rounded-pill">7</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Delivered
                                        <span class="badge bg-warning text-dark rounded-pill">3</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Collected
                                        <span class="badge bg-success rounded-pill">2</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Cancelled
                                        <span class="badge bg-danger rounded-pill">2</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Financial Overview</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Revenue (Completed Orders)
                                        <span class="fw-bold">€97.00</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Average Order Value (Completed)
                                        <span class="fw-bold">€19.40</span>
                                    </li>
                                </ul>
                                <h6 class="text-muted mt-3">Payment Methods</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Cash Payments
                                        <span class="badge bg-secondary rounded-pill">4</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Paid (Online/Card)
                                        <span class="badge bg-secondary rounded-pill">3</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Completed Tab -->
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Payment</th>
                                <th>Time remaining</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="completed-orders">
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Brooklyn Zoe
                                </td>
                                <td>Cash</td>
                                <td>13 min</td>
                                <td>Delivery</td>
                                <td><span class="text-warning">● Delivered</span></td>
                                <td>€12.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Alice Krejčová
                                </td>
                                <td>Paid</td>
                                <td>48 min</td>
                                <td>Collection</td>
                                <td><span class="text-success">● Collected</span></td>
                                <td>€14.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Ya Chin-Ho
                                </td>
                                <td>Paid</td>
                                <td>48 min</td>
                                <td>Collection</td>
                                <td><span class="text-success">● Collected</span></td>
                                <td>€26.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Shaamikh Ali
                                </td>
                                <td>Cash</td>
                                <td>00 min</td>
                                <td>Delivery</td>
                                <td><span class="text-warning">● Delivered</span></td>
                                <td>€26.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Uruwe Himona
                                </td>
                                <td>Cash</td>
                                <td>15 min</td>
                                <td>Delivery</td>
                                <td><span class="text-warning">● Delivered</span></td>
                                <td>€19.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Cancelled Tab -->
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Payment</th>
                                <th>Time remaining</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cancelled-orders">
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Jurian van
                                </td>
                                <td>Cash</td>
                                <td>07 min</td>
                                <td>Delivery</td>
                                <td><span class="text-danger">● Cancelled</span></td>
                                <td>€18.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#3252</td>
                                <td>
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar" width="40" height="40">
                                    Niek Bove
                                </td>
                                <td>Paid</td>
                                <td>00 min</td>
                                <td>Collection</td>
                                <td><span class="text-danger">● Cancelled</span></td>
                                <td>€75.00</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                            <li><a class="dropdown-item" href="#">Refund</a></li>
                                            <li><a class="dropdown-item" href="#">Message</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>