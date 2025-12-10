<?php
include "inc/header.php";
include "inc/sidebar.php";

// Get page parameter (default: dashboard)
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<div class="content">
    <?php
    switch ($page) {

        // Dashboard Page
        // case 'dashboard':
        //     include "inc/dashboard.php";
        //     break;

        // Product Page
        case 'product':
            include "inc/product.php";
            break;

        // Orders Page
        // case 'order':
        //     include "inc/order.php";
        //     break;

        // Daily Sales Report
        // case 'daily_report':
        //     include "inc/daily_report.php";
        //     break;

        // Monthly Sales Report
        // case 'monthly_report':
        //     include "inc/monthly_report.php";
        //     break;

        // Payment Page
        // case 'payment':
        //     include "inc/payment.php";
        //     break;

        // Backup Page
        // case 'backup':
        //     include "inc/backup.php";
        //     break;

        // If page not found
        default:
            echo "<h3 class='text-danger p-4'>404 - Page Not Found!</h3>";
            break;
    }
    ?>
</div>

<?php include "inc/footer.php"; ?>
