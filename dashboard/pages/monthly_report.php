<div class="container my-5">
    <h2 class="mb-4">Monthly Reports</h2>

    <!-- Add Report Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addReportModal">
        Add Report
    </button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Report ID</th>
                <th>Month</th>
                <th>Total Orders</th>
                <th>Total Sales</th>
                <th>Total Discount</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2025-12</td>
                <td>450</td>
                <td>225000.00</td>
                <td>15000.00</td>
                <td>2025-12-11 16:00</td>
                <td>2025-12-11 16:30</td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewReportModal">
                        View
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- View Report Modal -->
<div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewReportModalLabel">Monthly Report Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Report ID:</strong> 1</p>
        <p><strong>Month:</strong> 2025-12</p>
        <p><strong>Total Orders:</strong> 450</p>
        <p><strong>Total Sales:</strong> 225000.00</p>
        <p><strong>Total Discount:</strong> 15000.00</p>
        <p><strong>Created At:</strong> 2025-12-11 16:00</p>
        <p><strong>Updated At:</strong> 2025-12-11 16:30</p>
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
        <h5 class="modal-title" id="addReportModalLabel">Add New Monthly Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="month" class="form-label">Month</label>
            <input type="month" class="form-control" id="month" required>
          </div>
          <div class="mb-3">
            <label for="totalOrders" class="form-label">Total Orders</label>
            <input type="number" class="form-control" id="totalOrders" required>
          </div>
          <div class="mb-3">
            <label for="totalSales" class="form-label">Total Sales</label>
            <input type="number" class="form-control" id="totalSales" required>
          </div>
          <div class="mb-3">
            <label for="totalDiscount" class="form-label">Total Discount</label>
            <input type="number" class="form-control" id="totalDiscount" required>
          </div>
          <button type="submit" class="btn btn-primary">Save Report</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
