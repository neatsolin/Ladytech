<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
<!-- Bootstrap 5 CSS -->

<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>
    <div class="row">
        <!-- Product Summary -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <?php if (isset($product)) : ?>
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $product['imageURL'] ?>" alt="<?= $product['productname'] ?>" class="img-fluid rounded me-3" style="max-width: 100px;">
                            <div>
                                <h6><?= $product['productname'] ?></h6>
                                <p class="text-muted mb-0">$<?= $product['price'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <p class="fw-bold">Total: $<?= $product['price'] ?></p>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            No product selected. <a href="/products" class="alert-link">Go back to products</a>.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Shipping & Payment Details</h5>
                    <form action="/checkout/process" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?? '' ?>">
                        <input type="hidden" name="total_price" value="<?= $product['price'] ?? '' ?>">

                        <!-- Shipping Location Dropdown -->
                        <div class="mb-3">
                            <label for="location_id" class="form-label">Shipping Location</label>
                            <select class="form-control" id="location_id" name="location_id" required>
                                <?php foreach ($locations as $location) : ?>
                                    <option value="<?= $location['id'] ?>"><?= $location['location_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Card Details -->
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="card_expiry" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" id="card_expiry" name="card_expiry" placeholder="MM/YY" required>
                            </div>
                            <div class="col-md-6">
                                <label for="card_cvc" class="form-label">CVC</label>
                                <input type="text" class="form-control" id="card_cvc" name="card_cvc" placeholder="123" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
    <?php $this->redirect("/login"); ?>
<?php endif; ?>