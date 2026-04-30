
<?php
require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $test_type_name = trim($_POST['test_type_name']);
    $description     = trim($_POST['description']);

    if (!empty($test_type_name)) {
        $stmt = $conn->prepare("INSERT INTO test_types (test_type_name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $test_type_name, $description);

        if ($stmt->execute()) {
            header("Location: view.php?success=1");
            exit;
        } else {
            $error = "❌ Failed to add test type.";
        }
    } else {
        $error = "⚠️ Please enter a valid test type name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Test Type</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <a href="view.php" class="btn btn-secondary mb-3">← Back to All Test Types</a>

  <h2 class="mb-4 text-center">➕ Add New Test Type</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Test Type Name</label>
      <input type="text" name="test_type_name" class="form-control" required placeholder="e.g. Voltage Test">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" placeholder="Describe the purpose or scope of this test type..."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Type</button>
  </form>
</div>

</body>
</html>
