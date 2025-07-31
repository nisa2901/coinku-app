<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coinku</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      padding-bottom: 80px; /* agar tidak ketutup nav bawah */
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>
</head>
<body>

  <!-- Konten Utama -->
  <main class="container mt-4">
    <?= $this->renderSection('content') ?>
  </main>

  <!-- Bottom Navbar -->
  <nav class="navbar fixed-bottom bg-white border-top shadow-sm">
    <div class="container-fluid d-flex justify-content-around py-2">
      <a href="<?= site_url('dashboard') ?>" class="text-primary"><i class="bi bi-house-door-fill fs-5"></i></a>
      <a href="#" class="text-dark"><i class="bi bi-arrow-left-right fs-5"></i></a>
      <a href="#" class="text-dark"><i class="bi bi-bar-chart-line-fill fs-5"></i></a>
      <a href="#" class="text-dark"><i class="bi bi-gear-fill fs-5"></i></a>
      <a href="#" class="text-dark"><i class="bi bi-three-dots fs-5"></i></a>
    </div>
  </nav>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
