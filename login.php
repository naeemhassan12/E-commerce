<?php
   include "config/db.php";

   if(isset($_POST['submit']))
   {
    $username = $_POST['name'];
    $password = $_POST['password'];

    $stmt = "SELECT * FROM register";
    $sql = mysqli_query($conn,$stmt);

    if(mysqli_num_rows($sql) > 0)
    {
        $row = mysqli_fetch_assoc($sql);
        if($password === $row['password']) {
            // Start session and set session variables
            session_start();
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['student_email'] = $row['email'];
            $_SESSION['student_name'] = $row['name'];

            echo '<div class="alert alert-success" role="alert">Login Successful! Welcome '.$row['name'].'</div>';
            header("location: index.php?page=hero-section");
            // echo '<meta http-equiv="refresh" content="2;url=dashboard.php">';
        } else {
            echo '<div class="alert alert-danger" role="alert">Incorrect Password!</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">No user found with this email!</div>';
    }
}   
?>
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
        height: 100vh;
        background: linear-gradient(to right, #6a11cb, #2575fc);
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .login-card {
        background: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .login-card .form-control {
        border-radius: 50px;
        padding: 10px 20px;
    }

    .login-card .btn-primary {
        border-radius: 50px;
        padding: 10px 20px;
        width: 100%;
        font-weight: bold;
    }

    .login-card .form-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .form-group {
        position: relative;
        margin-bottom: 25px;
    }

    .login-card a {
        text-decoration: none;
        color: #2575fc;
    }

    .login-card a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center mb-4">Welcome Back</h3>
        <p class="text-center text-muted mb-4">Sign in to your account</p>
        <form>
            <div class="form-group">
                <i class="fa fa-user form-icon"></i>
                <input type="text" name="username" class="form-control ps-5" placeholder="Username" required>
            </div>
            <div class="form-group">
                <i class="fa fa-lock form-icon"></i>
                <input type="password" name="password" class="form-control ps-5" placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Remember Me
                    </label>
                </div>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
            <p class="text-center mt-3">Don't have an account? <a href="#">Sign Up</a></p>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>