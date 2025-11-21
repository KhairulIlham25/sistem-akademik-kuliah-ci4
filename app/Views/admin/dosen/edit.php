<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h2>Edit Dosen</h2>
<form action="<?= base_url('admin/dosen/update/'.$dsn['nidn']) ?>" method="post">
            <?= csrf_field() ?>
    <div class="mb-3">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control" value="<?= $dsn['nidn'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $dsn['nama'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= $dsn['email'] ?>">
    </div>
    <div class="mb-3">
        <label>Prodi</label>
        <input type="text" name="prodi" class="form-control" value="<?= $dsn['prodi'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('admin/dosen') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
