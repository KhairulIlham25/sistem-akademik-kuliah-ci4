<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Dosen</h2>
<form action="<?= base_url('admin/dosen/simpan') ?>" method="post">
        <?= csrf_field() ?>
    <div class="mb-3">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Prodi</label>
        <input type="text" name="prodi" class="form-control">
    </div>
<div class="mb-3">
  <label>Password (untuk login)</label>
  <input type="password" name="password" class="form-control" required>
</div>


    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('admin/dosen') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>
