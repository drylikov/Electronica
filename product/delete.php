
<?php
require_once('../config/db.php');

// Validate ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Product ID.");
}

$id = $_GET['id'];

// Prepare delete statement
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view.php?deleted=1");
    exit;
} else {
    echo "❌ Failed to delete product: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
