<?php
include "../config/db.php";
// Fetch only active products with stock > 0
$query = "SELECT * FROM products WHERE status='active' AND stock > 0";
$result = $conn->query($query);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>
<div class="container my-5">
    <div class="row g-4">
        <?php if(!empty($products)): ?>
        <?php foreach($products as $product): ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100">
                <img src=" <?php echo '../../'. $product['image']; ?>" class="card-img-top"
                    alt="<?php echo $product['product_name']; ?>" style="height:200px; object-fit:cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                    <p class="card-text"><?php echo substr($product['description'], 0, 60) . '...'; ?></p>

                    <?php if(!empty($product['discount_price'])): ?>
                    <p class="card-text">
                        <span class="text-muted text-decoration-line-through">$<?php echo $product['price']; ?></span>
                        <span class="fw-bold text-success ms-2">$<?php echo $product['discount_price']; ?></span>
                    </p>
                    <?php else: ?>
                    <p class="card-text fw-bold">$<?php echo $product['price']; ?></p>
                    <?php endif; ?>

                    <?php if($product['stock'] > 0): ?>
                    <a href="" class="btn btn-primary mt-auto">Add to Cart</a>
                    <?php else: ?>
                    <span class="badge bg-danger mt-auto">Out of Stock</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center">No products available.</p>
        <?php endif; ?>
    </div>
</div>


