<?php
// In the form submission logic (e.g., in the controller)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Save the selected currency to the session
    $_SESSION['currency'] = $_POST['currency']; // Add this line

    // Process the rest of the form data...
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
                                <p class="text-muted mb-0" id="product_price"><?= $product['price'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <!-- Quantity Input -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" onchange="updateTotalPrice()">
                        </div>
                        <!-- Total Price Display -->
                        <p class="fw-bold">Total: <span id="total_price"><?= $product['price'] ?></span></p>
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
                        <input type="hidden" id="total_price_input" name="total_price" value="<?= $product['price'] ?? '' ?>">
                        <input type="hidden" id="currency_input" name="currency" value="USD"> <!-- Add hidden currency input -->

                        <!-- Currency Selection -->
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-control" id="currency" name="currency" onchange="updateTotalPrice()" required>
                                <option value="USD">USD</option>
                                <option value="KHR">KH Riel</option>
                            </select>
                        </div>

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

<script>
    // Get the initial product price from PHP
    const productPriceUSD = <?= $product['price'] ?? 0 ?>;
    const exchangeRate = 4000; // 1 USD = 4000 KHR

    // Function to update the total price based on quantity and currency
    function updateTotalPrice() {
        const quantity = document.getElementById('quantity').value;
        const currency = document.getElementById('currency').value;

        // Calculate total price in USD
        const totalPriceUSD = productPriceUSD * quantity;

        // Convert to KH Riel if selected
        const totalPrice = currency === 'KHR' ? totalPriceUSD * exchangeRate : totalPriceUSD;

        // Format the total price based on the selected currency
        const formattedTotalPrice = currency === 'KHR' ? 
            `${totalPrice.toLocaleString()} KHR` : 
            `$${totalPrice.toFixed(2)}`;

        // Format the product price based on the selected currency
        const formattedProductPrice = currency === 'KHR' ? 
            `${productPriceUSD * exchangeRate} KHR` : 
            `$${productPriceUSD}`;

        // Update the displayed product price
        document.getElementById('product_price').textContent = formattedProductPrice;

        // Update the displayed total price
        document.getElementById('total_price').textContent = formattedTotalPrice;

        // Update the hidden input for the total price (to be sent in the form)
        document.getElementById('total_price_input').value = totalPriceUSD.toFixed(2); // Always store in USD
    }

    // Initialize the total price on page load
    updateTotalPrice();
</script>
<?php else : ?>
    <?php $this->redirect("/login"); ?>
<?php endif; ?>