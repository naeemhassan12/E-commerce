<?php
include "../config/db.php";

$query = "
    SELECT 
        order_id,
        payment_method,
        final_amount
    FROM orders
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f6f8;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Payment Records</h2>

<table>
    <thead>
        <tr>
            <th>Payment ID</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Amount</th>
            <th>Payment Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['order_id']; ?></td>
                <td><?= ucfirst($row['payment_method']); ?></td>
                <td class="status">Completed</td>
                <td><?= number_format($row['final_amount'], 2); ?></td>
                <td><?= date("Y-m-d"); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
