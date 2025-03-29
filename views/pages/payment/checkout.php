<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /F_login");
    exit();
}

// Save the selected currency to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['currency'])) {
    $_SESSION['currency'] = $_POST['currency'];
}

// Ensure cartItems, user, and locations are set
$cartItems = isset($data['cartItems']) ? $data['cartItems'] : [];
$user = isset($data['user']) ? $data['user'] : null;
$locations = isset($data['locations']) ? $data['locations'] : [];
$error = isset($data['error']) ? $data['error'] : null;

// Calculate initial subtotal
$subtotal = 0;
foreach ($cartItems as $item) {
    $price = floatval($item['price'] ?? 0);
    $quantity = intval($item['quantity'] ?? 1);
    $subtotal += $price * $quantity;
}
?>

<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <!-- Cart Items Section -->
              <div class="col-lg-7">
                <h5 class="mb-3"><a href="/product" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping Cart</p>
                    <p class="mb-0">You have <?php echo count($cartItems); ?> items in your cart</p>
                  </div>
                </div>

                <?php if (empty($cartItems)): ?>
                  <div class="alert alert-warning" role="alert">
                    No items in your cart. <a href="/product" class="alert-link">Go back to products</a>.
                  </div>
                <?php else: ?>
                  <?php foreach ($cartItems as $item): ?>
                    <?php
                    $productId = htmlspecialchars($item['product_id'] ?? '');
                    $productName = htmlspecialchars($item['productname'] ?? 'Unknown Product');
                    $imageURL = htmlspecialchars($item['imageURL'] ?? 'https://via.placeholder.com/65');
                    $price = floatval($item['price'] ?? 0);
                    $quantity = intval($item['quantity'] ?? 1);
                    $itemSubtotal = $price * $quantity;
                    ?>
                    <div class="card mb-3" data-product-id="<?php echo $productId; ?>">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="d-flex flex-row align-items-center">
                            <div>
                              <img src="<?php echo $imageURL; ?>" class="img-fluid rounded-3" alt="<?php echo $productName; ?>" style="width: 65px;">
                            </div>
                            <div class="ms-3">
                              <h5><?php echo $productName; ?></h5>
                              <p class="small mb-0"><?php echo htmlspecialchars($item['descriptions'] ?? 'N/A'); ?></p>
                            </div>
                          </div>
                          <div class="d-flex flex-row align-items-center">
                            <div style="width: 50px;">
                              <h5 class="fw-normal mb-0"><?php echo $quantity; ?></h5>
                            </div>
                            <div style="width: 80px;">
                              <h5 class="mb-0 product-price" data-price-usd="<?php echo $itemSubtotal; ?>">$<?php echo number_format($itemSubtotal, 2); ?></h5>
                            </div>
                            <a href="#" class="remove-item" data-product-id="<?php echo $productId; ?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <!-- Card Details Section -->
              <div class="col-lg-5">
                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card Details</h5>
                      <?php if ($user && isset($user['profile'])): ?>
                        <img src="<?php echo htmlspecialchars($user['profile']); ?>" class="img-fluid rounded-3" style="width: 45px;" alt="<?php echo htmlspecialchars($user['username'] ?? 'User'); ?> Avatar">
                      <?php else: ?>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" class="img-fluid rounded-3" style="width: 45px;" alt="Default Avatar">
                      <?php endif; ?>
                    </div>

                    <!-- User Information -->
                    <?php if ($error): ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                      </div>
                    <?php elseif (!$user): ?>
                      <div class="alert alert-danger" role="alert">
                        User information not found. Please <a href="/F_login" class="alert-link">log in</a> again.
                        <br>
                        <small>Debug: Session user_id = <?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : 'Not set'; ?></small>
                      </div>
                    <?php else: ?>
                      <div class="mb-3">
                        <h6 class="text-white">User Information</h6>
                        <p class="small mb-0"><strong>Name:</strong> <?php echo htmlspecialchars($user['username'] ?? 'N/A'); ?></p>
                        <p class="small mb-0"><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></p>
                        <p class="small mb-0"><strong>Address:</strong> <?php echo htmlspecialchars($user['address'] ?? 'N/A'); ?></p>
                      </div>
                    <?php endif; ?>

                    <!-- Form for Payment and Checkout -->
                    <form action="/checkout/process" method="POST" id="checkout-form">
                      <!-- Hidden inputs for cart items -->
                      <div id="cart-items-inputs">
                        <?php foreach ($cartItems as $item): ?>
                          <div class="cart-item-inputs" data-product-id="<?php echo htmlspecialchars($item['product_id']); ?>">
                            <input type="hidden" name="cart_items[<?php echo htmlspecialchars($item['product_id']); ?>][product_id]" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                            <input type="hidden" name="cart_items[<?php echo htmlspecialchars($item['product_id']); ?>][quantity]" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                          </div>
                        <?php endforeach; ?>
                      </div>
                      <input type="hidden" id="total_price_input" name="total_price" value="<?php echo $subtotal; ?>">
                      <input type="hidden" id="currency_input" name="currency" value="USD">

                      <!-- Card Type -->
                      <p class="small mb-2">Card type</p>
                      <a href="#!" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                      <div class="mt-4">
                        <!-- Cardholder's Name -->
                        <div data-mdb-input-init class="form-outline form-white mb-4">
                          <input type="text" id="typeName" name="card_holder_name" class="form-control form-control-lg" size="17" placeholder="Cardholder's Name" required />
                          <label class="form-label" for="typeName">Cardholder's Name</label>
                        </div>

                        <!-- Card Number -->
                        <div data-mdb-input-init class="form-outline form-white mb-4">
                          <input type="text" id="typeText" name="card_number" class="form-control form-control-lg" size="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" required />
                          <label class="form-label" for="typeText">Card Number</label>
                        </div>

                        <!-- Expiration and CVV -->
                        <div class="row mb-4">
                          <div class="col-md-6">
                            <div data-mdb-input-init class="form-outline form-white">
                              <input type="text" id="typeExp" name="card_holder_name" name="expiry_date" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" minlength="7" maxlength="7" required />
                              <label class="form-label" for="typeExp">Expiration</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div data-mdb-input-init class="form-outline form-white">
                              <input type="password" id="typeText" name="cvv" class="form-control form-control-lg" placeholder="●●●" size="1" minlength="3" maxlength="3" required />
                              <label class="form-label" for="typeText">Cvv</label>
                            </div>
                          </div>
                        </div>

                        <!-- Order Status Selection -->
                        <div class="mb-3">
                          <label for="order_status" class="form-label">Order Status</label>
                          <select class="form-control" id="order_status" name="order_status" required>
                            <option value="Pending">Pending</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Canceled">Canceled</option>
                          </select>
                        </div>

                        <!-- Currency Selection -->
                        <div class="mb-3">
                          <label for="currency" class="form-label">Currency</label>
                          <select class="form-control" id="currency" name="currency" onchange="updateTotalPrice()" required>
                            <option value="USD">USD</option>
                            <option value="KH Riel">KH Riel</option>
                          </select>
                        </div>

                        <!-- Shipping Location Dropdown -->
                        <div class="mb-3">
                          <label for="location_id" class="form-label">Shipping Location</label>
                          <select class="form-control" id="location_id" name="location_id" required>
                            <?php foreach ($locations as $location): ?>
                              <option value="<?php echo htmlspecialchars($location['id']); ?>"><?php echo htmlspecialchars($location['location_name']); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <hr class="my-4">

                      <!-- Subtotal, Shipping, and Total -->
                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2 subtotal">$<?php echo number_format($subtotal, 2); ?></p>
                      </div>

                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Shipping</p>
                        <p class="mb-2 shipping">$20.00</p>
                      </div>

                      <div class="d-flex justify-content-between mb-4">
                        <p class="mb-2">Total(Incl. taxes)</p>
                        <p class="mb-2 total">$<?php echo number_format($subtotal + 20, 2); ?></p>
                      </div>

                      <!-- Submit Button -->
                      <div>
                        <button type="submit" class="btn btn-info w-100">Place Order</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
