<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Tambah Mata Kuliah</h3>

<div class="card p-4" style="max-width:600px;">
<form method="post" action="<?= base_url('admin/mata-kuliah/simpan') ?>">
<?= csrf_field() ?>

<div class="mb-3">
<label>Kode Mata Kuliah</label>
<input type="text" name="kode_mata_kuliah" class="form-control" required>
</div>

<div class="mb-3">
<label>Nama Mata Kuliah</label>
<input type="text" name="nama_mata_kuliah" class="form-control" required>
</div>

<div class="mb-3">
<label>Jumlah SKS</label>
<input type="number" name="sks" class="form-control" required>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="<?= base_url('admin/mata-kuliah') ?>" class="btn btn-secondary">Batal</a>

</form>
</div>

<?= $this->endSection() ?>
