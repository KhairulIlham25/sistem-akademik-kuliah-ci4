<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Ruangan</h2>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>


<form action="<?= base_url('admin/ruangan/simpan') ?>" method="post">
    <?= csrf_field() ?> <!-- ✅ Tambahkan ini -->

    <div class="mb-3">
        <label>Nama Ruangan</label>
        <input type="text" name="nama_ruangan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Kapasitas</label>
        <input type="number" name="kapasitas" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('admin/ruangan') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>
