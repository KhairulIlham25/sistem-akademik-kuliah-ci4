<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Akademik Kuliah</title>

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1E3A8A, #3B82F6);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .login-card h3 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #1E3A8A;
            text-align: center;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-login {
            background: #1E3A8A;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            color: white;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #3B82F6;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 13px;
            color: #555;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h3>Login Sistem Akademik</h3>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

<form method="post" action="<?= base_url('auth/login') ?>" autocomplete="off">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Masukkan username" autocomplete="off" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" autocomplete="new-password" required>
    </div>

    <button class="btn btn-login">Login</button>
</form>

    <p class="footer-text">&copy; <?= date('Y') ?> Sistem Akademik Kuliah<br>UMRAH</p>
</div>

</body>
</html>
