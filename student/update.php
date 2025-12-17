<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
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

if (!$current) {
    die("Profile not found.");
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current['name'] = $_POST['name'];
    $current['course'] = $_POST['course'];
    $current['year'] = $_POST['year'];
    $current['contact'] = $_POST['contact'];

    file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT));
    echo "Profile updated successfully! <a href='dashboard.php'>Go back</a>";
    exit;
}
?>

<h2>Update Profile</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($current['name']) ?>" required><br>
    Course: <input type="text" name="course" value="<?= htmlspecialchars($current['course']) ?>"><br>
    Year: <input type="text" name="year" value="<?= htmlspecialchars($current['year']) ?>"><br>
    Contact: <input type="text" name="contact" value="<?= htmlspecialchars($current['contact']) ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
