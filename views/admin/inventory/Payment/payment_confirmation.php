<?php if (isset($_SESSION['user_id'])) : ?>
<div class="container my-5">
    <h2 class="mb-4">Payment Confirmation</h2>

    <?php if (!isset($order) || empty($order)) : ?>
        <div class="alert alert-danger">Order details are missing!</div>
    <?php else : ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <div class="d-flex align-items-center mb-3">
                    <?php if (!empty($order['imageURL'])) : ?>
                        <img src="<?= htmlspecialchars($order['imageURL']) ?>" 
                             alt="<?= htmlspecialchars($order['productname']) ?>" 
                             class="img-fluid rounded me-3" 
                             style="max-width: 100px;">
                    <?php else : ?>
                        <p class="text-danger">Image not available</p>
                    <?php endif; ?>
                    
                    <div>
                        <h6><?= htmlspecialchars($order['productname']) ?></h6>
                        <p class="text-muted mb-0">$<?= htmlspecialchars($order['price']) ?></p>
                    </div>
                </div>
                <hr>
                <p><strong>Total:</strong> $<?= htmlspecialchars($order['totalprice']) ?></p>
                <p><strong>Order Status:</strong> <?= htmlspecialchars($order['orderstatus']) ?></p>
                <p><strong>Payment Status:</strong> <?= htmlspecialchars($order['payments']) ?></p>

                <!-- Confirm Payment Button -->
                <form action="/order-success" method="POST">
                    <button type="submit" class="btn btn-success w-100">Confirm Payment</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php else : ?>
    <?php $this->redirect("/login"); ?>
<?php endif; ?>
