
<?php
// Include database connection
require_once('../config/db.php');
require_once('../includes/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - SRS Electrical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">➕ Add New Product</h2>

    <form action="store.php" method="POST" class="card shadow p-4 rounded bg-white">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Product Code</label>
                <input type="text" name="product_code" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Revision</label>
                <input type="text" name="revision" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Manufacture Number</label>
                <input type="text" name="manufacture_number" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Type</label>
            <select name="product_type" class="form-select" required>
                <option value="">-- Select Type --</option>
                <option value="Switch Gear">Switch Gear</option>
                <option value="Fuse">Fuse</option>
                <option value="Capacitor">Capacitor</option>
                <option value="Resistor">Resistor</option>
                <!-- add more as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-secondary w-100">Add Product</button>
    </form>
</div>

</body>
</html>
