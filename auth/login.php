<?php
session_start();

$file = '../data/students.json';
if (!file_exists($file)) {
    if (!is_dir('../data')) {
        mkdir('../data', 0777, true);
    }
    file_put_contents($file, json_encode([]));
}

$students = json_decode(file_get_contents($file), true);

// ---------- LOGIN ----------
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    foreach ($students as $student) {
        if ($student['email'] === $email && password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            header("Location: ../student/dashboard.php");
            exit;
        }
    }
    $login_error = "Invalid email or password.";
}

// ---------- REGISTER ----------
if (isset($_POST['action']) && $_POST['action'] === 'register') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    foreach ($students as $student) {
        if ($student['email'] === $email) {
            $register_error = "Email already registered.";
            break;
        }
    }

    if (!isset($register_error)) {
        $students[] = [
            'id' => uniqid(),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'course' => '',
            'year' => '',
            'contact' => ''
        ];
        file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT));
        $register_success = "Registration successful! You can now log in.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
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

        .auth-card {
            background: #fff;
            width: 100%;
            max-width: 400px;
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

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            background: #3182ce;
            color: white;
            transition: 0.3s;
        }

        button:hover {
            background: #2b6cb0;
        }

        .toggle-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #718096;
        }

        .toggle-link span {
            color: #3182ce;
            cursor: pointer;
            font-weight: 600;
        }

        .toggle-link span:hover {
            text-decoration: underline;
        }

        /* Alert Styling */
        .alert {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .error { background: #fff5f5; color: #c53030; border: 1px solid #feb2b2; }
        .success { background: #f0fff4; color: #276749; border: 1px solid #9ae6b4; }

        /* Hide logic */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<div class="auth-card">
    
    <div id="login-form" <?php if(isset($register_error) || isset($register_success)) echo 'class="hidden"'; ?>>
        <h2>Welcome Back</h2>
        
        <?php if(isset($login_error)) echo "<div class='alert error'>$login_error</div>"; ?>
        
        <form method="POST">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="toggle-link">
            Don't have an account? <span onclick="toggleForms()">Register here</span>
        </div>
    </div>

    <div id="register-form" <?php if(!isset($register_error) && !isset($register_success)) echo 'class="hidden"'; ?>>
        <h2>Create Account</h2>
        
        <?php 
        if(isset($register_error)) echo "<div class='alert error'>$register_error</div>"; 
        if(isset($register_success)) echo "<div class='alert success'>$register_success</div>"; 
        ?>

        <form method="POST">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" style="background-color: #38a169;">Register</button>
        </form>
        <div class="toggle-link">
            Already have an account? <span onclick="toggleForms()">Login here</span>
        </div>
    </div>

</div>

<script>
    function toggleForms() {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        
        loginForm.classList.toggle('hidden');
        registerForm.classList.toggle('hidden');
    }
</script>

</body>
</html>