<?php
session_start();
include './assets/includes/db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        
        // Debugging - Check if session is set correctly
        if (isset($_SESSION['admin_id'])) {
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Session not set. Please check session configuration.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/imgs/GOOD LOGO ADONA I2.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/imgs/GOOD LOGO ADONA I2.png" type="image/x-icon">
    <title>Admin Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background: linear-gradient(120deg, #ff6e7f, #bfe9ff, #86e3ce, #d38312, #e8cbc0);
            background-size: 200% 200%;
            animation: gradientBG 8s ease infinite;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-form {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .login-form img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            opacity: 0.85;
        }

        .login-form h2 {
            margin: 0 0 20px;
            color: #333;
            font-size: 26px;
            letter-spacing: 1px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #86e3ce;
            outline: none;
            box-shadow: 0 0 10px rgba(134, 227, 206, 0.7);
        }

        .login-form input[type="submit"] {
            background-color: #ff6e7f;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
        }

        .login-form input[type="submit"]:hover {
            background-color: #ff4e57;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .forgot-password {
            margin-top: 15px;
            color: #ff4b5c;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            color: #ff0000;
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <img src="/assets/imgs/GOOD LOGO ADONA I2.png" alt="Logo">
        <h2>Administrator</h2>
        <?php if (isset($error)) echo '<p class="error">' . $error . '</p>'; ?>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
    </div>
</body>
</html>
