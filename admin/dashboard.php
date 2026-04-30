
<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard – SRS Electrical</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ⭐ Custom dashboard styling -->
  <style>
    body{
      background: #eef2f7 url("https://www.toptal.com/designers/subtlepatterns/uploads/geometry2.png") repeat;
      font-family: "Segoe UI", Tahoma, sans-serif;
    }
    .glass-card{
      backdrop-filter: blur(10px);
      background: rgba(255,255,255,0.75);
      border: 1px solid rgba(255,255,255,0.4);
      border-radius: 1rem;
      transition: transform .2s, box-shadow .2s;
      min-height: 160px;
      display:flex;
      flex-direction: column;
      justify-content:center;
      align-items:center;
      text-align:center;
    }
    .glass-card:hover{
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,.15);
    }
    .glass-icon{
      font-size: 2.2rem;
      line-height: 1;
    }
    .logout-btn{
      position: absolute;
      right: 2rem;
      top: 1.3rem;
    }
  </style>
</head>
<body>

<div class="container py-5 position-relative">

  <!-- Logout -->
  <a href="logout.php" class="btn btn-outline-danger logout-btn">Logout</a>


  <!-- Welcome -->
  <h2 class="text-center fw-semibold mb-5">
    👋&nbsp; Welcome, <span class="text-primary"><?= htmlspecialchars($_SESSION['admin_name']) ?></span>
  </h2>

  <!-- Grid -->
  <div class="row g-4">

    <!-- Products -->
    <div class="col-12 col-md-6 col-lg-4">
      <a href="../product/view.php" class="text-decoration-none text-dark">
        <div class="glass-card">
          <div class="glass-icon">📦</div>
          <h5 class="mt-3">Products</h5>
          <small class="text-muted">View &amp; manage products</small>
        </div>
      </a>
    </div>

    <!-- Test Types -->
    <div class="col-12 col-md-6 col-lg-4">
      <a href="../test_types/view.php" class="text-decoration-none text-dark">
        <div class="glass-card">
          <div class="glass-icon">🧪</div>
          <h5 class="mt-3">Test&nbsp;Types</h5>
          <small class="text-muted">Create &amp; edit types</small>
        </div>
      </a>
    </div>

    <!-- All Tests -->
    <div class="col-12 col-md-6 col-lg-4">
      <a href="../test/view.php" class="text-decoration-none text-dark">
        <div class="glass-card">
          <div class="glass-icon">📊</div>
          <h5 class="mt-3">All&nbsp;Tests</h5>
          <small class="text-muted">Full test registry</small>
        </div>
      </a>
    </div>

    <!-- Advanced Search -->
    <div class="col-12 col-md-6 col-lg-4">
      <a href="../search/index.php" class="text-decoration-none text-dark">
        <div class="glass-card">
          <div class="glass-icon">🔍</div>
          <h5 class="mt-3">Search</h5>
          <small class="text-muted">Advanced filter &amp; query</small>
        </div>
      </a>
    </div>

    <!-- Uploaded Reports -->
    <div class="col-12 col-md-6 col-lg-4">
      <a href="../Reports/export_tests.php/" class="text-decoration-none text-dark">
        <div class="glass-card">
          <div class="glass-icon">📁</div>
          <h5 class="mt-3">Reports</h5>
          <small class="text-muted">View uploaded PDFs</small>
        </div>
      </a>
    </div>

    <!-- Charts -->
    <div class="col-12 col-md-6 col-lg-4">
      <a href="../admin/charts.php/" class="text-decoration-none text-dark">
        <div class="glass-card">
          <div class="glass-icon">📈</div>
          <h5 class="mt-3">Charts</h5>
          <small class="text-muted">Status Reports</small>
        </div>
      </a>
    </div>

    <!-- Contact Messages -->
<div class="col-12 col-md-6 col-lg-4">
  <a href="contact_messages.php" class="text-decoration-none text-dark">
    <div class="glass-card">
      <div class="glass-icon">📨</div>
      <h5 class="mt-3">Contact Messages</h5>
      <small class="text-muted">User ke sent messages</small>
    </div>
  </a>
</div>


  </div><!-- row -->
</div><!-- container -->

</body>
</html>
