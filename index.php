<?php
include 'db.php';
session_start(); 

$sql = "SELECT * FROM ads ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .ad-card { border: none; border-radius: 8px; transition: 0.3s; }
        .ad-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .ad-image { height: 200px; object-fit: cover; width: 100%; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4" style="background-color: #002f34;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">OLX CLONE</a>
            <div class="ms-auto">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
                <?php endif; ?>
                <a href="create_ad.php" class="btn btn-warning btn-sm fw-bold">+ SELL</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3 class="fw-bold mb-4">Fresh recommendations</h3>
        <div class="row g-4">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card ad-card shadow-sm h-100">
                        <img src="uploads/<?php echo $row['image_path']; ?>" class="ad-image">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold text-truncate"><?php echo $row['title']; ?></h6>
                            <p class="card-text text-muted small text-truncate"><?php echo $row['description']; ?></p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <small class="text-muted"><?php echo date('M d', strtotime($row['created_at'])); ?></small>
                                <a href="view_ad.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>