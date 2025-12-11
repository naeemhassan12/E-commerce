<?php
include "inc/header.php";
include "inc/navbar.php";
// Get page parameter (default: dashboard)
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

    switch ($page) {

         case 'hero-section':
            include "pages/hero-section.php";
            break;

        // Product Page
        case 'product':
            include "pages/product.php";
            break;

             case 'about':
            include "pages/about.php";
            break;

             case 'contact':
            include "pages/contact.php";
            break;

        // If page not found
        default:
            echo "<h3 class='text-danger p-4'>404 - Page Not Found!</h3>";
            break;
    }

    include "inc/footer.php";
    ?>