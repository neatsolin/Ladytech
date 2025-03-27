
<div class="container my-5 p-4 bg-light shadow-sm rounded">
    <h2 class="fw-bold mb-4">Cart</h2>
    
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
                <tr>
                    <td class="text-center">
                        <button class="btn btn-outline-danger btn-sm">&times;</button>
                    </td>
                    <td class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" alt="Hand Sanitizer" class="me-2">
                        <a href="#" class="text-success text-decoration-none">Hand Sanitizer</a>
                    </td>
                    <td>£15.00</td>
                    <td>
                        <input type="number" class="form-control w-50" value="1" min="1">
                    </td>
                    <td>£15.00</td>
                </tr>
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
            <button class="btn btn-outline-success" type="button">Update Cart</button>
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
                    <td><hr>£15.00 <hr></td>
                </tr>
                <tr>
                    <th>
                        <hr> Total <hr>
                    </th>
                    <td>
                        <hr> £15.00 <hr>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="/checkouts">
            <button class="btn btn-success btn-lg w-100">Proceed to Checkout</button>
        </a>
    </div>
</div>

</div>