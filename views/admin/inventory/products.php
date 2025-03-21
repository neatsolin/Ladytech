<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container my-4">
    <!-- Top Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/add-product" class="btn btn-primary">+ Add New Product</a>
        <a href="import-products.html" class="btn btn-secondary">Import Products</a>
    </div>

    <!-- Search Filter -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search Products name">
        <button class="btn btn-outline-secondary">Filter</button>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Stock Quantity</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td class="text-center">
                        <img src="<?= htmlspecialchars($product['imageURL']) ?>" alt="<?= htmlspecialchars($product['productname']) ?>" width="50" height="50" class="rounded-circle">
                    </td>
                    <td><?= htmlspecialchars($product['productname']) ?></td>
                    <td><?= htmlspecialchars($product['categories']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?>$</td>
                    <td><?= htmlspecialchars($product['stockquantity']) ?></td>
                    <td><?= htmlspecialchars($product['descriptions']) ?></td>
                    <td class="text-center">
                            <!-- Dropdown for actions -->
                        <div class="dropdown">
                            <button class="btn border-0" type="button" id="dropdownMenuButton<?= $product['id'] ?>" data-bs-toggle="dropdown" data-bs-popper="static" aria-expanded="false">
                                <i class="material-icons">more_vert</i> <!-- Three-dot icon -->
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton<?= $product['id'] ?>">
                                <li><a class="dropdown-item" href="/products/edit/<?= urlencode($product['id']) ?>">
                                    <i class="material-icons">edit</i> Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="/products/delete/<?= urlencode($product['id']) ?>">
                                    <i class="material-icons">delete</i> Delete</a></li>
                                <li><a class="dropdown-item" href="/checkout?product_id=<?= urlencode($product['id']) ?>">
                                    <i class="material-icons">shopping_cart</i> Buy Now</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php 
else: 
    header("Location: /login"); 
    exit();
endif; 
?>