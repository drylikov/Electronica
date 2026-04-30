
<?php
require_once('../config/db.php');

$query = "SELECT * FROM test_types ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Test Types</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">🧪 All Test Types</h2>
    <a href="add.php" class="btn btn-success">➕ Add New</a>
  </div>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">✅ Test type added successfully!</div>
  <?php endif; ?>

  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Test Type Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0):
        $i = 1;
        while ($row = $result->fetch_assoc()):
      ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['test_type_name']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
        </tr>
      <?php endwhile; else: ?>
        <tr><td colspan="3" class="text-center">No test types found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
