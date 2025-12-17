<?php
include "../config/db.php";

if (isset($_POST['DailyReports'])) {
  $ReportDate    = $_POST['report_date'];
  $TotalOrder    = $_POST['total_orders'];
  $TotalSales    = $_POST['total_sales'];
  $TotalDiscount = $_POST['total_discount'];

  $stmt = "INSERT INTO daily_reports 
        (report_date, total_orders, total_sales, total_discount) 
        VALUES ('$ReportDate', '$TotalOrder', '$TotalSales', '$TotalDiscount')";

  $result = mysqli_query($conn, $stmt);

  if ($result) {
    echo "<div class='alert alert-success'>Daily Report Added Successfully!</div>";
  } else {
    echo "<div class='alert alert-danger'>Failed to Add Daily Report</div>";
  }
}

$query   = "SELECT * FROM daily_reports ORDER BY report_date ASC";
$results = mysqli_query($conn, $query);
?>

<div class="container my-5">
  <h2 class="mb-4">Daily Reports</h2>

  <!-- Add Report Button -->
  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addReportModal">
    Add Report
  </button>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Report ID</th>
        <th>Report Date</th>
        <th>Total Orders</th>
        <th>Total Sales</th>
        <th>Total Discount</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php if (mysqli_num_rows($results) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($results)): ?>
          <tr>
            <td><?= $row['report_id']; ?></td>
            <td><?= $row['report_date']; ?></td>
            <td><?= $row['total_orders']; ?></td>
            <td><?= $row['total_sales']; ?></td>
            <td><?= $row['total_discount']; ?></td>
            <td><?= $row['created_at']; ?></td>
            <td><?= $row['updated_at']; ?></td>
            <!-- <td>
              <button class="btn btn-info btn-sm">View</button>
            </td> -->
            <td>
              <button
                class="btn btn-sm btn-primary viewBtn"
                data-bs-toggle="modal"
                data-bs-target="#viewReportModal"
                data-id="<?= $row['report_id'] ?>"
                data-date="<?= $row['report_date'] ?>"
                data-total="<?= $row['total_orders'] ?>"
                data-discount="<?= $row['total_discount'] ?>"
                data-date="<?= $row['created_at'] ?>">
                View
              </button>

            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" class="text-center">No Reports Found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- View Report Modal -->
<div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewReportModalLabel">Report Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <table class="table table-bordered">
          <tr>
            <th>Report ID</th>
            <td id="r_id"></td>
          </tr>
          <tr>
            <th>Report Date</th>
            <td id="r_date"></td>
          </tr>
          <tr>
            <th>Total Orders</th>
            <td id="t_order"></td>
          </tr>
          <tr>
            <th>Total Discount</th>
            <td id="t_discount"></td>
          </tr>
         
          
          
        </table>
      
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Add Report Modal -->
<div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addReportModalLabel">Add New Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="reportDate" class="form-label">Report Date</label>
            <input type="date" name="report_date" class="form-control" id="reportDate" required>
          </div>
          <div class="mb-3">
            <label for="totalOrders" class="form-label">Total Orders</label>
            <input type="number" name="total_orders" class="form-control" id="totalOrders" required>
          </div>
          <div class="mb-3">
            <label for="totalSales" class="form-label">Total Sales</label>
            <input type="number" name="total_sales" class="form-control" id="totalSales" required>
          </div>
          <div class="mb-3">
            <label for="totalDiscount" class="form-label">Total Discount</label>
            <input type="number" name="total_discount" class="form-control" id="totalDiscount" required>
          </div>
          <button type="submit" name="DailyReports" class="btn btn-primary">Save Report</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelectorAll('.viewBtn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('r_id').innerText = this.dataset.id;
      document.getElementById('r_date').innerText = this.dataset.date;
      document.getElementById('t_order').innerText = this.dataset.total;
      document.getElementById('t_discount').innerText = this.dataset.discount;
    });
  });
  // document.querySelectorAll('.editBtn').forEach(btn => {
  //   btn.addEventListener('click', function() {
  //     document.getElementById('e_id').value = this.dataset.id;
  //     document.getElementById('e_total').value = this.dataset.total;
  //     document.getElementById('e_final').value = this.dataset.final;
  //     document.getElementById('e_payment').value = this.dataset.payment;
  //   });
  // });
</script>