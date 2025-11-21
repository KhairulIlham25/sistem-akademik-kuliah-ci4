<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    Dashboard Admin
  </div>

  <div class="card-body">
    <p>Selamat datang, <strong><?= session()->get('nama_user') ?></strong>!</p>
    <p>Gunakan menu di sidebar kiri untuk mengelola data berikut:</p>

    <ul class="mt-3">
      <li>Kelola Data Mahasiswa</li>
      <li>Kelola Data Dosen</li>
      <li>Kelola Data Ruangan</li>
      <li>Kelola Jadwal Perkuliahan</li>
    </ul>
  </div>
</div>

<?= $this->endSection() ?>
