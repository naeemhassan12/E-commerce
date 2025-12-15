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
                                        <button 
                    class="btn btn-primary mt-auto"
                    data-bs-toggle="modal"
                    data-bs-target="#checkoutModal"
                    data-product-id="<?php echo $product['id']; ?>"
                    >
                    Add to Cart
                    </button>
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

<?php  
include "../config/db.php";

if(isset($_POST['PlaceOrder']))
{
    // user form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $address = $_POST['address'];

    // order form data
    $total_amount = $_POST['total_amount'];
    $discount_amount = $_POST['discount_amount'];
    $final_amount = $_POST['final_amount'];
    $payment_method = $_POST['payment_method'];
    $shipping_address = $_POST['shipping_address'];
    $notes = $_POST['notes'];

    // Insert user
    $user_query = "INSERT INTO users (full_name,email,phone,city,state,postal_code,address) 
                   VALUES ('$full_name','$email','$phone','$city','$state','$postal_code','$address')";
    $user_result = mysqli_query($conn, $user_query);

    if($user_result){
        // Get inserted user id
        $user_id = mysqli_insert_id($conn);

        // Insert order
        $order_query = "INSERT INTO `orders` (user_id,total_amount,discount_amount,final_amount,payment_method,shipping_address,notes) 
                        VALUES ('$user_id','$total_amount','$discount_amount','$final_amount','$payment_method','$shipping_address','$notes')";
        $order_result = mysqli_query($conn, $order_query);

        if($order_result){
            echo "Order placed successfully!";
        } else {
            echo "Order insertion failed: ".mysqli_error($conn);
        }

    } else {
        echo "User insertion failed: ".mysqli_error($conn);
    }
}
?>

<!-- ================= PROFESSIONAL CHECKOUT MODAL ================= -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Checkout</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4">
        <form id="checkoutForm" method="POST">

          <!-- ================= USER INFORMATION ================= -->
          <h5 class="mb-3 text-primary">User Information</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label class="form-label fw-bold">Full Name</label>
              <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold">Phone</label>
              <input type="text" name="phone" class="form-control" placeholder="Enter your phone number">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold">City</label>
              <input type="text" name="city" class="form-control" placeholder="City">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold">State</label>
              <input type="text" name="state" class="form-control" placeholder="State">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold">Postal Code</label>
              <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
            </div>
            <div class="col-12">
              <label class="form-label fw-bold">Address</label>
              <textarea name="address" class="form-control" placeholder="Shipping Address" rows="2" required></textarea>
            </div>
          </div>

          <!-- ================= ORDER INFORMATION ================= -->
          <!-- <h5 class="mb-3 text-primary">Order Information</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <label class="form-label fw-bold">Total Amount</label>
              <input type="number" name="total_amount" class="form-control" placeholder="0.00" required>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">Discount</label>
              <input type="number" name="discount_amount" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">Final Amount</label>
              <input type="number" name="final_amount" class="form-control" placeholder="0.00" required>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">Payment Method</label>
              <select name="payment_method" class="form-select" required>
                <option value="cash_on_delivery">Cash on Delivery</option>
                <option value="easypaisa">EasyPaisa</option>
                <option value="jazzcash">JazzCash</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label fw-bold">Shipping Address</label>
              <textarea name="shipping_address" class="form-control" placeholder="Enter your shipping address" rows="2" required></textarea>
            </div>
            <div class="col-6">
              <label class="form-label fw-bold">Notes / Instructions</label>
              <textarea name="notes" class="form-control" placeholder="Additional instructions" rows="2"></textarea>
            </div>
          </div> -->
          <h5 class="mb-3 text-primary">Order Information</h5>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <label class="form-label fw-bold">Total Amount</label>
    <input 
      type="number" 
      name="total_amount" 
      id="totalAmount"
      class="form-control" 
      placeholder="0.00"
      oninput="calculateFinalAmount()"
      required
    >
  </div>

  <div class="col-md-3">
    <label class="form-label fw-bold">Discount</label>
    <input 
      type="number" 
      name="discount_amount" 
      id="discountAmount"
      class="form-control" 
      placeholder="0.00"
      oninput="calculateFinalAmount()"
    >
  </div>

  <div class="col-md-3">
    <label class="form-label fw-bold">Final Amount</label>
    <input 
      type="number" 
      name="final_amount" 
      id="finalAmount"
      class="form-control" 
      placeholder="0.00"
      readonly
      required
    >
  </div>

  <div class="col-md-3">
    <label class="form-label fw-bold">Payment Method</label>
    <select name="payment_method" class="form-select" required>
      <option value="cash_on_delivery">Cash on Delivery</option>
      <option value="easypaisa">EasyPaisa</option>
      <option value="jazzcash">JazzCash</option>
    </select>
  </div>

  <div class="col-6">
    <label class="form-label fw-bold">Shipping Address</label>
    <textarea 
      name="shipping_address" 
      class="form-control" 
      rows="2" 
      required
    ></textarea>
  </div>

  <div class="col-6">
    <label class="form-label fw-bold">Notes / Instructions</label>
    <textarea 
      name="notes" 
      class="form-control" 
      rows="2"
    ></textarea>
  </div>
</div>


          <!-- ================= PLACE ORDER BUTTON ================= -->
          <div class="d-grid">
            <button type="submit" name="PlaceOrder" class="btn btn-success btn-lg">
              Confirm & Place Order
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>


<script>
function calculateFinalAmount() {
  const total = parseFloat(document.getElementById('totalAmount').value) || 0;
  const discount = parseFloat(document.getElementById('discountAmount').value) || 0;

  const finalAmount = total - discount;
  document.getElementById('finalAmount').value = finalAmount.toFixed(2);
}
</script>



