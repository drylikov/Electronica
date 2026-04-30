
<?php
require_once('../config/db.php');

// Validate ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Product ID.");
}

$id = $_GET['id'];

// Fetch product from DB
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Product not found.");
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - <?= $product['product_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <a href="view.php" class="btn btn-sm btn-outline-secondary mb-3">← Back</a>

    <h2 class="mb-4 text-center">✏️ Edit Product</h2>

    <form action="update.php" method="POST" class="card shadow p-4 bg-white rounded">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Product Code</label>
                <input type="text" name="product_code" class="form-control" value="<?= $product['product_code'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Revision</label>
                <input type="text" name="revision" class="form-control" value="<?= $product['revision'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Manufacture Number</label>
                <input type="text" name="manufacture_number" class="form-control" value="<?= $product['manufacture_number'] ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" value="<?= $product['product_name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Type</label>
            <select name="product_type" class="form-select" required>
                <option value="">-- Select Type --</option>
                <option value="Switch Gear" <?= $product['product_type'] === 'Switch Gear' ? 'selected' : '' ?>>Switch Gear</option>
                <option value="Fuse" <?= $product['product_type'] === 'Fuse' ? 'selected' : '' ?>>Fuse</option>
                <option value="Capacitor" <?= $product['product_type'] === 'Capacitor' ? 'selected' : '' ?>>Capacitor</option>
                <option value="Resistor" <?= $product['product_type'] === 'Resistor' ? 'selected' : '' ?>>Resistor</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">💾 Update Product</button>
    </form>
</div>

</body>
</html>
