<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/auth.php"); // Use your combined auth file
    exit;
}

$file = '../data/students.json';
$students = json_decode(file_get_contents($file), true);

$current = null;
foreach ($students as $student) {
    if ($student['id'] === $_SESSION['student_id']) {
        $current = $student;
        break;
    }
}

if (!$current) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>
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

    .dashboard-card {
        background: #fff;
        width: 100%;
        max-width: 500px;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
    }

    h2 {
        color: #1a202c;
        margin-bottom: 30px;
    }

    .btn {
        display: inline-block;
        margin: 10px 0;
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

    .btn.logout {
        background: #e53e3e;
    }

    .btn.logout:hover {
        background: #c53030;
    }

    p {
        font-size: 16px;
        color: #4a5568;
    }
</style>
</head>
<body>

<div class="dashboard-card">
    <h2>Welcome, <?= htmlspecialchars($current['name']) ?>!</h2>
    <p>Manage your student profile below.</p>

    <a href="profile.php" class="btn">View / Edit Profile</a>
    <a href="../auth/logout.php" class="btn logout">Logout</a>
</div>

</body>
</html>
