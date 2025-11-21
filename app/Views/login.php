<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Sistem Akademik</title>

  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom -->
  <style>
    body {
      background: #F4F7FB;
      font-family: 'Poppins', sans-serif;
    }
    .login-box {
      max-width: 420px;
      margin: 80px auto;
      background: #ffffff;
      border-radius: 12px;
      padding: 35px;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.05);
    }
    .login-title {
      font-weight: 600;
      color: #1E3A8A;
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-login {
      background: #1E3A8A;
      border: none;
      font-weight: 500;
    }
    
    .btn-login:hover {
      background: #3B82F6;
    }
    .alert {
      font-size: 14px;
    }
  </style>

</head>
<body>

<div class="login-box">

  <h3 class="login-title">Sistem Akademik Kuliah</h3>

  <?php if(session()->getFlashdata('error')): ?>
  <div class="alert alert-danger">
      <?= session()->getFlashdata('error') ?>
  </div>
  <?php endif; ?>

  <form action="<?= base_url('auth/login') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" autocomplete="off" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" autocomplete="new-password" required>
    </div>

    <button type="submit" class="btn btn-login w-100 py-2 mt-2 text-white">Login</button>
  </form>

</div>

</body>
</html>
