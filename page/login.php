<?php
session_start();
require '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare("SELECT id, username FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['id'] = $user['id']; 
        header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #0e2238;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin: 0 auto; 
            margin-top: 20vh; 
        }
        .login-container input {
            width: calc(100% - 20px); 
            padding: 10px; 
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; 
        }
        .login-container input[type="submit"] {
            background-color: #0e2238;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 5px 20px;
            width: auto; 
            font-size: 14px;
        }
        .login-container input[type="submit"]:hover {
            background-color: #808080;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <h2 class="text-center">Perpus Ku</h2>
            <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
            <?php endif; ?>
            <form action="login.php" method="post">
             <input type="text" name="username" placeholder="Username" required>
             <input type="password" name="password" placeholder="Password" required>
             <input type="submit" value="Login">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>

