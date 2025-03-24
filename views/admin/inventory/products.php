<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
    <style>
   .bell-icon {
    font-size: 24px;
    cursor: pointer;
    position: relative;
}

/* Remove the ::after pseudo-element since we're using .notification-count */
.bell-icon.alert::after {
    display: none;
}

.bell-icon.ring {
    animation: ring 0.5s infinite;
}

.icon-ring {
    animation: ring 0.5s infinite;
}

@keyframes ring {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(15deg); }
    50% { transform: rotate(0deg); }
    75% { transform: rotate(-15deg); }
    100% { transform: rotate(0deg); }
}

.search-small {
    max-width: 300px;
}

.notification-count {
    position: absolute;
    top: -2px; /* Position close to the bell */
    right: -2px;
    width: 18px; /* Slightly larger to match the image */
    height: 18px;
    background-color: red; /* Green when there is a number */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px; /* Slightly larger font for the number */
    color: white;
    font-weight: bold;
}

/* Style for when the notification count is empty (plain red dot) */
.notification-count:empty {
    background-color: red; /* Red when there is no number */
    width: 16px; /* Slightly smaller for the plain red dot */
    height: 16px;
}
    </style>



<div class="container my-4">
    <!-- Top Bar with Buttons and Bell -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="/add-product" class="btn btn-primary">+ Add New Product</a>
            <button id="export-excel" class="btn btn-secondary">Export to Excel</button>
        </div>
        <span id="notification-bell" class="bell-icon bi bi-bell" title="Stock Alerts" data-bs-toggle="modal" data-bs-target="#lowStockModal">
            <span id="notification-count" class="notification-count"></span>
        </span>
    </div>

    <!-- Search Filter -->
    <div class="mb-3 search-small">
        <input type="text" id="search-input" class="form-control" placeholder="Search by Product or Category">
    </div>

    <!-- Product Table -->
    <table class="table table-bordered table-striped table-hover" id="product-table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Stock Quantity</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Define stock thresholds
            $lowStockThreshold = 10;
            $highStockThreshold = 100;

            foreach ($products as $product): 
                $stock = $product['stockquantity'];
                $isLowStock = $stock <= $lowStockThreshold;
                // Removed $isHighStock and $isMediumStock since we only care about low stock
            ?>
                <tr class="<?= $isLowStock ? 'table-danger' : '' ?>" 
                    data-product-name="<?= htmlspecialchars($product['productname']) ?>" 
                    data-category="<?= htmlspecialchars($product['categories']) ?>">
                    <td class="text-center">
                        <img src="<?= htmlspecialchars($product['imageURL']) ?>" alt="<?= htmlspecialchars($product['productname']) ?>" width="50" height="50" class="rounded-circle">
                    </td>
                    <td><?= htmlspecialchars($product['productname']) ?></td>
                    <td><?= htmlspecialchars($product['categories']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?>$</td>
                    <td>
                        <span class="stock-quantity"><?= htmlspecialchars($product['stockquantity']) ?></span>
                        <?php if ($isLowStock): ?>
                            <i class="bi bi-exclamation-triangle text-danger ms-2 icon-ring" title="Low Stock Alert"></i>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($product['descriptions']) ?></td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn border-0" type="button" id="dropdownMenuButton<?= $product['id'] ?>" data-bs-toggle="dropdown" data-bs-popper="static" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton<?= $product['id'] ?>">
                                <li><a class="dropdown-item" href="/products/edit/<?= urlencode($product['id']) ?>">
                                    <i class="bi bi-pencil"></i> Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="/products/delete/<?= urlencode($product['id']) ?>">
                                    <i class="bi bi-trash"></i> Delete</a></li>
                                <li><a class="dropdown-item" href="/checkout?product_id=<?= urlencode($product['id']) ?>">
                                    <i class="bi bi-cart"></i> Buy Now</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for Low Stock Details -->
<div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lowStockModalLabel">Low Stock Alerts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="lowStockDetails">
                <!-- Low stock items will be populated here by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- CSS (Moved from styles.css) -->

<!-- JavaScript (Moved from scripts.js) -->
<script>
// Real-time Search Functionality
document.getElementById('search-input').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase().trim();
    const searchWords = searchValue.split(/\s+/).filter(word => word.length > 0);
    const rows = document.querySelectorAll('#product-table tbody tr');

    rows.forEach(row => {
        const productName = row.getAttribute('data-product-name').toLowerCase();
        const category = row.getAttribute('data-category').toLowerCase();
        const matchesAllWords = searchWords.every(word => 
            productName.includes(word) || category.includes(word)
        );
        row.style.display = matchesAllWords ? '' : 'none';
    });
});

