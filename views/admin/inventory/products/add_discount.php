<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: /F_login");
    exit();
}

$error = isset($data['error']) ? $data['error'] : null;
$success = isset($data['success']) ? $data['success'] : null;
?>

<title>Add Discount Code</title>
<div class="container mt-5">
    <h2 class="mb-4">Create Discount Code</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>
    <form action="/products/store-discount" method="POST">
        <div class="mb-3">
            <label for="code" class="form-label">Discount Code</label>
            <input type="text" class="form-control" id="code" name="code" placeholder="e.g., SPECIAL20" required>
        </div>
        <div class="mb-3">
            <label for="discount_type" class="form-label">Discount Type</label>
            <select class="form-select" id="discount_type" name="discount_type" required>
                <option value="percentage">Percentage (%)</option>
                <option value="fixed">Fixed Amount ($)</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="discount_value" class="form-label">Discount Value</label>
            <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value" placeholder="e.g., 20 for 20% or $20" required>
        </div>
        <div class="mb-3">
            <label for="max_usage" class="form-label">Max Usage (Optional)</label>
            <input type="number" class="form-control" id="max_usage" name="max_usage" placeholder="e.g., 100 (leave blank for unlimited)">
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date (Optional)</label>
            <input type="datetime-local" class="form-control" id="expiry_date" name="expiry_date">
        </div>
        <button type="submit" class="btn btn-primary">Create Discount Code</button>
    </form>
</div>