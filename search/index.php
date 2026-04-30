
<?php
require_once('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Advanced Search - SRS Electrical</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


<div class="container mt-5">
     <div class="mb-3">
    <a href="../test/view.php" class="btn btn-secondary">
      ← Back to All Tests
    </a>
  </div>
  <h2 class="text-center mb-4">🔍 Advanced Test Record Search</h2>

  <form method="GET" class="card p-4 shadow-sm mb-4">
    <div class="row g-3">
      <div class="col-md-3">
        <label>Test ID</label>
        <input type="text" name="test_id" class="form-control" placeholder="Enter Test ID">
      </div>
      <div class="col-md-3">
        <label>Product ID</label>
        <input type="text" name="product_id" class="form-control" placeholder="Enter Product ID">
      </div>
      <div class="col-md-3">
        <label>Test Status</label>
        <select name="test_status" class="form-select">
          <option value="">-- All --</option>
          <option value="Passed">Passed</option>
          <option value="Failed">Failed</option>
          <option value="Pending">Pending</option>
        </select>
      </div>
      <div class="col-md-3">
        <label>Test Type</label>
        <select name="test_type_id" class="form-select">
          <option value="">-- All Types --</option>
          <?php
          $types = $conn->query("SELECT id, test_type_name FROM test_types");
          while ($type = $types->fetch_assoc()):
          ?>
            <option value="<?= $type['id'] ?>"><?= $type['test_type_name'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-3">
        <label>Date From</label>
        <input type="date" name="date_from" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Date To</label>
        <input type="date" name="date_to" class="form-control">
      </div>
      <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
      </div>
    </div>
  </form>

  <?php if ($_GET): ?>
    <?php
    // Build query conditions
    $where = [];

    if (!empty($_GET['test_id'])) {
      $test_id = $conn->real_escape_string($_GET['test_id']);
      $where[] = "t.test_id LIKE '%$test_id%'";
    }

    if (!empty($_GET['product_id'])) {
      $product_id = $conn->real_escape_string($_GET['product_id']);
      $where[] = "t.product_id LIKE '%$product_id%'";
    }

    if (!empty($_GET['test_status'])) {
      $status = $conn->real_escape_string($_GET['test_status']);
      $where[] = "t.test_status = '$status'";
    }

    if (!empty($_GET['test_type_id'])) {
      $type_id = (int) $_GET['test_type_id'];
      $where[] = "t.test_type_id = $type_id";
    }

    if (!empty($_GET['date_from'])) {
      $from = $conn->real_escape_string($_GET['date_from']);
      $where[] = "DATE(t.created_at) >= '$from'";
    }

    if (!empty($_GET['date_to'])) {
      $to = $conn->real_escape_string($_GET['date_to']);
      $where[] = "DATE(t.created_at) <= '$to'";
    }

    $query = "SELECT t.*, tt.test_type_name FROM tests t 
              JOIN test_types tt ON t.test_type_id = tt.id";

    if (!empty($where)) {
      $query .= " WHERE " . implode(" AND ", $where);
    }

    $query .= " ORDER BY t.created_at DESC";
    $results = $conn->query($query);
    ?>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Test ID</th>
          <th>Product ID</th>
          <th>Test Type</th>
          <th>Status</th>
          <th>Criteria</th>
          <th>Output</th>
          <th>Tested By</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($results && $results->num_rows > 0): ?>
        <?php $i = 1; while ($row = $results->fetch_assoc()): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['test_id']) ?></td>
            <td><?= htmlspecialchars($row['product_id']) ?></td>
            <td><?= htmlspecialchars($row['test_type_name']) ?></td>
            <td>
              <?php if ($row['test_status'] === 'Passed'): ?>
                <span class="badge bg-success">Passed</span>
              <?php elseif ($row['test_status'] === 'Failed'): ?>
                <span class="badge bg-danger">Failed</span>
              <?php else: ?>
                <span class="badge bg-warning text-dark">Pending</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['criteria']) ?></td>
            <td><?= htmlspecialchars($row['output']) ?></td>
            <td><?= htmlspecialchars($row['tested_by']) ?></td>
            <td><?= date('d-M-Y', strtotime($row['created_at'])) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9" class="text-center">No matching records found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  <?php endif; ?>

</div>
</body>
</html>
