<div class="container my-4">
        <div class="bg-white rounded p-4 shadow">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4>Purchase Orders</h4>
                    <p class="text-muted">The inventory section on the ShopZen page provides a snapshot of product availability.</p>
                </div>
                <button class="btn btn-primary">Create Purchase Order</button>
            </div>
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">Draft</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ordered-tab" data-bs-toggle="tab" data-bs-target="#ordered" type="button" role="tab" aria-controls="ordered" aria-selected="false">Ordered</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="partial-tab" data-bs-toggle="tab" data-bs-target="#partial" type="button" role="tab" aria-controls="partial" aria-selected="false">Partial</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button" role="tab" aria-controls="received" aria-selected="false">Received</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="closed-tab" data-bs-toggle="tab" data-bs-target="#closed" type="button" role="tab" aria-controls="closed" aria-selected="false">Closed</button>
                </li>
            </ul>
            <!-- Search and Filter -->
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-2">
                    <div class="input-group w-auto">
                        <input type="text" class="form-control" placeholder="Search">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <button class="btn btn-outline-secondary ms-2" type="button">
                        <i class="bi bi-funnel"></i>
                    </button>
                    <button class="btn btn-outline-secondary ms-2" type="button">
                        <i class="bi bi-plus"></i> Add
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary me-2" type="button">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <span class="text-muted">1/1</span>
                    <button class="btn btn-outline-secondary ms-2" type="button">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                    <button class="btn btn-outline-secondary ms-2" type="button">
                        <i class="bi bi-three-dots"></i>
                    </button>
                </div>
            </div>
            <!-- Tab Content -->
            <div class="tab-content" id="orderTabsContent">
                <!-- All Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Purchase order</th>
                                <th>Supplier</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Total</th>
                                <th>Expected arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO1</td>
                                <td>Supplier1</td>
                                <td>Warehouse1</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 20, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO2</td>
                                <td>Supplier2</td>
                                <td>Warehouse2</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 24, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO3</td>
                                <td>Supplier3</td>
                                <td>Warehouse3</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 28, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO4</td>
                                <td>Supplier4</td>
                                <td>Warehouse4</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 28, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO5</td>
                                <td>Supplier5</td>
                                <td>Warehouse5</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 10, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO6</td>
                                <td>Supplier6</td>
                                <td>Warehouse6</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 12, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO7</td>
                                <td>Supplier7</td>
                                <td>Warehouse7</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 14, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO8</td>
                                <td>Supplier8</td>
                                <td>Warehouse8</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 16, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO9</td>
                                <td>Supplier9</td>
                                <td>Warehouse9</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 18, 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Draft Tab -->
                <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Purchase order</th>
                                <th>Supplier</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Total</th>
                                <th>Expected arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- No draft orders in the image, so this tab is empty -->
                            <tr>
                                <td colspan="8" class="text-center text-muted">No draft orders available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Ordered Tab -->
                <div class="tab-pane fade" id="ordered" role="tabpanel" aria-labelledby="ordered-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Purchase order</th>
                                <th>Supplier</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Total</th>
                                <th>Expected arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Assuming "Ordered" means "Open" status -->
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO2</td>
                                <td>Supplier2</td>
                                <td>Warehouse2</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 24, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO4</td>
                                <td>Supplier4</td>
                                <td>Warehouse4</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 28, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO6</td>
                                <td>Supplier6</td>
                                <td>Warehouse6</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 12, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO8</td>
                                <td>Supplier8</td>
                                <td>Warehouse8</td>
                                <td><span class="text-success">● Open</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 16, 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Partial Tab -->
                <div class="tab-pane fade" id="partial" role="tabpanel" aria-labelledby="partial-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Purchase order</th>
                                <th>Supplier</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Total</th>
                                <th>Expected arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- No partial orders in the image, so this tab is empty -->
                            <tr>
                                <td colspan="8" class="text-center text-muted">No partial orders available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Received Tab -->
                <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="received-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Purchase order</th>
                                <th>Supplier</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Total</th>
                                <th>Expected arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- No received orders in the image, so this tab is empty -->
                            <tr>
                                <td colspan="8" class="text-center text-muted">No received orders available.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Closed Tab -->
                <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Purchase order</th>
                                <th>Supplier</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Total</th>
                                <th>Expected arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO1</td>
                                <td>Supplier1</td>
                                <td>Warehouse1</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 20, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO3</td>
                                <td>Supplier3</td>
                                <td>Warehouse3</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Jan 28, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO5</td>
                                <td>Supplier5</td>
                                <td>Warehouse5</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 10, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO7</td>
                                <td>Supplier7</td>
                                <td>Warehouse7</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 14, 2024</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>#PO9</td>
                                <td>Supplier9</td>
                                <td>Warehouse9</td>
                                <td><span class="text-danger">● Closed</span></td>
                                <td>3 of 3</td>
                                <td>$5000</td>
                                <td>Feb 18, 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>