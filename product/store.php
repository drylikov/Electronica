
<?php
require_once('../config/db.php');
require_once('../includes/functions.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values
    $product_code = $_POST['product_code'];
    $revision = $_POST['revision'];
    $manufacture_number = $_POST['manufacture_number'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];

    // Generate 10-digit Product ID (e.g., SWG23A1001)
    $product_id = generateProductId($product_code, $revision, $manufacture_number);

    // Prepare and execute insert
    $stmt = $conn->prepare("INSERT INTO products (product_id, product_code, revision, manufacture_number, product_name, product_type) 
                            VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssss", $product_id, $product_code, $revision, $manufacture_number, $product_name, $product_type);

    if ($stmt->execute()) {
        // Redirect with success
        header("Location: view.php?success=1");
        exit;
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
