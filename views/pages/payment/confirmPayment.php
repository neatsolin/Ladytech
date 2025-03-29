<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : 
    $currency = $data['currency'] ?? 'USD';
    $order = $data['order'] ?? null;
    $orderItems = $data['orderItems'] ?? [];
    $payment_method = $data['payment_method'] ?? null;
    $payment_type = $data['payment_type'] ?? 'Unknown'; // Use the payment_type passed from the controller
    $error = $data['error'] ?? null;
?>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h2 class="mb-4">Payment Confirmation</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <!-- Order Summary -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <?php if ($order && !empty($orderItems)): ?>
                        <?php foreach ($orderItems as $item): ?>
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?php echo htmlspecialchars($item['imageURL']); ?>" alt="<?php echo htmlspecialchars($item['productname']); ?>" class="img-fluid rounded me-3" style="max-width: 100px;">
                                <div>
                                    <h6><?php echo htmlspecialchars($item['productname']); ?></h6>
                                    <p class="text-muted mb-0">
                                        Quantity: <?php echo htmlspecialchars($item['quantity']); ?>
                                    </p>
                                    <p class="text-muted mb-0">
                                        Price: <?php echo $currency === 'KH Riel' ? number_format($item['price'] * 4000) . ' KH Riel' : '$' . number_format($item['price'], 2); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <p><strong>Shipping Location:</strong> <?php echo htmlspecialchars($order['location_name']); ?></p>
                        <p><strong>Order Status:</strong> <?php echo htmlspecialchars($order['orderstatus']); ?></p>
                        <p class="fw-bold">Total: 
                            <?php echo $currency === 'KH Riel' ? number_format($order['totalprice'] * 4000) . ' KH Riel' : '$' . number_format($order['totalprice'], 2); ?>
                        </p>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            No order selected. <a href="/products" class="alert-link">Go back to products</a>.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Confirm Payment Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Confirm Payment</h5>
                    <?php if ($payment_method): ?>
                        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($payment_type); ?> (ending in <?php echo htmlspecialchars(substr($payment_method['card_number'], -4)); ?>)</p>
                        <p><strong>Cardholder Name:</strong> <?php echo htmlspecialchars($payment_method['card_holder_name']); ?></p>
                        <p><strong>Expiry Date:</strong> <?php echo htmlspecialchars($payment_method['expiry_date']); ?></p>
                    <?php else: ?>
                        <p class="text-danger">No payment method found.</p>
                    <?php endif; ?>
                    <form action="/confirm-payment" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id'] ?? ''); ?>">
                        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($order['totalprice'] ?? ''); ?>">
                        <button type="submit" class="btn btn-success w-100">Confirm Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: ?>
    <?php $this->redirect("/login"); ?>
<?php endif; ?>