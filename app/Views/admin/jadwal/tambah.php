<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm" style="max-width: 700px; margin:auto;">
    <h3 class="mb-3">Tambah Jadwal</h3>

    <?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

    <form method="post" action="<?= base_url('admin/jadwal/simpan') ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mata Kuliah</label>
                <select id="id_mata_kuliah" name="id_mata_kuliah" class="form-control" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    <?php foreach ($mataKuliah as $mk): ?>
                        <option value="<?= $mk['id_mata_kuliah'] ?>" data-sks="<?= $mk['sks'] ?>">
                            <?= $mk['nama_mata_kuliah'] ?> (<?= $mk['sks'] ?> SKS)
                        </option>
                    <?php endforeach; ?>
                </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Dosen</label>
            <select name="nidn" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                <?php foreach($dosen as $d): ?>
                    <option value="<?= $d['nidn'] ?>"><?= $d['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ruangan</label>
            <select name="id_ruangan" class="form-select" required>
                <option value="">-- Pilih Ruangan --</option>
                <?php foreach($ruangan as $r): ?>
                    <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row mb-3">
<div class="mb-3">
    <label class="form-label">Hari</label>
    <select name="hari" class="form-select" required>
        <option value="">-- Pilih Hari --</option>
        <option value="Senin">Senin</option>
        <option value="Selasa">Selasa</option>
        <option value="Rabu">Rabu</option>
        <option value="Kamis">Kamis</option>
        <option value="Jumat">Jum'at</option>
        <option value="Sabtu">Sabtu</option>
        <option value="Minggu">Minggu</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Jam Mulai</label>
    <input type="time" name="jam_mulai" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Jam Selesai (Otomatis)</label>
    <input type="time" name="jam_selesai" class="form-control" readonly>
</div>


        </div>

        <div class="text-end">
            <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mataKuliahSelect = document.getElementById('id_mata_kuliah');
    const jamMulaiInput = document.getElementById('jam_mulai');
    const jamSelesaiInput = document.getElementById('jam_selesai');
    let sks = 0;

    mataKuliahSelect.addEventListener('change', function() {
        sks = this.options[this.selectedIndex].getAttribute('data-sks');
        hitungJamSelesai();
    });

    jamMulaiInput.addEventListener('input', function() {
        hitungJamSelesai();
    });

    function hitungJamSelesai() {
        if (!jamMulaiInput.value || !sks) return;

        let [hour, minute] = jamMulaiInput.value.split(':').map(Number);
        let totalMinutes = hour * 60 + minute + (sks * 50); // 1 SKS = 50 menit

        let endHour = Math.floor(totalMinutes / 60);
        let endMinute = totalMinutes % 60;

        jamSelesaiInput.value = 
            String(endHour).padStart(2, '0') + ':' + String(endMinute).padStart(2, '0');
    }
});
</script>

<?= $this->endSection() ?>
