<?= $this->extend('layouts/dosen_layout') ?>\
<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Jadwal Mengajar</h3>

<div class="table-responsive">
<table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Mata Kuliah</th>
            <th>Ruangan</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($jadwal as $j): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $j['nama_kelas'] ?></td>
            <td><?= $j['nama_mata_kuliah'] ?></td>
            <td><?= $j['nama_ruangan'] ?></td>
            <td><?= $j['hari'] ?></td>
            <td><?= date('H:i', strtotime($j['jam_mulai'])) . ' - ' . date('H:i', strtotime($j['jam_selesai'])) ?></td>
            <td>
                <a href="<?= base_url('dosen/input-nilai/'.$j['id']) ?>" class="btn btn-primary btn-sm">
                  Input Nilai
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?= $this->endSection() ?>
