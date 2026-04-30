
<?php
require_once('../config/db.php');

// Fetch all test records with product and test type info
$sql = "SELECT t.*, p.product_name, tt.test_type_name
        FROM tests t
        JOIN products p ON t.product_id = p.product_id
        JOIN test_types tt ON t.test_type_id = tt.id
        ORDER BY t.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Test Records - SRS Electrical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .table-container { margin-top: 40px; }

        @media print {
       .btn, .no-print { display: none !important; }
       table { font-size: 11px; }
       }
    </style>
</head>
<body>
<div class="container table-container">

<a href="../Reports/export_tests.php" class="btn btn-outline-success mb-3">
  ⬇️ Export to Excel
</a>

<!-- 🖨️ Print Button -->
      <button onclick="window.print()" class="btn btn-outline-secondary mb-3 no-print">
        🖨️ Print Page
      </button>

    <h2 class="text-center mb-4 text-secondary">📋 All Test Records</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success">✅ Test record added successfully!</div>
    <?php endif; ?>
<div class="container table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0 text-secondary">📋 All Test Records</h2>

        <!-- 🔸 NEW BUTTON -->
        <a href="../search/index.php" class="btn btn-outline-primary">
            🔍 Advanced Search
        </a>
    </div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success">
            ✅ Test record added successfully!
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Test ID</th>
                <th>Product ID</th>
                <th>Test Type</th>
                <th>Status</th>
                <th>Tester</th>
                <th>Date</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php $count = 1; while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $count++ ?></td>
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
                    <td><?= htmlspecialchars($row['tested_by']) ?></td>
                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                  <td class="text-center"> 
               <a href="details.php?id=<?= urlencode($row['test_id']) ?>" class="btn btn-sm btn-primary">View</a>
               </td>

                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8" class="text-center">No test records found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
