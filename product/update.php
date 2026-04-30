
<?php
require_once('../config/db.php');

// Check if form submitted properly
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get values
    $id = $_POST['id'];
    $product_code = trim($_POST['product_code']);
    $revision = trim($_POST['revision']);
    $manufacture_number = trim($_POST['manufacture_number']);
    $product_name = trim($_POST['product_name']);
    $product_type = trim($_POST['product_type']);

    // Re-generate Product ID (10-digit)
    $product_id = strtoupper(substr($product_code, 0, 3)) . '-' . strtoupper($revision) . '-' . $manufacture_number;

    // Update DB
    $stmt = $conn->prepare("UPDATE products SET 
        product_id = ?, 
        product_code = ?, 
        revision = ?, 
        manufacture_number = ?, 
        product_name = ?, 
        product_type = ? 
        WHERE id = ?");

    $stmt->bind_param("ssssssi", $product_id, $product_code, $revision, $manufacture_number, $product_name, $product_type, $id);

    if ($stmt->execute()) {
        header("Location: view.php?updated=1");
        exit;
    } else {
        echo "❌ Error updating product: " . $stmt->error;
    }

} else {
    echo "❌ Invalid request.";
}
?>
