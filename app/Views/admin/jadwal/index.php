<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Daftar Jadwal Perkuliahan</h2>

<a href="<?= base_url('admin/jadwal/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Jadwal</a>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Mata Kuliah</th>
            <th>Ruangan</th>
            <th>Dosen</th>
            <th>Hari</th>
            <th>Jam</th>
            <th style="min-width:120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($jadwal as $j): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $j['nama_kelas'] ?></td>
            <td><?= $j['nama_mata_kuliah'] ?></td>
            <td><?= $j['nama_ruangan'] ?></td>
            <td><?= $j['nama_dosen'] ?></td>
            <td><?= $j['hari'] ?></td>
            <td><?= date('H:i', strtotime($j['jam_mulai'])) . ' - ' . date('H:i', strtotime($j['jam_selesai'])) ?></td>
            <td>
                <a href="<?= base_url('admin/jadwal/edit/'.$j['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('admin/jadwal/hapus/'.$j['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?= $this->endSection() ?>
