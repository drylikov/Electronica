
<?php
require_once('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Products - SRS Electrical</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📦 All Products</h2>
    <a href="add.php" class="btn btn-secondary">+ Add New Product</a>
  </div>

  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success">✅ Product added successfully!</div>
  <?php endif; ?>

  <div class="card shadow">
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Product ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Code</th>
            <th>Revision</th>
            <th>Mfg No</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0):
          $i = 1;
          while ($row = $result->fetch_assoc()):
        ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['product_id'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= $row['product_type'] ?></td>
            <td><?= $row['product_code'] ?></td>
            <td><?= $row['revision'] ?></td>
            <td><?= $row['manufacture_number'] ?></td>
            <td><?= date('d-M-Y', strtotime($row['created_at'])) ?></td>
            <td>
              <a href="details.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">View</a>
             <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
             <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>

            </td>
          </tr>
        <?php
          endwhile;
        else:
        ?>
          <tr><td colspan="9" class="text-center">No products found.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
