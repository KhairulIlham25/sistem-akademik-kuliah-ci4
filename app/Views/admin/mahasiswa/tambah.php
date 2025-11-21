<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Tambah Mahasiswa</h3>

<div class="card p-4 shadow-sm" style="max-width: 650px;">
    <form action="<?= base_url('admin/mahasiswa/simpan') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="contoh: mahasiswa@umrah.ac.id">
        </div>

        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input type="text" name="prodi" class="form-control" placeholder="Contoh: Informatika">
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control" placeholder="Contoh: 2022">
        </div>

        <div class="mb-3">
            <label>Password (untuk login)</label>
            <input type="password" name="password" class="form-control" required>
        </div>


        <div class="d-flex justify-content-between mt-3">
            <a href="<?= base_url('admin/mahasiswa') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
