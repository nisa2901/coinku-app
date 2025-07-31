<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Coinku | Start</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      text-align: center;
    }
    .logo {
      font-size: 50px;
      color: #004aad;
      margin-bottom: 10px;
    }
    .title {
      font-size: 28px;
      font-weight: bold;
      color: #004aad;
      margin-bottom: 10px;
    }
    .subtitle {
      color: #007bff;
      margin-bottom: 40px;
    }
    .btn {
      background: #007bff;
      color: #fff;
      padding: 12px 40px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0,0,0,0.2);
      text-decoration: none;
    }
    .btn:hover {
      background: #005ec2;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">💰</div>
    <div class="title">COINKU</div>
    <div class="subtitle">Manajer uang pribadi<br/>Anda</div>
    <a href="<?= site_url('login') ?>" class="btn">Mulai</a>
  </div>
</body>
</html>
