<?php

define('BASE_PATH', dirname(__DIR__)); // Points to /my_project

require_once BASE_PATH . '/../controller/controllerLogin.php'; // Adjust the path as necessary

// makes use of auth_controller that I have defined inside bckend
$authController = new LoginController();

// Assuming you get JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Call the login method on the controller
$authController->login($data);
?>