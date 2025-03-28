<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure cartItems is set, default to empty array if not
$cartItems = isset($data['cartItems']) ? $data['cartItems'] : [];
$error = isset($data['error']) ? $data['error'] : null;

// Calculate subtotal and total
$subtotal = 0;
foreach ($cartItems as $item) {
    $price = floatval($item['price'] ?? 0);
    $quantity = intval($item['quantity'] ?? 1);
    $subtotal += $price * $quantity;
}
$total = $subtotal; // Add logic for taxes, discounts, etc., if needed
?>

<div class="container my-5 p-4 bg-white shadow-lg rounded">
    <h2 class="fw-bold mb-4">Cart</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- Cart Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 5%;"></th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($cartItems)): ?>
                    <tr>
                        <td colspan="5" class="text-center">No items in the cart.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cartItems as $item): ?>
                        <?php
                        $productId = htmlspecialchars($item['product_id'] ?? '');
                        $productName = htmlspecialchars($item['productname'] ?? 'Unknown Product');
                        $imageURL = htmlspecialchars($item['imageURL'] ?? 'https://via.placeholder.com/50');
                        $price = floatval($item['price'] ?? 0);
                        $quantity = intval($item['quantity'] ?? 1);
                        $stockQuantity = intval($item['stockquantity'] ?? 0); // Get stock quantity
                        $itemSubtotal = $price * $quantity;
                        ?>
                        <tr data-product-id="<?php echo $productId; ?>" data-stock="<?php echo $stockQuantity; ?>">
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm" onclick="removeFromCart(<?php echo $productId; ?>)">×</button>
                            </td>
                            <td class="d-flex align-items-center">
                                <img src="<?php echo $imageURL; ?>" alt="<?php echo $productName; ?>" class="me-2" style="width: 50px; height: 50px;">
                                <a href="#" class="text-success text-decoration-none"><?php echo $productName; ?></a>
                            </td>
                            <td>$<?php echo number_format($price, 2); ?></td>
                            <td>
                                <input type="number" class="form-control w-50 quantity-input" value="<?php echo $quantity; ?>" min="1" onchange="updateQuantity(<?php echo $productId; ?>, this.value, this)">
                            </td>
                            <td class="item-subtotal">$<?php echo number_format($itemSubtotal, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Coupon Code Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Coupon code">
                <button class="btn btn-success" type="button">Apply Coupon</button>
            </div>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <button class="btn btn-outline-success" type="button" onclick="updateCart()">Update Cart</button>
        </div>
    </div>

    <!-- Cart Totals -->
    <div class="d-flex justify-content-end">
        <div class="card p-3" style="width: 50%;">
            <h4 class="fw-bold">Cart Totals<hr></h4>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th><hr>Subtotal <hr></th>
                        <td class="subtotal"><hr>$<?php echo number_format($subtotal, 2); ?> <hr></td>
                    </tr>
                    <tr>
                        <th><hr>Total <hr></th>
                        <td class="total"><hr>$<?php echo number_format($total, 2); ?> <hr></td>
                    </tr>
                </tbody>
            </table>
            <a href="/checkouts">
                <button class="btn btn-success btn-lg w-100">Proceed to Checkout</button>
            </a>
        </div>
    </div>
</div>

<script>
// Remove item from cart
async function removeFromCart(productId) {
    if (!productId) {
        alert('Invalid product ID');
        return;
    }

    try {
        const response = await fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${encodeURIComponent(productId)}`
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const result = await response.json();
        if (result.success) {
            alert('Item removed from cart');
            window.location.reload(); // Reload the page to reflect changes
        } else {
            alert(result.message || 'Failed to remove item from cart');
        }
    } catch (error) {
        console.error('Error removing from cart:', error);
        alert('An error occurred while removing from cart. Please try again.');
    }
}

// Update quantity and subtotal dynamically
async function updateQuantity(productId, quantity, inputElement) {
    if (!productId || quantity < 1) {
        alert('Invalid product ID or quantity');
        inputElement.value = inputElement.defaultValue; // Revert to original quantity
        return;
    }

    const row = document.querySelector(`tr[data-product-id="${productId}"]`);
    const stockQuantity = parseInt(row.dataset.stock) || 0;
    const originalQuantity = parseInt(inputElement.defaultValue) || 1;

    try {
        console.log('Sending update request:', { productId, quantity });
        const response = await fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${encodeURIComponent(productId)}&quantity=${encodeURIComponent(quantity)}`
        });

        console.log('Response status:', response.status);
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Response error text:', errorText);
            throw new Error('Network response was not ok: ' + response.status);
        }

        const result = await response.json();
        console.log('Response JSON:', result);
        if (result.success) {
            // Fetch updated cart items from the server
            const cartResponse = await fetch('/cart/items');
            if (!cartResponse.ok) {
                throw new Error('Failed to fetch updated cart items');
            }
            const cartResult = await cartResponse.json();
            if (!cartResult.success) {
                throw new Error('Failed to fetch updated cart items: ' + (cartResult.message || 'Unknown error'));
            }

            const cartItems = cartResult.data;

            // Update the quantity input for the specific item
            if (row) {
                const quantityInput = row.querySelector('.quantity-input');
                quantityInput.value = quantity;
                quantityInput.defaultValue = quantity; // Update the default value to the new quantity

                // Update the item subtotal in the table
                const priceText = row.querySelector('td:nth-child(3)').textContent; // Price column
                const price = parseFloat(priceText.replace('$', '')) || 0;
                const itemSubtotal = price * quantity;
                const itemSubtotalCell = row.querySelector('.item-subtotal');
                itemSubtotalCell.textContent = `$${itemSubtotal.toFixed(2)}`;
            }

            // Recalculate and update the overall subtotal and total
            let newSubtotal = 0;
            cartItems.forEach(item => {
                const price = parseFloat(item.price) || 0;
                const qty = parseInt(item.quantity) || 1;
                newSubtotal += price * qty;
            });

            const subtotalElement = document.querySelector('.subtotal');
            const totalElement = document.querySelector('.total');
            subtotalElement.innerHTML = `<hr>$${newSubtotal.toFixed(2)} <hr>`;
            totalElement.innerHTML = `<hr>$${newSubtotal.toFixed(2)} <hr>`; // Update total (add taxes/discounts if needed)
        } else {
            // Only show the alert if the message is "Not enough stock available"
            if (result.message === 'Not enough stock available') {
                alert('Not enough stock available');
                inputElement.value = stockQuantity; // Revert to the stock quantity
                inputElement.defaultValue = stockQuantity; // Update the default value
            } else {
                // For other errors, revert the quantity silently
                inputElement.value = originalQuantity;
            }
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
        // Revert the quantity on error
        inputElement.value = originalQuantity;
    }
}

// Update cart (optional, since we're updating dynamically)
function updateCart() {
    alert('Cart updated');
    window.location.reload();
}
</script>