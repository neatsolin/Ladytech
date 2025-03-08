
<head>
    <style>
        .product-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product-image img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            /* background: #e9ecef; */
            padding: 10px;
            border-radius: 8px;
        }
        .star-rating {
            color: #ffc107;
        }
        .file-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
    <div class="product-container">
        <div class="product-image">
            <img src="/<?= htmlspecialchars($product['imageURL']) ?>" alt="Product Image">
        </div>
        <h4 class="mt-3">Drinking Water</h4>
        
        <form action="/products/update/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Name Product</label>
                <input type="text" name="productname" class="form-control" value="<?= $product['productname'] ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="<?= $product['price'] ?>">
            </div>
            <div class="mb-3 star-rating">
                &#9733; &#9733; &#9733; &#9733; &#9733;  <!-- Static 5-star rating -->
            </div>
            
            <div class="file-input-container">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/products" class="btn btn-secondary">Cancel</a>
                <input type="file" name="imageURL" class="form-control">
            </div>
        </form>
    </div>

