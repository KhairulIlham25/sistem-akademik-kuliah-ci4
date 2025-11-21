<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Daftar Mahasiswa</h2>

<a href="<?= base_url('admin/mahasiswa/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive"> <!-- Tambahkan ini -->
<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th style="min-width:120px;">Aksi</th> <!-- agar tombol tidak mepet -->
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($mahasiswa as $m): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $m['nim'] ?></td>
            <td><?= $m['nama'] ?></td>
            <td><?= $m['email'] ?></td>
            <td><?= $m['prodi'] ?></td>
            <td><?= $m['angkatan'] ?></td>
            <td>
                <a href="<?= base_url('admin/mahasiswa/edit/'.$m['nim']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('admin/mahasiswa/hapus/'.$m['nim']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div> <!-- Tutup table-responsive -->


<?= $this->endSection() ?>
