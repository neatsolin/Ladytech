<?php if (isset($_SESSION['user_id'])) : ?>
<div class="container my-5">
    <div class="text-center">
        <h2 class="mb-4">Order Successfully Placed!</h2>
        <?php if (isset($order)) : ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Thank you for your purchase!</h4>
                <p>Your order has been successfully placed. Order ID: <strong><?= $order['id'] ?></strong></p>
                <hr>
                <p class="mb-0">We will send you a confirmation email shortly.</p>
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Order details not found.
            </div>
        <?php endif; ?>
        <a href="/products" class="btn btn-primary">Continue Shopping</a>
    </div>
</div>
<?php else : ?>
    <?php $this->redirect("/login"); ?>
<?php endif; ?>
