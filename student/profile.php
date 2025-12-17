<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/auth.php"); // Your combined login/register file
    exit;
}

$file = '../data/students.json';
$students = json_decode(file_get_contents($file), true);

$current = null;
foreach ($students as &$student) {
    if ($student['id'] === $_SESSION['student_id']) {
        $current = &$student;
        break;
    }
}

// Handle update
$update_success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $current['name'] = $_POST['name'];
    $current['course'] = $_POST['course'];
    $current['year'] = $_POST['year'];
    $current['contact'] = $_POST['contact'];

    file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT));
    $update_success = "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Profile</title>
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

    .profile-card {
        background: #fff;
        width: 100%;
        max-width: 500px;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #1a202c;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #cbd5e0;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
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

    .btn.delete {
        background: #e53e3e;
    }

    .btn.delete:hover {
        background: #c53030;
    }

    .btn.back {
        background: #718096;
    }

    .btn.back:hover {
        background: #4a5568;
    }

    .alert {
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        text-align: center;
        background: #f0fff4;
        color: #276749;
        border: 1px solid #9ae6b4;
    }
</style>
</head>
<body>

<div class="profile-card">
    <h2>Update Profile</h2>

    <?php if($update_success) echo "<div class='alert'>$update_success</div>"; ?>

    <form method="POST">
        <input type="hidden" name="update" value="1">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($current['name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Course</label>
            <input type="text" name="course" value="<?= htmlspecialchars($current['course']) ?>">
        </div>
        <div class="form-group">
            <label>Year</label>
            <input type="text" name="year" value="<?= htmlspecialchars($current['year']) ?>">
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input type="text" name="contact" value="<?= htmlspecialchars($current['contact']) ?>">
        </div>
        <button type="submit" class="btn">Update Profile</button>
    </form>

    <form method="POST" action="delete.php">
        <button type="submit" class="btn delete">Delete Profile</button>
    </form>

    <a href="dashboard.php" class="btn back">Back to Dashboard</a>
</div>

</body>
</html>
