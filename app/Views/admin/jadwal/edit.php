<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm" style="max-width: 700px; margin:auto;">
    <h3 class="mb-3">Edit Jadwal</h3>

    <?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

    <form method="post" action="<?= base_url('admin/jadwal/update/'.$jadwal['id']) ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" value="<?= $jadwal['nama_kelas'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mata Kuliah</label>
            <select name="id_mata_kuliah" class="form-select" required>
                <?php foreach($mataKuliah as $mk): ?>
                    <option value="<?= $mk['id_mata_kuliah'] ?>" 
                        <?= $mk['id_mata_kuliah'] == $jadwal['id_mata_kuliah'] ? 'selected' : '' ?>>
                        <?= $mk['nama_mata_kuliah'] ?> (<?= $mk['sks'] ?> SKS)
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Dosen</label>
            <select name="nidn" class="form-select" required>
                <?php foreach($dosen as $d): ?>
                    <option value="<?= $d['nidn'] ?>" 
                        <?= $d['nidn'] == $jadwal['nidn'] ? 'selected' : '' ?>>
                        <?= $d['nama'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ruangan</label>
            <select name="id_ruangan" class="form-select" required>
                <?php foreach($ruangan as $r): ?>
                    <option value="<?= $r['id_ruangan'] ?>" 
                        <?= $r['id_ruangan'] == $jadwal['id_ruangan'] ? 'selected' : '' ?>>
                        <?= $r['nama_ruangan'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="row mb-3">
<div class="mb-3">
    <label class="form-label">Hari</label>
    <select name="hari" class="form-select" required>
        <?php 
        $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        foreach($hariList as $h): ?>
            <option value="<?= $h ?>" <?= ($jadwal['hari'] == $h) ? 'selected' : '' ?>><?= $h ?></option>
        <?php endforeach; ?>
    </select>
</div>

            <div class="col">
                <label class="form-label">Jam</label>
                <input type="time" name="jam" value="<?= $jadwal['jam'] ?>" class="form-control" required>
            </div>
        </div>

        <div class="text-end">
            <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
