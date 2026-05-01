<?php
include 'db.php';
session_start();

// Security: If not logged in, send them back to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_POST['post_ad'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Image Upload Logic
    $image_name = time() . "_" . $_FILES['ad_image']['name']; 
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image_name);

    if (move_uploaded_file($_FILES['ad_image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO ads (user_id, title, description, image_path) 
                VALUES ('$user_id', '$title', '$desc', '$image_name')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success shadow-sm'>Ad posted successfully! <a href='dashboard.php' class='alert-link'>View Dashboard</a></div>";
        } else {
            $message = "<div class='alert alert-danger'>Database error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Please select a valid image to upload.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Ad | OLX Clone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #002f34; }
        .post-card { border-radius: 12px; border: none; }
        .btn-post { background-color: #002f34; color: white; font-weight: bold; padding: 10px 20px; }
        .btn-post:hover { background-color: #003f45; color: white; }
    </style>
</head>
<body>

    <!-- Simple Header -->
    <nav class="navbar navbar-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">OLX CLONE</a>
            <span class="navbar-text text-white">Post Your Ad</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <?php if(!empty($message)) echo $message; ?>

                <div class="card post-card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Include some details</h4>
                        
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ad Title</label>
                                <input type="text" name="title" class="form-control" placeholder="e.g. iPhone 13 Pro Max" required>
                                <div class="form-text">Mention the key features of your item.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Include condition, features, and reason for selling" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Upload Photos</label>
                                <div class="border rounded p-3 text-center bg-light">
                                    <input type="file" name="ad_image" class="form-control mb-2" required>
                                    <small class="text-muted">JPG, PNG or JPEG (Max. 2MB)</small>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-between align-items-center">
                                <a href="dashboard.php" class="text-decoration-none text-muted fw-bold">Cancel</a>
                                <button type="submit" name="post_ad" class="btn btn-post">
                                    Post Ad Now
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>