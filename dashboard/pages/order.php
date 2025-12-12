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
                            <th>User ID</th>
                            <th>Total Amount</th>
                            <th>Final Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>U101</td>
                            <td>Rs. 5000</td>
                            <td>Rs. 4500</td>
                            <td><span class="badge bg-info text-dark">Credit Card</span></td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td><span class="badge bg-secondary">Processing</span></td>
                            <td>2025-12-11 12:30 PM</td>
                            <td>
                                <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#viewOrderModal">View</button>
                                <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editOrderModal">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>U102</td>
                            <td>Rs. 2500</td>
                            <td>Rs. 2500</td>
                            <td><span class="badge bg-info text-dark">Cash on Delivery</span></td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td><span class="badge bg-secondary">Pending</span></td>
                            <td>2025-12-10 09:45 AM</td>
                            <td>
                                <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#viewOrderModal">View</button>
                                <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editOrderModal">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewOrderModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Order ID:</strong> #1001</p>
        <p><strong>User ID:</strong> U101</p>
        <p><strong>Total Amount:</strong> Rs. 5000</p>
        <p><strong>Final Amount:</strong> Rs. 4500</p>
        <p><strong>Payment Method:</strong> Credit Card</p>
        <p><strong>Payment Status:</strong> Paid</p>
        <p><strong>Order Status:</strong> Processing</p>
        <p><strong>Created At:</strong> 2025-12-11 12:30 PM</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="editTotalAmount" class="form-label">Total Amount</label>
            <input type="number" class="form-control" id="editTotalAmount" value="5000" required>
          </div>
          <div class="mb-3">
            <label for="editFinalAmount" class="form-label">Final Amount</label>
            <input type="number" class="form-control" id="editFinalAmount" value="4500" required>
          </div>
          <div class="mb-3">
            <label for="editPaymentMethod" class="form-label">Payment Method</label>
            <select class="form-select" id="editPaymentMethod" required>
              <option value="Credit Card" selected>Credit Card</option>
              <option value="Cash on Delivery">Cash on Delivery</option>
              <option value="PayPal">PayPal</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editPaymentStatus" class="form-label">Payment Status</label>
            <select class="form-select" id="editPaymentStatus" required>
              <option value="Paid" selected>Paid</option>
              <option value="Pending">Pending</option>
              <option value="Failed">Failed</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editOrderStatus" class="form-label">Order Status</label>
            <select class="form-select" id="editOrderStatus" required>
              <option value="Processing" selected>Processing</option>
              <option value="Pending">Pending</option>
              <option value="Completed">Completed</option>
              <option value="Cancelled">Cancelled</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
