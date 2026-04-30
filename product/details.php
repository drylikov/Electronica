
<?php
require_once('../config/db.php');

// Check if ID is present in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid product ID.");
}

$id = $_GET['id'];

// Fetch product
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("❌ Product not found.");
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details - <?= $product['product_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <a href="view.php" class="btn btn-sm btn-outline-secondary mb-3">← Back to Product List</a>

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">🔍 Product Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Product ID:</strong> <?= $product['product_id'] ?></p>
            <p><strong>Product Name:</strong> <?= $product['product_name'] ?></p>
            <p><strong>Product Type:</strong> <?= $product['product_type'] ?></p>
            <p><strong>Product Code:</strong> <?= $product['product_code'] ?></p>
            <p><strong>Revision:</strong> <?= $product['revision'] ?></p>
            <p><strong>Manufacture Number:</strong> <?= $product['manufacture_number'] ?></p>
            <p><strong>Created At:</strong> <?= date('d-M-Y H:i A', strtotime($product['created_at'])) ?></p>
        </div>
    </div>
</div>

</body>
</html>
