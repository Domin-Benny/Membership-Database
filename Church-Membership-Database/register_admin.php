<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: rgba(0, 0, 0, 0.6);
            height: 100vh;
            overflow: hidden;
        }

        .blurred-bg {
            backdrop-filter: blur(8px);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .register-form {
            position: absolute;
            top: 10%;
            right: 10%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .register-form h2 {
            margin: 0 0 15px;
            color: #333;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"],
        .register-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .register-form input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
        }

        .register-form input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="blurred-bg"></div>
    <div class="register-form">
        <h2>Admin Registration</h2>
        <?php if (isset($error)) echo '<p class="error">' . $error . '</p>'; ?>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>