const exchangeRate = 4000; // 1 USD = 4000 KHR

// Function to update the total price based on currency (no quantity changes)
function updateTotalPrice() {
  const currency = document.getElementById('currency').value;
  let totalPriceUSD = 0;

  // Get all cart items
  const cartItems = document.querySelectorAll('.card.mb-3[data-product-id]');
  cartItems.forEach(item => {
    const itemSubtotalUSD = parseFloat(item.querySelector('.product-price').dataset.priceUsd) || 0;

    // Update the product price display based on currency
    const productPriceElement = item.querySelector('.product-price');
    const formattedItemSubtotal = currency === 'KH Riel' ? 
      `${(itemSubtotalUSD * exchangeRate).toLocaleString()} KH Riel` : 
      `$${itemSubtotalUSD.toFixed(2)}`;
    productPriceElement.textContent = formattedItemSubtotal;

    // Add to total price in USD
    totalPriceUSD += itemSubtotalUSD;
  });

  // Calculate shipping and total (shipping remains in USD for simplicity, adjust if needed)
  const shippingUSD = 20;
  const totalPriceWithShippingUSD = totalPriceUSD + shippingUSD;

  // Convert total price to selected currency for display
  const totalPrice = currency === 'KH Riel' ? totalPriceUSD * exchangeRate : totalPriceUSD;
  const totalPriceWithShipping = currency === 'KH Riel' ? totalPriceWithShippingUSD * exchangeRate : totalPriceWithShippingUSD;
  const shippingDisplay = currency === 'KH Riel' ? `${(shippingUSD * exchangeRate).toLocaleString()} KH Riel` : `$${shippingUSD.toFixed(2)}`;

  const formattedTotalPrice = currency === 'KH Riel' ? 
    `${totalPrice.toLocaleString()} KH Riel` : 
    `$${totalPrice.toFixed(2)}`;
  const formattedTotalPriceWithShipping = currency === 'KH Riel' ? 
    `${totalPriceWithShipping.toLocaleString()} KH Riel` : 
    `$${totalPriceWithShippingUSD.toFixed(2)}`;

  // Update the displayed subtotal, shipping, and total
  document.querySelector('.subtotal').textContent = formattedTotalPrice;
  document.querySelector('.shipping').textContent = shippingDisplay;
  document.querySelector('.total').textContent = formattedTotalPriceWithShipping;

  // Update the hidden input for the total price (always in USD)
  document.getElementById('total_price_input').value = totalPriceWithShippingUSD.toFixed(2);

  // Update the hidden input for the currency
  document.getElementById('currency_input').value = currency;

  // Update cart item count
  document.querySelector('.mb-0').textContent = `You have ${cartItems.length} items in your cart`;
}

