<?php
include 'db.php';
session_start();

$error_message = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | OLX Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            border: none;
            border-radius: 12px;
            background: #fff;
        }
        .btn-custom {
            background-color: #002f34;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #003f45;
            color: white;
        }
    </style>
</head>
<body>

<div class="login-card shadow">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-dark">Welcome Back</h2>
        <p class="text-muted">Login to manage your ads</p>
    </div>

    <?php if(!empty($error_message)): ?>
        <div class="alert alert-danger py-2 small text-center"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold">Email Address</label>
            <input type="email" name="email" class="form-control py-2" placeholder="Enter email" required>
        </div>
        
        <div class="mb-4">
            <label class="form-label small fw-bold">Password</label>
            <input type="password" name="password" class="form-control py-2" placeholder="Enter password" required>
        </div>
        
        <button type="submit" name="login" class="btn btn-custom w-100 py-2 mb-3">
            Login
        </button>
    </form>

    <div class="text-center">
        <span class="small text-muted">Don't have an account?</span>
        <a href="register.php" class="small fw-bold text-decoration-none" style="color: #002f34;">Register here</a>
    </div>
</div>

</body>
</html>