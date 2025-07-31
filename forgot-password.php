<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password | Coinku</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .container { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; text-align: center; }
    h2 { color: #004aad; margin-bottom: 20px; }
    .input-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 25px; margin-bottom: 20px; outline: none; }
    .btn { background: #004aad; color: #fff; padding: 12px 25px; border: none; border-radius: 25px; font-weight: bold; cursor: pointer; width: 100%; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Lupa Password?</h2>
    <form method="POST" action="<?= site_url('forgot-password') ?>">
      <div class="input-group">
        <input type="email" name="email" placeholder="Masukkan email Anda" required>
      </div>
      <button class="btn" type="submit">Kirim Link Reset</button>
    </form>
  </div>
</body>
</html>
