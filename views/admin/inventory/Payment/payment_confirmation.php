<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : 
    // Retrieve the selected currency from the controller
    $currency = $currency ?? 'USD'; // Default to USD if not set
?>
<!-- Bootstrap 5 CSS -->

<div class="container my-5">
    <h2 class="mb-4">Payment Confirmation</h2>
    <div class="row">
        <!-- Order Summary -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <?php if (isset($order)) : ?>
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $order['imageURL'] ?>" alt="<?= $order['productname'] ?>" class="img-fluid rounded me-3" style="max-width: 100px;">
                            <div>
                                <h6><?= $order['productname'] ?></h6>
                                <p class="text-muted mb-0">
                                    <?= $currency === 'KHR' ? number_format($order['price'] * 4000) . ' KHR' : '$' . $order['price'] ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <p class="fw-bold">Total: 
                            <?= $currency === 'KHR' ? number_format($order['totalprice'] * 4000) . ' KHR' : '$' . $order['totalprice'] ?>
                        </p>
                    <?php else : ?>
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
                    <form action="/confirm-payment" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?? '' ?>">
                        <input type="hidden" name="amount" value="<?= $order['totalprice'] ?? '' ?>">

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="Visa">Visa</option>
                                <option value="MasterCard">MasterCard</option>
                                <option value="PayPal">PayPal</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success w-100">Confirm Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
    <?php $this->redirect("/login"); ?>
<?php endif; ?>