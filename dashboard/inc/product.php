<?php
include "../config/db.php";
session_start();

if (isset($_POST['AddProducts'])) {

    $ProductName  = $_POST['productName'];
    $ProductPrice = $_POST['productPrice'];

    
    $imageName = $_FILES['productImage']['name'];
    $imageTmp  = $_FILES['productImage']['tmp_name'];

    $destination = "assets/image/" . $imageName;

    if (move_uploaded_file($imageTmp, $destination)) {

        $query = "INSERT INTO products (productName, productPrice, productImage) VALUES (?, ?, ?)";
        $stmt  = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sss", $ProductName, $ProductPrice, $destination);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script>alert('Product Inserted Successfully!');</script>";
        }
    }
}

$products = [];
$query = "SELECT * FROM products ORDER BY id ASC";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">
        <h2 class="mb-3">Product Management</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add Product
        </button>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $prod): ?>
                <tr>
                    <td><?= $prod['id']; ?></td>
                    <td><?= $prod['productName']; ?></td>
                    <td><?= $prod['productPrice']; ?></td>
                    <td><img src="<?= $prod['productImage']; ?>" width="70"></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">

                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="productName" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Product Price</label>
                            <input type="number" name="productPrice" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Product Image</label>
                            <input type="file" name="productImage" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" name="AddProducts">Add Product</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>