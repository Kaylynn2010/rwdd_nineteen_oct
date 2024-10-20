<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__)); // Points to /my_project

// include BASE_PATH . '/presentation/login_register.php';

// Simple routing logic based on URL parameters.
$url = isset($_GET['url']) ? $_GET['url'] : '';

if ($url == 'user/show') {
    // $controller = new UserController();
    // $controller->show(1); // Example user ID to display.
} elseif ($url == 'login_register') {
    // for login
    include BASE_PATH . '/presentation/login_register.php';
} else {
    header("Location: /rwdd_nineteen_oct/index/index.php?url=login_register");
    exit();
    // echo "404 Not Found";
}
?>