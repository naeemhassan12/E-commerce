<?php
include "../config/db.php";
if (isset($_POST['add_product'])) {
    $name           = $_POST['product_name'];
    $description    = $_POST['description'];
    $price          = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $stock          = $_POST['stock'];
    $status         = $_POST['status'];
    $brand          = $_POST['brand'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];
        $uploadDir = "../uploads/";
        $accessDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imagePath  = $uploadDir . $imageName;
        $uploadPath = $accessDir . $imageName;
        if (move_uploaded_file($imageTmp, $imagePath)) {
            $stmt = $conn->prepare("INSERT INTO products 
                (product_name, description, price, discount_price, stock, status, brand, image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "ssddisss",
                $name,
                $description,
                $price,
                $discount_price,
                $stock,
                $status,
                $brand,
                $uploadPath
            );

            $stmt->execute();
            $stmt->close();
        }
    }
}

// =====================================
// UPDATE PRODUCT
// =====================================
if (isset($_POST['update_product'])) {

    $id             = $_POST['update_id'];
    $name           = $_POST['product_name'];
    $description    = $_POST['description'];
    $price          = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $stock          = $_POST['stock'];
    $status         = $_POST['status'];
    $brand          = $_POST['brand'];

    // Get old image
    $product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
    $imagePath = $product['image'];

    // If new image selected
    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . "_" . $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];

        $uploadDir = "../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newPath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmp, $newPath)) {

            if (file_exists("../" . $product['image'])) {
                unlink("../" . $product['image']);
            }

            $imagePath = "uploads/" . $imageName;
        }
    }

    $update = $conn->prepare("
        UPDATE products SET 
            product_name=?, description=?, price=?, discount_price=?, 
            stock=?, status=?, brand=?, image=? 
        WHERE id=?
    ");

    $update->bind_param(
        "ssddisssi",
        $name,
        $description,
        $price,
        $discount_price,
        $stock,
        $status,
        $brand,
        $imagePath,
        $id
    );

    $update->execute();
}

// =====================================
// DELETE PRODUCT
// =====================================
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
    $oldImg = $conn->query("SELECT image FROM products WHERE id=$id")->fetch_assoc()['image'];

    if (file_exists("../" . $oldImg)) {
        unlink("../" . $oldImg);
    }

    $conn->query("DELETE FROM products WHERE id=$id");
}

// =====================================
// FETCH ALL PRODUCTS
// =====================================
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Products Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container my-5">
        <h2 class="mb-4">Products Dashboard</h2>

        <!-- Button to Open Add Product Modal -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add New Product
        </button>

        <!-- ADD PRODUCT MODAL -->
        <div class="modal fade" id="addProductModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Discount Price</label>
                                <input type="number" step="0.01" name="discount_price" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Stock</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Brand</label>
                                <input type="text" name="brand" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="add_product" class="btn btn-success">Add Product</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- PRODUCTS TABLE -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Brand</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id']; ?></td>

                    <td>
                        <img src="../<?= $product['image']; ?>" width="60" height="60">
                    </td>

                    <td><?= $product['product_name']; ?></td>
                    <td>$<?= $product['price']; ?></td>
                    <td><?= $product['discount_price'] ? '$' . $product['discount_price'] : '-'; ?></td>
                    <td><?= $product['stock']; ?></td>
                    <td><?= ucfirst($product['status']); ?></td>
                    <td><?= $product['brand']; ?></td>

                    <td>
                        <button class="btn btn-primary btn-sm" onclick='openEditModal(<?= json_encode($product) ?>)'>
                            Edit
                        </button>

                        <a href="index.php?page=product&delete=<?php echo $product['id']; ?>"
                            class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>


        <!-- EDIT PRODUCT MODAL -->
        <div class="modal fade" id="editProductModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="update_id" id="edit_id">

                        <div class="modal-body">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label>Product Name</label>
                                    <input type="text" id="edit_name" name="product_name" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Brand</label>
                                    <input type="text" id="edit_brand" name="brand" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea id="edit_description" name="description" class="form-control"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label>Price</label>
                                    <input type="number" id="edit_price" step="0.01" name="price" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Discount Price</label>
                                    <input type="number" id="edit_discount" step="0.01" name="discount_price"
                                        class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Stock</label>
                                    <input type="number" id="edit_stock" name="stock" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select id="edit_status" name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Replace Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Current Image</label><br>
                                    <img id="edit_image_preview" src="" width="80" height="80"
                                        style="border:1px solid #ccc;">
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update_product" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function openEditModal(product) {
        document.getElementById('edit_id').value = product.id;
        document.getElementById('edit_name').value = product.product_name;
        document.getElementById('edit_description').value = product.description;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_discount').value = product.discount_price;
        document.getElementById('edit_stock').value = product.stock;
        document.getElementById('edit_status').value = product.status;
        document.getElementById('edit_brand').value = product.brand;

        document.getElementById('edit_image_preview').src = "../" + product.image;

        var myModal = new bootstrap.Modal(document.getElementById('editProductModal'));
        myModal.show();
    }
    </script>

</body>

</html>