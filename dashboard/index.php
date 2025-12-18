<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {

    header("Location: ../login.php");
    exit();

}

include "inc/header.php";
include "inc/sidebar.php";

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'backup') {
        //include 'backup.php';
    }
}

// Get page parameter (default: dashboard)
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

?>

<div class="content">
    <?php
    switch ($page) {

        //Dashboard Page
        case 'dashboard':
            include "inc/dashboard.php";
            break;
        // user page
        case 'users':
            include "pages/users.php";
            break;
        // Product Page
        case 'product':
            include "pages/product.php";
            break;

        // Orders Page
        case 'order':
            include "pages/order.php";
            break;
        case 'order_items':
            include "pages/order_items.php";
            break;
        // Daily Sales Report
        case 'daily_report':
            include "pages/daily_report.php";
            break;

        // Monthly Sales Report
        case 'monthly_report':
            include "pages/monthly_report.php";
            break;
        // Payment Page
        case 'payment':
            include "pages/payment.php";
            break;

        // Backup Page
        case 'backup':
            include "pages/backup.php";
            break;
        case 'logout':
            include "pages/logout.php";
            break;
        // If page not found
        default:
            echo "<h3 class='text-danger p-4'>404 - Page Not Found!</h3>";
            break;
    }
    ?>
</div>

<?php include "inc/footer.php"; ?>