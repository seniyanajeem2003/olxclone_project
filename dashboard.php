<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$res = mysqli_query($conn, "SELECT COUNT(*) as total FROM ads WHERE user_id = '$user_id'");
$data = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | OLX Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: #002f34; } 
        .navbar-brand, .nav-link { color: #fff !important; }
        .card-stat { border: none; border-radius: 12px; transition: 0.3s; }
        .card-stat:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">OLX CLONE</a>
            <div class="ms-auto">
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Welcome back, <span class="text-primary"><?php echo $_SESSION['user_email']; ?></span>!</h2>
                <p class="text-muted">Manage your listings and account settings from here.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-stat bg-white p-4 shadow-sm h-100">
                    <h6 class="text-uppercase text-muted fw-bold small">Active Listings</h6>
                    <h1 class="display-4 fw-bold text-dark"><?php echo $data['total']; ?></h1>
                    <p class="text-success mb-0">Total ads currently live posted by you</p>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-4">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="create_ad.php" class="btn btn-primary w-100 py-3 fw-bold">
                                ➕ Post a New Ad
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="manage_ads.php" class="btn btn-outline-dark w-100 py-3 fw-bold">
                                📋 Manage My Ads
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="index.php" class="btn btn-light w-100 py-3 border">
                                🏠 Browse Marketplace
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="edit_profile.php" class="btn btn-light w-100 py-3 border disabled">
                                ⚙️ Account Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>