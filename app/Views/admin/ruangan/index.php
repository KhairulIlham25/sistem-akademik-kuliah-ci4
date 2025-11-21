<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Daftar Ruangan</h2>

<a href="<?= base_url('admin/ruangan/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Ruangan</a>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ruangan</th>
            <th>Kapasitas</th>
            <th style="min-width:120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($ruangan as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['nama_ruangan'] ?></td>
            <td><?= $r['kapasitas'] ?></td>
            <td>
                <a href="<?= base_url('admin/ruangan/edit/'.$r['id_ruangan']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('admin/ruangan/hapus/'.$r['id_ruangan']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?= $this->endSection() ?>
