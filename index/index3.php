<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__)); // Points to /my_project

// require_once BASE_PATH . '/src_backend/controllers/UserController.php';
// central router

// Simple routing logic based on URL parameters.
$url = isset($_GET['url']) ? $_GET['url'] : '';

if ($url == 'user/show') {
    // $controller = new UserController();
    // $controller->show(1); // Example user ID to display.
} elseif ($url == 'auth') {
    include '../src_backend/views/auth_view.php';
} else {
    echo "404 Not Found";
}
?>