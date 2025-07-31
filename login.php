<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Coinku</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .container { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; text-align: center; }
    .logo { font-size: 24px; font-weight: bold; color: #004aad; margin-bottom: 10px; }
    .subtitle { color: #007bff; margin-bottom: 30px; }
    .input-group { margin-bottom: 20px; }
    .input-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 25px; outline: none; }
    .btn { width: 100%; padding: 12px; border: none; border-radius: 25px; background: #004aad; color: #fff; font-weight: bold; cursor: pointer; margin-bottom: 10px; }
    .btn-secondary { background: #007bff; }
    .or { text-align: center; margin: 20px 0; color: #555; }
    .error { color: red; font-size: 14px; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">💰 COINKU</div>
    <div class="subtitle">Kelola semua keuangan <br/> Anda dengan mudah</div>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('login') ?>">
      <div class="input-group">
        <input type="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
      </div>
      <button class="btn" type="submit">Login</button>
    </form>

    <div class="or">atau</div>
    <button class="btn btn-secondary" onclick="window.location.href='<?= site_url('register') ?>'">Buat akun baru</button>
  </div>
</body>
</html>
