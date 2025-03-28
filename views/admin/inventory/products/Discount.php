<div class="container mt-4">
    <div class="card p-4">
        <h4>Add Discount</h4>
        <form class="my-3" action="/discount/store" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-name">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" 
                           value="<?= isset($product) && !empty($product['product_name']) ? htmlspecialchars($product['product_name']) : '' ?>" >
                </div>
                <div class="input-price">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" min="0" 
                           value="<?= isset($product) && !empty($product['price']) ? htmlspecialchars($product['price']) : 0 ?>">
                </div>  
                <div class="input-discount">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control" min="0" value="">
                </div>  
                <div class="input-startDate">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>  
                <div class="input-endDate">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>  
                <div class="total">
                    <h6>Total: <span id="total-price"><?= isset($product) && !empty($product['price']) ? htmlspecialchars($product['price']) : 0 ?></span></h6>
                </div>  
                <div class="input-group">
                    <label class="file" for="file">Product Image</label>
                    <div class="form-group">
                        <div class="image-upload">
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <div class="image-uploads">
                                <?php if (isset($product) && !empty($product['image'])): ?>
                                    <img src="../../../<?= htmlspecialchars($product['image']) ?>" alt="product" style="width: 120px; height: 100px;">
                                <?php else: ?>
                                    <h4 class="form-text text-muted">No image uploaded</h4>
                                <?php endif; ?>
                                <h4 class="form-text text-muted">Drag and drop a file to upload</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" onclick="window.history.back()">Back</button>
                </div>
            </div>
            <input type="hidden" name="product_id" value="<?= isset($product) && !empty($product['product_id']) ? htmlspecialchars($product['product_id']) : '' ?>">
            <input type="hidden" name="existing_image" value="<?= isset($product) && !empty($product['image']) ? htmlspecialchars($product['image']) : '' ?>">
        </form>

        <script>
            // Get DOM elements
            const priceInput = document.getElementById('price');
            const discountInput = document.getElementById('discount');
            const totalPrice = document.getElementById('total-price');

            // Function to calculate and update total
            function updateTotal() {
                const price = parseFloat(priceInput.value) || 0;
                const discount = parseFloat(discountInput.value) || 0;
                const discountedPrice = price - (price * (discount / 100));
                totalPrice.textContent = discountedPrice.toFixed(2);
            }

            // Add event listeners
            priceInput.addEventListener('input', updateTotal);
            discountInput.addEventListener('input', updateTotal);
        </script>
    </div>
</div>
