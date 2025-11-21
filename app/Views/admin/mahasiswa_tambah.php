<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/validation_errors') ?>

<h2>Tambah Mahasiswa</h2>

<!-- ✅ Tampilkan error validasi di sini -->
<?php if (isset($validation)): ?>
  <div class="alert alert-danger">
    <?= $validation->listErrors() ?>
  </div>
<?php endif; ?>

<form action="<?= base_url('admin/mahasiswa/simpan') ?>" method="post">
  <?= csrf_field() ?>

  <div>
    <label for="nim">NIM:</label>
    <input type="text" name="nim" id="nim" value="<?= old('nim') ?>">
  </div>

  <div>
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" value="<?= old('nama') ?>">
  </div>

  <div>
    <label for="prodi">Program Studi:</label>
    <input type="text" name="prodi" id="prodi" value="<?= old('prodi') ?>">
  </div>

  <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>
