<div class="container mt-5">
        <h2 class="mb-4">Add New Product</h2>
        
        <form action="/products/store" method="POST" enctype="multipart/form-data">
            <!-- Product Name -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productname" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="descriptions" rows="3" required></textarea>
            </div>

            <!-- Categories -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="categories" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="Drinking Water">Drinking Water</option>
                    <option value="Tissue">Tissue</option>
                    <option value="Feminine Hygiene">Feminine Hygiene</option>
                    <option value="House Hold Hygiene">House Hold Hygiene</option>
                    <option value="Oral Health">Oral Health</option>
                    <option value="Beverages">Beverages</option>
                    <option value="Soap">Soap</option>
                    <option value="Cooking Ingredients">Cooking Ingredients</option>
                    <option value="Snacks">Snacks</option>
                </select>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>

            <!-- Stock Quantity -->
            <div class="mb-3">
                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="stockquantity" required>
            </div>

            <!-- Image URL -->
            <div class="mb-3">
                <label for="imageURL" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="imageURL" name="imageURL" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Product</button>
            <a href="/products" class="btn btn-secondary">Cancel</a>
        </form>
    </div>