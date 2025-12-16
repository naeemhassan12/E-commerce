<?php
include "../config/db.php";

$stmt = ("SELECT * FROM users");
$result = $conn->query($stmt); 

$rows = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
}

if (isset($_POST['UserUpdate'])) {
  $id =  $_POST['user_id'];
  $fname = $_POST['full_name'];
  $email = $_POST['email'];

  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $postal_code = $_POST['postal_code'];

  $stmt = $conn->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=?, city=?, state=?, postal_code=? WHERE user_id=?");
  $stmt->bind_param("sssssssi", $fname, $email, $phone, $address, $city, $state, $postal_code, $id);

  if ($stmt->execute()) {
    echo "Updated successfully!";
  } else {
    echo "Data Not Update ";
  }
}

?>
<div class="container mt-5">
  <h2 class="mb-4">Users Dashboard</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>User ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Postal Code</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
          <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['full_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['city'] ?></td>
            <td><?= $row['state'] ?></td>
            <td><?= $row['postal_code'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
              <!-- View -->
              <button
                class="btn btn-sm btn-primary viewBtn"
                data-bs-toggle="modal"
                data-bs-target="#viewModal"
                data-id="<?= $row['user_id'] ?>"
                data-full-name="<?= $row['full_name'] ?>"
                data-email="<?= $row['email'] ?>"
                data-phone="<?= $row['phone'] ?>"
                data-address="<?= $row['address'] ?>"
                data-city="<?= $row['city'] ?>" ,
                data-state="<?= $row['state'] ?>" ,
                data-postal-code="<?= $row['postal_code'] ?>" ,
                data-date="<?= $row['created_at'] ?>">
                View
              </button>
              <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal">View</button> -->
              <button
                class="btn btn-warning btn-sm editBtn"
                data-bs-toggle="modal"
                data-bs-target="#editModal"
                data-id="<?= $row['user_id'] ?>"
                data-full-name="<?= $row['full_name'] ?>"
                data-email="<?= $row['email'] ?>"
                data-phone="<?= $row['phone'] ?>"
                data-address="<?= $row['address'] ?>"
                data-city="<?= $row['city'] ?>"
                data-state="<?= $row['state'] ?>"
                data-postal-code="<?= $row['postal_code'] ?>">
                Edit
              </button>
              <button class="btn btn-danger btn-sm">Delete</button>
            </td>

          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" class="text-center">No Orders Found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="viewModalLabel">View User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>User ID:</strong> <span id="userId"></span></li>
          <li class="list-group-item"><strong>Full Name:</strong> <span id="fullName"></span></li>
          <li class="list-group-item"><strong>Email:</strong> <span id="email"></span></li>
          <li class="list-group-item"><strong>Phone:</strong> <span id="phone"></span></li>
          <li class="list-group-item"><strong>Address:</strong> <span id="address"></span></li>
          <li class="list-group-item"><strong>City:</strong> <span id="city"></span></li>
          <li class="list-group-item"><strong>State:</strong> <span id="state"></span></li>
          <li class="list-group-item"><strong>Postal Code:</strong> <span id="postalCode"></span></li>
          <li class="list-group-item"><strong>Created At:</strong> <span id="createdAt"></span></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <input type="hidden" name="user_id" id="edit_user_id">

          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="John Doe">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="john@example.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="+123456789">
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="123 Main St">
          </div>
          <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="New York">
          </div>
          <div class="mb-3">
            <label class="form-label">State</label>
            <input type="text" name="state" class="form-control" value="NY">
          </div>
          <div class="mb-3">
            <label class="form-label">Postal Code</label>
            <input type="text" name="postal_code" class="form-control" value="10001">
          </div>
          <button type="submit" name="UserUpdate" class="btn btn-warning">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const viewModal = document.getElementById('viewModal');

  viewModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget; // Button that triggered the modal

    // Get data from data-* attributes
    const userId = button.getAttribute('data-id');
    const fullName = button.getAttribute('data-full-name');
    const email = button.getAttribute('data-email');
    const phone = button.getAttribute('data-phone');
    const address = button.getAttribute('data-address');
    const city = button.getAttribute('data-city');
    const state = button.getAttribute('data-state');
    const postalCode = button.getAttribute('data-postal-code');
    const createdAt = button.getAttribute('data-date');

    // Update modal content
    document.getElementById('userId').textContent = userId;
    document.getElementById('fullName').textContent = fullName;
    document.getElementById('email').textContent = email;
    document.getElementById('phone').textContent = phone;
    document.getElementById('address').textContent = address;
    document.getElementById('city').textContent = city;
    document.getElementById('state').textContent = state;
    document.getElementById('postalCode').textContent = postalCode;
    document.getElementById('createdAt').textContent = createdAt;
  });
</script>

<script>
  const editModal = document.getElementById('editModal');
  editModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget; // Button that triggered the modal
    document.getElementById('edit_user_id').value = button.getAttribute('data-id');
    document.querySelector('input[name="full_name"]').value = button.getAttribute('data-full-name');
    document.querySelector('input[name="email"]').value = button.getAttribute('data-email');
    document.querySelector('input[name="phone"]').value = button.getAttribute('data-phone');
    document.querySelector('input[name="address"]').value = button.getAttribute('data-address');
    document.querySelector('input[name="city"]').value = button.getAttribute('data-city');
    document.querySelector('input[name="state"]').value = button.getAttribute('data-state');
    document.querySelector('input[name="postal_code"]').value = button.getAttribute('data-postal-code');
  });
</script>