<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Daftar Dosen</h2>

<a href="<?= base_url('admin/dosen/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Dosen</a>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive"> <!-- Tambahkan responsif -->
<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>No</th>
            <th>NIDN</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Prodi</th>
            <th style="min-width:120px;">Aksi</th> <!-- Agar tombol rapi -->
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($dosen as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nidn'] ?></td>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['email'] ?></td>
            <td><?= $d['prodi'] ?></td>
            <td>
                <a href="<?= base_url('admin/dosen/edit/'.$d['nidn']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('admin/dosen/hapus/'.$d['nidn']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div> <!-- Tutup table-responsive -->

<?= $this->endSection() ?>
