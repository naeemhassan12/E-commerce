<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Orders Management</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    background: #f8fafc;
    font-family: 'Inter', sans-serif;
    color: #1f2937;
}

.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.04);
}

.table thead th {
    background: #f9fafb;
    text-transform: uppercase;
    font-size: 0.75rem;
    color: #6b7280;
    letter-spacing: .04em;
}

.order-id {
    font-weight: 600;
    color: #2563eb;
}

.items-scroll {
    max-height: 300px;
    overflow-y: auto;
}

.items-scroll thead th {
    position: sticky;
    top: 0;
    background: #f9fafb;
}

.modal-content {
    border-radius: 16px;
}
</style>
</head>

<body>

<div class="container-fluid px-5 py-4">

    <h3 class="fw-bold mb-4 ">Orders</h3>

    <!-- ORDERS TABLE -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>User Name</th>
                        <th>Total Amount</th>
                        <th>Discount</th>
                        <th>Final Amount</th>
                        <th>Payment</th>
                        <th>Shipping Address</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="order-id">#US-1001</td>
                        <td>John Anderson</td>
                        <td>$520.00</td>
                        <td>$40.00</td>
                        <td class="fw-semibold">$480.00</td>
                        <td>Credit Card</td>
                        <td>New York, NY, USA</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#orderItemsModal">
                                View Items
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td class="order-id">#US-1002</td>
                        <td>Emily Watson</td>
                        <td>$300.00</td>
                        <td>$0.00</td>
                        <td class="fw-semibold">$300.00</td>
                        <td>PayPal</td>
                        <td>Los Angeles, CA, USA</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary">
                                View Items
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ORDER ITEMS MODAL -->
<div class="modal fade" id="orderItemsModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- FORM -->
            <form method="post">

                <div class="modal-header">
                    <h5 class="fw-semibold">
                        Order Items — <span class="text-primary">#US-1001</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- ORDER SUMMARY -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Order ID</label>
                            <input type="text" class="form-control" value="US-1001" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" value="John Anderson" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Payment</label>
                            <input type="text" class="form-control" value="Credit Card" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Final Amount</label>
                            <input type="text" class="form-control" value="$480.00" readonly>
                        </div>
                    </div>

                    <!-- ORDER ITEMS TABLE -->
                    <div class="items-scroll">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Order ID</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1001</td>
                                    <td>501</td>
                                    <td>1</td>
                                    <td>$150.00</td>
                                    <td>$150.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>1001</td>
                                    <td>502</td>
                                    <td>2</td>
                                    <td>$40.00</td>
                                    <td>$80.00</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>1001</td>
                                    <td>503</td>
                                    <td>1</td>
                                    <td>$120.00</td>
                                    <td>$120.00</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>1001</td>
                                    <td>504</td>
                                    <td>1</td>
                                    <td>$90.00</td>
                                    <td>$90.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" disabled>
                        Submit (Backend Later)
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
