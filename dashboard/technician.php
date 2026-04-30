
<?php
require_once('../includes/auth.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Technician Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="text-center mb-4">🧑‍🔧 Welcome, <?= $_SESSION['user']['username'] ?> (Technician)</h3>

  <div class="d-grid gap-3">
    <a href="../test/add.php" class="btn btn-success">➕ Add New Test</a>
    <a href="../test/view.php" class="btn btn-primary">📋 View All Tests</a>
    <a href="../search/index.php" class="btn btn-secondary">🔍 Advanced Search</a>
    <a href="../auth/logout.php" class="btn btn-danger">🚪 Logout</a>
  </div>
</div>
</body>
</html>
