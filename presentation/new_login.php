<?php
session_start();
require 'dbconnL.php';

// Assuming user authentication is successful
$_SESSION['user_id'] = $user_id; // storing user ID

if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'];
    echo "Username: " . $_SESSION['username'];
} else {
    echo "User is not logged in.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Login</title>
    <link rel="stylesheet" href="/rwdd_nineteen_oct/css/style.css">
    
    </head>
<body>
    <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <button class="btnLogin-popup">Login</button>
        </nav>
    </header>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>

        <div class="form-box login">
            <h2>Login</h2>
            <form id="loginForm" action="#">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="email"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account?<a href="#" class="register-link"> Register!</a>
                    </p>
                </div>
            </form>
        </div>

    <script src="/rwdd_kaylynn_assignment/public_frontend/js/log_script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

<!-- done checking -->