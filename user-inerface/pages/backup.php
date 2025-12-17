<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add Daily Report</h5>
                </div>

                <div class="card-body">
                    <form method="post" action="#">
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Report Date</label>
                                <input type="date" class="form-control" name="report_date">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Total Orders</label>
                                <input type="number" class="form-control" name="total_orders">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Total Sales</label>
                                <input type="number" class="form-control" name="total_sales" step="0.01">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Total Discount</label>
                                <input type="number" class="form-control" name="total_discount" step="0.01">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                Save Daily Report
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
