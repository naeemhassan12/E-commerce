<?php
include "../config/db.php";


$query = "
    SELECT
        DATE_FORMAT(report_date, '%Y-%m') AS month,
        SUM(total_orders) AS total_orders,
        SUM(total_sales) AS total_sales,
        SUM(total_discount) AS total_discount
    FROM daily_reports
    GROUP BY DATE_FORMAT(report_date, '%Y-%m')
    ORDER BY month ASC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Monthly Reports</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Month</th>
                                <th>Total Orders</th>
                                <th>Total Sales</th>
                                <th>Total Discount</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['month']; ?></td>
                                        <td><?= $row['total_orders']; ?></td>
                                        <td><?= number_format($row['total_sales'], 2); ?></td>
                                        <td><?= number_format($row['total_discount'], 2); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-muted text-center">
                                        No monthly reports found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>