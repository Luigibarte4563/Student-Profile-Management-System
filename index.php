<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

// If logged in, redirect to student dashboard
header("Location: student/dashboard.php");
exit;
