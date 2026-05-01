<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // In a real project, you should use password_hash() for security
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    $message = "";
    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>Registration successful! <a href='login.php' class='alert-link'>Go to Login</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | OLX Clone</title>
    <!-- Bootstrap CSS -->
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
        .register-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
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

<div class="register-card shadow">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-dark">Join OLX</h2>
        <p class="text-muted">The best place to buy and sell</p>
    </div>

    <!-- Display success or error message -->
    <?php if(!empty($message)) echo $message; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold">Email Address</label>
            <input type="email" name="email" class="form-control py-2" placeholder="name@example.com" required>
        </div>
        
        <div class="mb-4">
            <label class="form-label small fw-bold">Password</label>
            <input type="password" name="password" class="form-control py-2" placeholder="Create a password" required>
        </div>
        
        <button type="submit" name="submit" class="btn btn-custom w-100 py-2 mb-3">
            Create Account
        </button>
    </form>

    <div class="text-center">
        <span class="small text-muted">Already have an account?</span>
        <a href="login.php" class="small fw-bold text-decoration-none" style="color: #002f34;">Login here</a>
    </div>
</div>

</body>
</html>