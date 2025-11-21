<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h2>Edit Ruangan</h2>
<form action="<?= base_url('admin/ruangan/update/'.$ruang['id_ruangan']) ?>" method="post">
            <?= csrf_field() ?>
    <div class="mb-3">
        <label>Nama Ruangan</label>
        <input type="text" name="nama_ruangan" class="form-control" value="<?= $ruang['nama_ruangan'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Kapasitas</label>
        <input type="number" name="kapasitas" class="form-control" value="<?= $ruang['kapasitas'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('admin/ruangan') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
