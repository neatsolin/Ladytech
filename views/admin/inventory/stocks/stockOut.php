<h1>STOCK OUT</h1>
<!-- Stock History Table -->
<div class="card p-4 shadow mt-4">
    <h5 class="mb-3">Stock History</h5>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Type</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="stockTableBody">
            <?php if (!empty($data['stockHistory'])): ?>
                <?php foreach ($data['stockHistory'] as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity_out']); ?></td>
                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                        <td><?php echo number_format($row['total_price'], 2); ?>$</td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No stock out history available.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Stock Level Table -->
<div class="card p-4 shadow mt-4">
    <h5 class="mb-3">Stock Levels</h5>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Remaining Quantity</th>
            </tr>
        </thead>
        <tbody id="stockLevelBody">
            <?php if (!empty($data['stockLevels'])): ?>
                <?php foreach ($data['stockLevels'] as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product']); ?></td>
                        <td><?php echo htmlspecialchars($row['remaining_quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="2">No stock levels available.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>