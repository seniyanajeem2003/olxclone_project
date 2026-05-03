<?php
include 'db.php';
$id = $_GET['id']; 

$result = mysqli_query($conn, "SELECT * FROM ads WHERE id = '$id'");
$ad = mysqli_fetch_assoc($result);

if (!$ad) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ad['title']; ?> | OLX Clone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #002f34; }
        .product-container { background: #fff; border-radius: 12px; overflow: hidden; }
        .product-image { 
            width: 100%; 
            max-height: 500px; 
            object-fit: contain; 
            background-color: #eee;
        }
        .sidebar-box { border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; }
        .description-box { line-height: 1.6; color: #444; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">OLX CLONE</a>
            <a href="index.php" class="btn btn-outline-light btn-sm">← Back to Gallery</a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="product-container shadow-sm p-2 mb-4">
                    <img src="uploads/<?php echo $ad['image_path']; ?>" class="product-image rounded" alt="Product Image">
                </div>
                
                <div class="product-container shadow-sm p-4">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">Description</h5>
                    <div class="description-box">
                        <?php echo nl2br(htmlspecialchars($ad['description'])); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-box shadow-sm bg-white mb-4">
                    <h2 class="fw-bold mb-3"><?php echo htmlspecialchars($ad['title']); ?></h2>
                    <hr>
                    <p class="text-muted small mb-1">Published on</p>
                    <p class="fw-semibold"><?php echo date('M d, Y', strtotime($ad['created_at'])); ?></p>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-success fw-bold py-2">Contact Seller</button>
                        <button class="btn btn-outline-dark fw-bold py-2">Chat with Seller</button>
                    </div>
                </div>

                <div class="sidebar-box shadow-sm bg-white">
                    <h6 class="fw-bold mb-2">Safety Tips for Buyers</h6>
                    <ul class="small text-muted ps-3">
                        <li>Meet in a public place.</li>
                        <li>Check the item before you buy.</li>
                        <li>Do not pay in advance.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>