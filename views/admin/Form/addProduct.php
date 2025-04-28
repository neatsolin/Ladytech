<div class="container-addproduct mt-5">
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
    <style>
        .container-addproduct  {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 700px;
        margin: 50px auto;
    }

    h2 {
        font-weight: 700;
        color:rgb(29, 54, 243);
        text-align: center;
    }

    label.form-label {
        font-weight: 500;
        color: #555555;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solidrgb(88, 156, 224);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 5px rgba(6, 61, 144, 0.3);
    }

    button.btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
    }

    button.btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 10px 20px;
        margin-left: 10px;
        font-weight: 500;
    }

    .mb-3 {
        margin-bottom: 1.5rem;
    }
    @media (max-width: 768px) {
       form{
        padding: 20px;
       }
    }

    </style>