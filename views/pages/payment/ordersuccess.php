<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : 
    $order = $data['order'] ?? null;
    $orderItems = $data['orderItems'] ?? [];
    $error = $data['error'] ?? null;
?>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h2 class="mb-4">Order Confirmation</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Thank You for Your Order!</h5>
            <p>Your order has been successfully placed. You will receive a confirmation email shortly.</p>
            <?php if ($order && !empty($orderItems)): ?>
                <h6>Order Details</h6>
                <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?></p>
                <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['orderdate']); ?></p>
                <p><strong>Order Status:</strong> <?php echo htmlspecialchars($order['orderstatus']); ?></p>
                <p><strong>Shipping Location:</strong> <?php echo htmlspecialchars($order['location_name']); ?></p>
                <p><strong>Total:</strong> 
                    <?php echo $order['payments'] === 'KH Riel' ? number_format($order['totalprice'] * 4000) . ' KH Riel' : '$' . number_format($order['totalprice'], 2); ?>
                </p>
                <hr>
                <h6>Order Items</h6>
                <?php foreach ($orderItems as $item): ?>
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?php echo htmlspecialchars($item['imageURL']); ?>" alt="<?php echo htmlspecialchars($item['productname']); ?>" class="img-fluid rounded me-3" style="max-width: 100px;">
                        <div>
                            <h6><?php echo htmlspecialchars($item['productname']); ?></h6>
                            <p class="text-muted mb-0">Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                            <p class="text-muted mb-0">
                                Price: <?php echo $order['payments'] === 'KH Riel' ? number_format($item['price'] * 4000) . ' KH Riel' : '$' . number_format($item['price'], 2); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    No order details available.
                </div>
            <?php endif; ?>
            <a href="/product" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
</div>
<?php else: ?>
    <?php $this->redirect("/F_login"); ?>
<?php endif; ?>