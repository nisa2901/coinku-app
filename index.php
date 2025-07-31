<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <title>Rekap</title>
</head>
<body>
    <div class="container">
        <h1>Rekap</h1>
        <div class="tabs">
            <button id="income-tab" class="active">Pemasukan</button>
            <button id="expense-tab">Pengeluaran</button>
            <button id="all-tab">Semua</button>
        </div>
        <div id="chart-container" class="chart green">
            <div class="chart-label">100%</div>
            <div class="chart-value">Rp.50.000</div>
        </div>
        <div class="total">
            <div class="summary">Total Pemasukan: +Rp.50.000</div>
        </div>
        <div class="transaction">
            <button class="details">Transfer</button>
            <div class="total-transaction">Total: +Rp.50.000</div>
        </div>
    </div>
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