// Function to remove an item from the cart
function removeFromCart(productId) {
  fetch('/cart/remove', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ product_id: productId }),
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Remove the item from the DOM
      const itemElement = document.querySelector(`.card.mb-3[data-product-id="${productId}"]`);
      if (itemElement) {
        itemElement.remove();
      }

      // Remove the corresponding hidden inputs from the form
      const inputElement = document.querySelector(`.cart-item-inputs[data-product-id="${productId}"]`);
      if (inputElement) {
        inputElement.remove();
      }

      // Update the total price and cart count
      updateTotalPrice();

      // If no items remain, show the empty cart message
      const remainingItems = document.querySelectorAll('.card.mb-3[data-product-id]');
      if (remainingItems.length === 0) {
        const cartSection = document.querySelector('.col-lg-7');
        cartSection.innerHTML = `
          <h5 class="mb-3"><a href="/product" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
          <hr>
          <div class="alert alert-warning" role="alert">
            No items in your cart. <a href="/product" class="alert-link">Go back to products</a>.
          </div>
        `;
        // Disable the Place Order button when cart is empty
        document.querySelector('.btn.btn-info').disabled = true;
      }
    } else {
      alert('Failed to remove item: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    console.error('Error removing item:', error);
    alert('An error occurred while removing the item.');
  });
}

// Add event listeners to all remove buttons
document.querySelectorAll('.remove-item').forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();
    const productId = this.getAttribute('data-product-id');
    removeFromCart(productId);
  });
});

// Initialize the total price on page load
updateTotalPrice();
</script>