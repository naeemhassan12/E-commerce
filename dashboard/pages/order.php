<?php
include "../config/db.php";

$rows = [];

$query = $conn->query("
    SELECT 
        o.order_id,
        u.full_name,
        o.total_amount,
        o.discount_amount,
        o.final_amount,
        o.payment_method,
        o.created_at
    FROM orders o
    INNER JOIN users u ON o.user_id = u.user_id
    ORDER BY o.created_at ASC
");

if ($query && $query->num_rows > 0) {
  while ($row = $query->fetch_assoc()) {
    $rows[] = $row;
  }
}

// update item
if (isset($_POST['UpdateData'])) {
  $id = $_POST['order_id'];
  $total = $_POST['total_amount'];
  $final = $_POST['final_amount'];
  $payment = $_POST['payment_method'];

  $conn->query("
  UPDATE orders SET
    total_amount='$total',
    final_amount='$final',
    payment_method='$payment'
  WHERE order_id='$id'
");

  header("Location: index.php?page=order");
  exit;
}


?>


<div class="container-fluid px-4 mt-4">
  <h2 class="mb-4">Orders Management</h2>

  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">All Orders</h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>Order ID</th>
              <th>User Name</th>
              <th>Total Amount</th>
              <th>Discount Amount</th>
              <th>Final Amount</th>
              <th>Payment Method</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($rows)): ?>
              <?php foreach ($rows as $row): ?>
                <tr>
                  <td><?= $row['order_id'] ?></td>
                  <td><?= $row['full_name'] ?></td>
                  <td><?= $row['total_amount'] ?></td>
                  <td><?= $row['discount_amount'] ?></td>
                  <td><?= $row['final_amount'] ?></td>
                  <td><?= $row['payment_method'] ?></td>
                  <td><?= $row['created_at'] ?></td>
                  <td>
                    <!-- View -->
                    <button
                      class="btn btn-sm btn-primary viewBtn"
                      data-bs-toggle="modal"
                      data-bs-target="#viewOrderModal"
                      data-id="<?= $row['order_id'] ?>"
                      data-user="<?= $row['full_name'] ?>"
                      data-total="<?= $row['total_amount'] ?>"
                      data-discount="<?= $row['discount_amount'] ?>"
                      data-final="<?= $row['final_amount'] ?>"
                      data-payment="<?= $row['payment_method'] ?>"
                      data-date="<?= $row['created_at'] ?>">
                      View
                    </button>

                    <!-- Edit -->
                    <button
                      class="btn btn-sm btn-warning editBtn"
                      data-bs-toggle="modal"
                      data-bs-target="#editOrderModal"
                      data-id="<?= $row['order_id'] ?>"
                      data-total="<?= $row['total_amount'] ?>"
                      data-final="<?= $row['final_amount'] ?>"
                      data-payment="<?= $row['payment_method'] ?>">
                      Edit
                    </button>

                    <!-- Delete -->
                    <a
                      href="?id=<?= $row['order_id'] ?>"
                      onclick="return confirm('Are you sure you want to delete this order?')"
                      class="btn btn-sm btn-danger">
                      Delete
                    </a>
                  </td>

                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center">No Orders Found</td>
              </tr>
            <?php endif; ?>
          </tbody>


        </table>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="viewOrderModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th>Order ID</th>
            <td id="v_id"></td>
          </tr>
          <tr>
            <th>User Name</th>
            <td id="v_user"></td>
          </tr>
          <tr>
            <th>Total Amount</th>
            <td id="v_total"></td>
          </tr>
          <tr>
            <th>Discount</th>
            <td id="v_discount"></td>
          </tr>
          <tr>
            <th>Final Amount</th>
            <td id="v_final"></td>
          </tr>
          <tr>
            <th>Payment Method</th>
            <td id="v_payment"></td>
          </tr>
          <tr>
            <th>Order Date</th>
            <td id="v_date"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Edit Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="order_id" id="e_id">
          <div class="mb-3">
            <label>Total Amount</label>
            <input type="number" name="total_amount" id="e_total" class="form-control">
          </div>
          <div class="mb-3">
            <label>Final Amount</label>
            <input type="number" name="final_amount" id="e_final" class="form-control">
          </div>
          <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" id="e_payment" class="form-select">
              <option value="Cash on Delivery">Cash on Delivery</option>
              <option value="EasyPaisa">EasyPaisa</option>
              <option value="JazzCash">JazzCash</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="UpdateData" class="btn btn-success">Update Order</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelectorAll('.viewBtn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('v_id').innerText = this.dataset.id;
      document.getElementById('v_user').innerText = this.dataset.user;
      document.getElementById('v_total').innerText = this.dataset.total;
      document.getElementById('v_discount').innerText = this.dataset.discount;
      document.getElementById('v_final').innerText = this.dataset.final;
      document.getElementById('v_payment').innerText = this.dataset.payment;
      document.getElementById('v_date').innerText = this.dataset.date;
    });
  });
  document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('e_id').value = this.dataset.id;
      document.getElementById('e_total').value = this.dataset.total;
      document.getElementById('e_final').value = this.dataset.final;
      document.getElementById('e_payment').value = this.dataset.payment;
    });
  });
</script>