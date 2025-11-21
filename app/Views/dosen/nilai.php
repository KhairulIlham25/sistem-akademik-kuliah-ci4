<?= $this->extend('layouts/dosen_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Daftar Nilai Mahasiswa</h2>
  <p><strong>Mata Kuliah:</strong> <?= $jadwal['nama_mata_kuliah'] ?> |
     <strong>Kelas:</strong> <?= $jadwal['nama_kelas'] ?></p>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Nilai Huruf</th>
        <th>Nilai Mutu</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach($mahasiswa as $m): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $m['nim'] ?></td>
        <td><?= $m['nama'] ?></td>
        <td><?= $m['nilai_huruf'] ?? '-' ?></td>
        <td><?= $m['nilai_mutu'] ?? '-' ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="<?= base_url('dosen/jadwal') ?>" class="btn btn-secondary mt-3">Kembali ke Jadwal</a>
</div>

<?= $this->endSection() ?>
