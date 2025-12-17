<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/auth.php"); // Use your combined login/register file
    exit;
}

$file = '../data/students.json';
$students = json_decode(file_get_contents($file), true);

// Remove the current student
$students = array_filter($students, function($s) {
    return $s['id'] !== $_SESSION['student_id'];
});

file_put_contents($file, json_encode(array_values($students), JSON_PRETTY_PRINT));

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Deleted</title>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .card {
        background: #fff;
        width: 100%;
        max-width: 400px;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
    }

    h2 {
        color: #e53e3e;
        margin-bottom: 20px;
    }

    p {
        font-size: 16px;
        color: #4a5568;
        margin-bottom: 30px;
    }

    .btn {
        display: inline-block;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        background: #3182ce;
        transition: 0.3s;
    }

    .btn:hover {
        background: #2b6cb0;
    }
</style>
</head>
<body>

<div class="card">
    <h2>Profile Deleted</h2>
    <p>Your profile has been successfully deleted.</p>
    <a href="../auth/login.php#register-form" class="btn">Register Again</a>
</div>

</body>
</html>
