<?php
// Start session
header('Pragma: no-cache');
session_cache_limiter('nocache');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
session_start();

// Check if user is logged in
if (isset($_SESSION['employeeID'])) {
    // Destroy session
    session_destroy();
    
    // Prevent caching of previous page

    
    // Redirect to login page
    header('Location: login.php');
    exit();
} else {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
?>