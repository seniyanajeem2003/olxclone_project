<?php
include 'db.php';
session_start();

// Security: Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM ads WHERE id = '$id'");
$ad = mysqli_fetch_assoc($res);

// Security: If the ad doesn't exist or doesn't belong to the user, redirect
if (!$ad || $ad['user_id'] != $_SESSION['user_id']) {
    header("Location: manage_ads.php");
    exit();
}

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    
    $sql = "UPDATE ads SET title='$title', description='$desc' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_ads.php");
    } else {
        $error = "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ad | OLX Clone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f9; font-family: 'Segoe UI', sans-serif; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .edit-card { width: 100%; max-width: 500px; border: none; border-radius: 12px; }
        .btn-update { background-color: #002f34; color: white; font-weight: bold; }
        .btn-update:hover { background-color: #003f45; color: white; }
        .navbar-brand { color: #002f34 !important; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card edit-card shadow-sm p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark">Edit Advertisement</h3>
                    <p class="text-muted small">Update your listing details below</p>
                </div>

                <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Ad Title</label>
                        <input type="text" name="title" class="form-control py-2" value="<?php echo htmlspecialchars($ad['title']); ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Description</label>
                        <textarea name="description" class="form-control" rows="5" required><?php echo htmlspecialchars($ad['description']); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" name="update" class="btn btn-update py-2">
                            <i class="bi bi-check-circle"></i> Save Changes
                        </button>
                        <a href="manage_ads.php" class="btn btn-outline-secondary py-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>