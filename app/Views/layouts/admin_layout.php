<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Sistem Akademik Kuliah' ?></title>

  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Sistem Akademik</a>
    <div class="ms-auto">
      <a href="<?= base_url('logout') ?>" class="btn btn-logout btn-sm">Logout</a>
    </div>
  </nav>

  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
    <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
    <a href="<?= base_url('admin/mahasiswa') ?>">Kelola Mahasiswa</a>
    <a href="<?= base_url('admin/dosen') ?>">Kelola Dosen</a>
    <a href="<?= base_url('admin/ruangan') ?>">Kelola Ruangan</a>
    <a href="<?= base_url('admin/mata-kuliah') ?>">Kelola Mata Kuliah</a> <!-- ✅ Tambahkan ini -->
    <a href="<?= base_url('admin/jadwal') ?>">Kelola Jadwal</a>
    </div>

    <!-- Main Content -->
    <div class="content flex-grow-1 overflow-auto">
      <?= $this->renderSection('content') ?>
    </div>
  </div>

  <footer>
    &copy; <?= date('Y') ?> Sistem Akademik Kuliah | Universitas Maritim Raja Ali Haji
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
