<?php
include "config/db.php";

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    if($password == $confirm_password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //  Corrected SQL Query
        $stmt = "INSERT INTO register (name,email,password,phone,gender) 
                 VALUES ('$name','$email','$hashed_password','$phone_number','$gender')";

        $result = mysqli_query($conn,$stmt);

        if($result){
            echo '<div class="alert alert-success" role="alert">Registration Successful!</div>';
            header("location: login.php");
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">Registration Failed! '.mysqli_error($conn).'</div>';
        }

    } else {
        echo '<div class="alert alert-danger" role="alert">Passwords do not match!</div>';
    }
}
?>


  <title>Professional Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .card {
      border-radius: 15px;
    }
    .card-header {
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .container {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="col-md-6">
    <div class="card shadow-lg">
      <div class="card-header text-white text-center" style="background: linear-gradient(to right, #007bff, #28a745, #ffc107);">
        <h4 class="mb-0 text-white fw-bold">Registration </h4>
      </div>
      <div class="card-body">
        <form method="POST">
          <!-- Full Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>

          <!-- Phone -->
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="03XX-XXXXXXX" required>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
          </div>

          <!-- Gender -->
          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" name="gender" class="form-select" required>
              <option value="" selected disabled>Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <!-- Terms -->
          <div class="d-flex justify-content-between align-items-center mb-3">

              <!-- Left side -->
              <div class="form-check m-0">
                  <input class="form-check-input" type="checkbox" id="terms" required>
                  <label class="form-check-label" for="terms">
                      I agree to the <a href="#">terms and conditions</a>
                  </label>
              </div>

              <!-- Right side -->
              <!-- <a href="login.php" class="text-decoration-none">Login here</a> -->

          </div>

          <!-- Submit Button -->
          <div class="d-grid">
            <button type="submit"  name="submit" id="register" class="btn fw-bold btn-lg text-white"
            style="background: linear-gradient(to right, #1b5ca1ff, #1cc043ff, #f7c11eff);"
            >Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>