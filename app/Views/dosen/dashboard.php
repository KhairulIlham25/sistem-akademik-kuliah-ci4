<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    Dashboard Dosen
  </div>

  <div class="card-body">
    <p>Selamat datang, <strong><?= session()->get('nama_user') ?></strong>!</p>
    <p>Gunakan menu di sidebar kiri untuk melihat jadwal mengajar atau mengisi nilai mahasiswa.</p>

    <a href="<?= base_url('dosen/jadwal') ?>" class="btn btn-primary mt-3">Lihat Jadwal Mengajar</a>
  </div>
</div>

<?= $this->endSection() ?>
