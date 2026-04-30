
<?php
require_once('../config/db.php');
require_once('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Get form data from POST
    $product_numeric_id = (int) $_POST['product_id']; // This is products.id
    $test_type_name = trim($_POST['test_type']);
    $criteria       = trim($_POST['criteria']);
    $output         = trim($_POST['output']);
    $remarks        = trim($_POST['remarks']);
    $tested_by      = trim($_POST['tested_by']);
    $test_status    = $_POST['test_status'];
    $created_at     = date('Y-m-d H:i:s');

    // 2. Get full product info using numeric ID
    $stmtProd = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmtProd->bind_param("i", $product_numeric_id);
    $stmtProd->execute();
    $product = $stmtProd->get_result()->fetch_assoc();

    if (!$product) {
        die("❌ Invalid Product Selected.");
    }

    // 3. Get actual product_id (10-digit string)
    $product_id = $product['product_id'];

    // 4. Generate test_id (12-digit unique)
    $test_id = generateTestId($product['product_code'], $product['revision'], $product['manufacture_number']);

    // 5. Get test_type_id from test_type_name
    $stmtType = $conn->prepare("SELECT id FROM test_types WHERE test_type_name = ?");
    $stmtType->bind_param("s", $test_type_name);
    $stmtType->execute();
    $resultType = $stmtType->get_result();

    if ($resultType->num_rows === 0) {
        die("❌ Invalid Test Type Selected.");
    }

    $test_type_id = $resultType->fetch_assoc()['id'];

    // 6. Insert into tests table
    $stmt = $conn->prepare("INSERT INTO tests 
        (test_id, product_id, test_type_id, test_status, criteria, output, remarks, tested_by, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // ✅ Correct bind_param type: ssissssss
    $stmt->bind_param(
        "ssissssss",
        $test_id,
        $product_id,      // 10-digit string
        $test_type_id,    // integer
        $test_status,
        $criteria,
        $output,
        $remarks,
        $tested_by,
        $created_at
    );

    // 7. Execute and redirect
    if ($stmt->execute()) {
        header("Location: view.php?success=1");
        exit;
    } else {
        die("❌ Error saving test: " . $stmt->error);
    }

    // 8. Clean up
    $stmt->close();
    $stmtType->close();
    $stmtProd->close();
    $conn->close();

} else {
    echo "❌ Invalid request method.";
}
