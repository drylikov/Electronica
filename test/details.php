
<?php
require_once('../config/db.php');

// Check if test ID is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Test ID");
}

$test_id = $_GET['id'];

// Fetch full test details using test_id
$stmt = $conn->prepare("SELECT t.*, tt.test_type_name, p.product_name 
                        FROM tests t
                        JOIN test_types tt ON t.test_type_id = tt.id
                        JOIN products p ON t.product_id = p.product_id
                        WHERE t.test_id = ?");
$stmt->bind_param("s", $test_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Test not found.");
}

$test = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test Details - <?= htmlspecialchars($test['test_id']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <a href="view.php" class="btn btn-secondary mb-3">← Back to All Tests</a>
  <div class="card shadow">
    <div class="card-header bg-secondary text-white">
      <h5 class="mb-0">Test Details for ID: <?= htmlspecialchars($test['test_id']) ?></h5>
    </div>
    <div class="card-body">
      <p><strong>Product:</strong> <?= htmlspecialchars($test['product_name']) ?> (<?= $test['product_id'] ?>)</p>
      <p><strong>Test Type:</strong> <?= htmlspecialchars($test['test_type_name']) ?></p>
      <p><strong>Status:</strong>
        <?php if ($test['test_status'] === 'Passed'): ?>
          <span class="badge bg-success">Passed</span>
        <?php elseif ($test['test_status'] === 'Failed'): ?>
          <span class="badge bg-danger">Failed</span>
        <?php else: ?>
          <span class="badge bg-warning text-dark">Pending</span>
        <?php endif; ?>
      </p>
      <p><strong>Criteria:</strong> <?= nl2br(htmlspecialchars($test['criteria'])) ?></p>
      <p><strong>Output:</strong> <?= nl2br(htmlspecialchars($test['output'])) ?></p>
      <p><strong>Remarks:</strong> <?= nl2br(htmlspecialchars($test['remarks'])) ?></p>
      <p><strong>Tested By:</strong> <?= htmlspecialchars($test['tested_by']) ?></p>
      <p><strong>Date:</strong> <?= date('d-M-Y H:i A', strtotime($test['created_at'])) ?></p>
    </div>
  </div>
</div>

</body>
</html>