// Bell Notification Logic and Modal Population
document.addEventListener('DOMContentLoaded', function() {
    const lowStockRows = document.querySelectorAll('.table-danger');
    const bell = document.getElementById('notification-bell');
    const modalBody = document.getElementById('lowStockDetails');
    const notificationCount = document.getElementById('notification-count');
    const modal = document.getElementById('lowStockModal');

    // Store seen low stock items in localStorage
    let seenLowStockItems = JSON.parse(localStorage.getItem('seenLowStockItems')) || [];

    // Get current low stock items
    let currentLowStockItems = [];
    lowStockRows.forEach(row => {
        const productName = row.querySelector('td:nth-child(2)').textContent.trim();
        currentLowStockItems.push(productName);
    });

    // Check for new low stock items (not in seen list)
    const newLowStockItems = currentLowStockItems.filter(item => !seenLowStockItems.includes(item));
    const hasNewLowStock = newLowStockItems.length > 0;

    // If there are low stock items, show notification
    if (lowStockRows.length > 0) {
        // Only ring if there are new low stock items
        if (hasNewLowStock) {
            bell.classList.add('ring');
        }
        bell.classList.add('alert');
        notificationCount.textContent = lowStockRows.length;

        let modalContent = '';
        lowStockRows.forEach(row => {
            const productName = row.querySelector('td:nth-child(2)').textContent.trim();
            const stockQty = row.querySelector('td:nth-child(5) .stock-quantity').textContent.trim();
            const imageSrc = row.querySelector('td:nth-child(1) img').getAttribute('src');
            
            modalContent += `
                <div class="d-flex align-items-center mb-3">
                    <img src="${imageSrc}" alt="${productName}" width="50" height="50" class="rounded-circle me-3">
                    <div>
                        <strong>${productName}</strong><br>
                        Stock Quantity: ${stockQty} units
                    </div>
                </div>
            `;
        });

        modalBody.innerHTML = modalContent || '<p>No low stock items found.</p>';
    } else {
        modalBody.innerHTML = '<p>No low stock items found.</p>';
        notificationCount.textContent = '';
    }

    // When modal is opened, stop ringing and clear notification
    modal.addEventListener('shown.bs.modal', function () {
        bell.classList.remove('ring', 'alert');
        notificationCount.textContent = '';
        // Update seen low stock items
        seenLowStockItems = currentLowStockItems;
        localStorage.setItem('seenLowStockItems', JSON.stringify(seenLowStockItems));
    });
});

// Export to Excel Functionality
document.getElementById('export-excel').addEventListener('click', function() {
    const table = document.getElementById('product-table');
    const rows = table.querySelectorAll('tr');
    let csvContent = [];

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        let rowData = [];
        
        cols.forEach((col, index) => {
            if (index !== 0 && index !== 6) {
                let text = '';
                if (index === 4) {
                    text = col.querySelector('.stock-quantity') ? col.querySelector('.stock-quantity').textContent.trim() : col.textContent.trim();
                } else {
                    text = col.textContent.trim();
                }
                rowData.push(`"${text.replace(/"/g, '""')}"`);
            }
        });
        
        if (rowData.length > 0) {
            csvContent.push(rowData.join(','));
        }
    });

    const csvString = csvContent.join('\n');
    const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    
    link.setAttribute('href', url);
    link.setAttribute('download', 'products_export_' + new Date().toISOString().slice(0,10) + '.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>


<?php 
else: 
    header("Location: /login"); 
    exit();
endif; 
?>