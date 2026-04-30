
<?php
require_once('../config/db.php');

$query = "SELECT
  tt.test_type_name,
  SUM(CASE WHEN t.test_status = 'Passed' THEN 1 ELSE 0 END) AS passed,
  SUM(CASE WHEN t.test_status = 'Failed' THEN 1 ELSE 0 END) AS failed
FROM tests t
JOIN test_types tt ON t.test_type_id = tt.id
GROUP BY tt.test_type_name";

$result = $conn->query($query);

$labels = $passed = $failed = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['test_type_name'];
    $passed[] = $row['passed'];
    $failed[] = $row['failed'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test Charts - SRS Electrical</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .back-btn {
      position: absolute;
      top: 20px;
      left: 25px;
    }
  </style>
</head>
<body>
<div class="container mt-5 position-relative">
  
  <!-- 🔙 Back Button -->
    <a href="/electronica_Project/admin/dashboard.php" class="btn btn-secondary back-btn">← Back to Dashboard</a>




  <!-- Title -->
  <h2 class="text-center mb-5">📊 Test Results by Type</h2>

  <!-- Charts -->
  <div class="row">
    <div class="col-md-6 mb-4">
      <canvas id="barChart"></canvas>
    </div>
    <div class="col-md-6 mb-4">
      <canvas id="pieChart"></canvas>
    </div>
  </div>
</div>

<!-- JS Charts -->
<script>
  const labels = <?= json_encode($labels) ?>;
  const passed = <?= json_encode($passed) ?>;
  const failed = <?= json_encode($failed) ?>;

  // Bar Chart
  new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: '✅ Passed',
          data: passed,
          backgroundColor: 'rgba(40, 167, 69, 0.7)'
        },
        {
          label: '❌ Failed',
          data: failed,
          backgroundColor: 'rgba(220, 53, 69, 0.7)'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'top' },
        title: { display: true, text: 'Test Results (Bar)' }
      }
    }
  });

  // Pie Chart
  new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Total Tests',
        data: labels.map((_, i) => passed[i] + failed[i]),
        backgroundColor: [
          'rgba(0, 123, 255, 0.6)',
          'rgba(255, 193, 7, 0.6)',
          'rgba(255, 99, 132, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(255, 159, 64, 0.6)'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'top' },
        title: { display: true, text: 'Total Tests per Type (Pie)' }
      }
    }
  });
</script>

</body>
</html>
