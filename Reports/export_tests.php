
<?php
require_once('../config/db.php');

// Optional filters (agar search ke through export karna ho)
$where = [];
if (!empty($_GET['status'])) {
    $status = $conn->real_escape_string($_GET['status']);
    $where[] = "t.test_status = '$status'";
}
if (!empty($_GET['type_id'])) {
    $type = (int)$_GET['type_id'];
    $where[] = "t.test_type_id = $type";
}

$sql = "SELECT t.test_id, t.product_id, tt.test_type_name, t.test_status,
        t.criteria, t.output, t.remarks, t.tested_by, t.created_at
        FROM tests t
        JOIN test_types tt ON t.test_type_id = tt.id";

if ($where) $sql .= " WHERE " . implode(' AND ', $where);
$sql .= " ORDER BY t.created_at DESC";

$result = $conn->query($sql);

// Excel headers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=tests_export.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Headings row
$columns = ["Test ID", "Product ID", "Test Type", "Status", "Criteria", "Output", "Remarks", "Tested By", "Date"];
echo implode("\t", $columns) . "\n";

// Data rows
while ($row = $result->fetch_assoc()) {
    $line = [
        $row['test_id'],
        $row['product_id'],
        $row['test_type_name'],
        $row['test_status'],
        $row['criteria'],
        $row['output'],
        $row['remarks'],
        $row['tested_by'],
        date('d-M-Y H:i', strtotime($row['created_at']))
    ];
    echo implode("\t", array_map("strip_tags", $line)) . "\n";
}
exit;
