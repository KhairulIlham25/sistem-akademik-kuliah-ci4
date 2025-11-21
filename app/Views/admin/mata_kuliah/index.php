<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h2>Daftar Mata Kuliah</h2>

<a href="<?= base_url('admin/mata-kuliah/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Mata Kuliah</a>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
<thead class="table-primary">
<tr>
<th>No</th>
<th>Kode</th>
<th>Nama Mata Kuliah</th>
<th>SKS</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($mk as $m): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $m['kode_mata_kuliah'] ?></td>
<td><?= $m['nama_mata_kuliah'] ?></td>
<td><?= $m['sks'] ?></td>
<td>
<a href="<?= base_url('admin/mata-kuliah/edit/'.$m['id_mata_kuliah']) ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="<?= base_url('admin/mata-kuliah/hapus/'.$m['id_mata_kuliah']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?= $this->endSection() ?>
