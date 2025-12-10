<?php 
  include "../config/db.php";
  $products = [];

  $query = "SELECT * FROM products";
  $result = mysqli_query($conn, $query);

  if($result && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $products[] = $row;
    }
  }
?>
<section id="products" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Products</h2>
        <div class="row g-4">
            <?php foreach($products as $product): ?>
            <div class="col-md-3">
                <div class="card product-card">
                    <img src="assets/image/<?= $product['productImage']; ?> " class="card-img-top"
                        alt="<?= $product['productName']; ?> gggggggggggg">

                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <?= $product['productName']; ?>
                        </h5>
                        <p class="card-text">
                            $<?= $product['productPrice']; ?>
                        </p>

                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>