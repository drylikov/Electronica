
<?php
require_once('../config/db.php');
$products = $conn->query("SELECT id, product_name FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Test - SRS Electrical</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-heading {
      font-weight: 600;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h3 class="text-center text-secondary mb-4 form-heading">🧪 Add Test Record</h3>

      <form action="store.php" method="POST" class="card shadow p-4 bg-white rounded">
        <!-- Product Dropdown -->
        <div class="mb-3">
          <label class="form-label">Select Product</label>
          <select name="product_id" class="form-select" required>
            <option value="">-- Select Product --</option>
            <?php while($row = $products->fetch_assoc()): ?>
              <option value="<?= $row['id'] ?>"><?= $row['product_name'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Test Type -->
        <div class="mb-3">
          <label class="form-label">Type of Test</label>
          <select name="test_type" class="form-select" required>
            <option value="">-- Select Test Type --</option>
            <option value="Voltage Test">Voltage Test</option>
            <option value="Load Test">Load Test</option>
          </select>
        </div>

        <!-- Criteria -->
        <div class="mb-3">
          <label class="form-label">Criteria</label>
          <textarea name="criteria" class="form-control" rows="2" required></textarea>
        </div>

        <!-- Output -->
        <div class="mb-3">
          <label class="form-label">Output</label>
          <textarea name="output" class="form-control" rows="2" required></textarea>
        </div>

        <!-- Remarks -->
        <div class="mb-3">
          <label class="form-label">Remarks</label>
          <textarea name="remarks" class="form-control" rows="2"></textarea>
        </div>

        <!-- Tested By -->
        <div class="mb-3">
          <label class="form-label">Tested By</label>
          <input type="text" name="tested_by" class="form-control" placeholder="Enter tester's name" required>
        </div>

        <!-- Test Status -->
        <div class="mb-4">
          <label class="form-label">Test Status</label>
          <select name="test_status" class="form-select" required>
            <option value="">-- Select Status --</option>
            <option value="Passed">Passed</option>
            <option value="Failed">Failed</option>
            <option value="Pending">Pending</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success w-100">➕ Save Test</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
