<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm" style="max-width: 600px; margin:auto;">
    <h3 class="mb-3">Edit Mahasiswa</h3>

    <form action="<?= base_url('admin/mahasiswa/update/'.$mhs['nim']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" value="<?= $mhs['nim'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" value="<?= $mhs['nama'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="<?= $mhs['email'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Prodi</label>
            <input type="text" name="prodi" value="<?= $mhs['prodi'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" value="<?= $mhs['angkatan'] ?>" class="form-control">
        </div>

        <div class="text-end">
            <a href="<?= base_url('admin/mahasiswa') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
