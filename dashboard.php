<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title) ?></title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
    .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 800px; margin: auto; }
    .summary { display: flex; justify-content: space-around; margin-bottom: 20px; }
    .summary div { padding: 10px 20px; border-radius: 5px; color: white; font-weight: bold; }
    .income { background: green; }
    .expense { background: red; }
    form { margin-top: 20px; }
    label { display: block; margin-bottom: 5px; font-weight: bold; }
    input[type="number"] { width: 100%; padding: 8px; margin-bottom: 10px; }
    button { padding: 8px 12px; border: none; border-radius: 5px; background: #004aad; color: white; cursor: pointer; }
  </style>
</head>
<body>

<div class="card">
  <h2>Laporan Keuangan</h2>

  <div class="summary">
    <div class="income">
      Pemasukan<br>Rp <?= number_format($report['income'], 0, ',', '.') ?>
    </div>
    <div class="expense">
      Pengeluaran<br>Rp <?= number_format($report['expense'], 0, ',', '.') ?>
    </div>
  </div>

  <div>
    <h4>Grafik</h4>
    <!-- Contoh pakai <img>, ganti src sesuai lokasi file -->
    <img src="<?= base_url('path/to/chart.png') ?>" alt="Chart" style="width: 100%; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div>
    <h4>Edit Pemasukan & Pengeluaran</h4>
    <form action="<?= site_url('financial/update') ?>" method="post">
      <label for="income">Pemasukan (Rp)</label>
      <input type="number" name="income" id="income" value="<?= esc($report['income']) ?>">

      <label for="expense">Pengeluaran (Rp)</label>
      <input type="number" name="expense" id="expense" value="<?= esc($report['expense']) ?>">

      <button type="submit">Simpan Perubahan</button>
    </form>
  </div>
</div>
<?php if (session()->getFlashdata('message')): ?>
  <div style="color: green;"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<form action="<?= site_url('financial/update') ?>" method="post">
    <?= csrf_field() ?>
    ...
</form>

</body>
</html>