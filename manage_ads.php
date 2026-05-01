<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    $delete_sql = "DELETE FROM ads WHERE id = '$id_to_delete' AND user_id = '$user_id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Ad deleted successfully!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
}

$sql = "SELECT * FROM ads WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage My Ads | OLX Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #002f34; }
        .table-container { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .ad-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
        .btn-edit { color: #002f34; border: 1px solid #002f34; }
        .btn-edit:hover { background: #002f34; color: #fff; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">OLX CLONE</a>
            <a href="create_ad.php" class="btn btn-light btn-sm fw-bold">+ Post New Ad</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Your Advertisements</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Ads</li>
                </ol>
            </nav>
        </div>

        <?php echo $message; ?>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Preview</th>
                            <th>Title</th>
                            <th>Date Posted</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <img src="uploads/<?php echo $row['image_path']; ?>" class="ad-thumb" alt="Ad Image">
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo $row['title']; ?></div>
                                <small class="text-muted">ID: #<?php echo $row['id']; ?></small>
                            </td>
                            <td class="text-muted"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="edit_ad.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                                    <a href="manage_ads.php?delete_id=<?php echo $row['id']; ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this ad?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if(mysqli_num_rows($result) == 0) { ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">You haven't posted any ads yet.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>