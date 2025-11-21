<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    Dashboard Mahasiswa
  </div>

  <div class="card-body">
    <p>Selamat datang, <strong><?= session()->get('nama_user') ?></strong>!</p>
    <p>Silakan pilih menu berikut untuk melakukan rencana studi atau melihat hasil studi.</p>

    <a href="<?= base_url('mahasiswa/rencana-studi') ?>" class="btn btn-primary mt-2">Buat Rencana Studi</a>
    <a href="<?= base_url('mahasiswa/hasil-studi') ?>" class="btn btn-success mt-2">Lihat Hasil Studi</a>
  </div>
</div>

<?= $this->endSection() ?>
