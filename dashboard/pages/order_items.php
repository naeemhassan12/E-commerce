<div class="container my-5">
    <h2 class="mb-4">Order Items</h2>
    <!-- Add Item Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addItemModal">
        Add Item
    </button>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Item ID</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1001</td>
                    <td>501</td>
                    <td>2</td>
                    <td>500.00</td>
                    <td>1000.00</td>
                    <td>
                        <button class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#viewItemModal">View</button>
                        <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editItemModal">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>1001</td>
                    <td>502</td>
                    <td>1</td>
                    <td>1500.00</td>
                    <td>1500.00</td>
                    <td>
                        <button class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#viewItemModal">View</button>
                        <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editItemModal">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- View Item Modal -->
<div class="modal fade" id="viewItemModal" tabindex="-1" aria-labelledby="viewItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewItemModalLabel">Order Item Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Item ID:</strong> 1</p>
        <p><strong>Order ID:</strong> 1001</p>
        <p><strong>Product ID:</strong> 501</p>
        <p><strong>Quantity:</strong> 2</p>
        <p><strong>Price:</strong> 500.00</p>
        <p><strong>Total Price:</strong> 1000.00</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addItemModalLabel">Add New Order Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="orderId" class="form-label">Order ID</label>
            <input type="number" class="form-control" id="orderId" required>
          </div>
          <div class="mb-3">
            <label for="productId" class="form-label">Product ID</label>
            <input type="number" class="form-control" id="productId" required>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" required>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" required>
          </div>
          <div class="mb-3">
            <label for="totalPrice" class="form-label">Total Price</label>
            <input type="number" step="0.01" class="form-control" id="totalPrice" required>
          </div>
          <button type="submit" class="btn btn-primary">Save Item</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editItemModalLabel">Edit Order Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="editOrderId" class="form-label">Order ID</label>
            <input type="number" class="form-control" id="editOrderId" value="1001" required>
          </div>
          <div class="mb-3">
            <label for="editProductId" class="form-label">Product ID</label>
            <input type="number" class="form-control" id="editProductId" value="501" required>
          </div>
          <div class="mb-3">
            <label for="editQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="editQuantity" value="2" required>
          </div>
          <div class="mb-3">
            <label for="editPrice" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="editPrice" value="500.00" required>
          </div>
          <div class="mb-3">
            <label for="editTotalPrice" class="form-label">Total Price</label>
            <input type="number" step="0.01" class="form-control" id="editTotalPrice" value="1000.00" required>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
