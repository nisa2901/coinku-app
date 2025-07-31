<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Akun Baru | Coinku</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .container { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; }
    h2 { text-align: center; color: #004aad; margin-bottom: 30px; }
    .input-group { margin-bottom: 20px; position: relative; }
    .input-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 25px; outline: none; }
    .toggle-password { position: absolute; right: 20px; top: 12px; cursor: pointer; color: #004aad; }
    .btn { width: 100%; padding: 12px; border: none; border-radius: 25px; background: #004aad; color: #fff; font-weight: bold; cursor: pointer; }
    .or { text-align: center; margin: 20px 0; color: #555; }
    .btn-secondary { background: #007bff; }
    .errors { color: red; font-size: 14px; margin-bottom: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Buat Akun Baru</h2>

    <?php if (session()->getFlashdata('errors')): ?>
      <div class="errors">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
          <div><?= esc($error) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= site_url('register') ?>" method="POST">
      <div class="input-group">
        <input type="text" name="username" placeholder="Username" value="<?= old('name') ?>" required>
      </div>
      <div class="input-group">
        <input type="email" name="email" placeholder="E-mail" value="<?= old('email') ?>" required>
      </div>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
      </div>
      <div class="input-group">
        <input type="password" id="confirm-password" name="pass_confirm" placeholder="Masukkan Password lagi" required>
        <span class="toggle-password" onclick="togglePassword('confirm-password')">👁️</span>
      </div>
      <button class="btn" type="submit">Buat akun baru</button>
    </form>

    <div class="or">atau</div>
    <button class="btn btn-secondary" onclick="window.location.href='<?= site_url('login') ?>'">Sudah memiliki akun</button>
  </div>

  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
