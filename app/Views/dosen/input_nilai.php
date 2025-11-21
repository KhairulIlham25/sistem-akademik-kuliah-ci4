<?= $this->extend('layouts/dosen_layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Input Nilai Mahasiswa</h3>

<p><strong>Mata Kuliah:</strong> <?= $jadwal['nama_mata_kuliah'] ?> |
   <strong>Kelas:</strong> <?= $jadwal['nama_kelas'] ?></p>

<?php if(session()->getFlashdata('success')): ?>
  <div class="alert alert-success">
    ✅ <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>

<form method="post" action="<?= base_url('dosen/simpan-nilai') ?>">
  <?= csrf_field() ?>
  <input type="hidden" name="id_jadwal" value="<?= $jadwal['id'] ?>">

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Nilai Angka</th>
          <th>Nilai Huruf</th>
        </tr>
      </thead>

      <tbody>
        <?php $no=1; foreach($mahasiswa as $m): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $m['nim'] ?></td>
          <td><?= $m['nama'] ?></td>
          <td>
            <input type="number" 
                   class="form-control"
                   name="nilai_angka[<?= $m['id_rencana_studi'] ?>]"
                   min="0" max="100"
                   value="<?= $m['nilai_angka'] ?>">
          </td>
          <td>
            <strong>
            <?= $m['nilai_huruf'] ?: '-' ?>
            </strong>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <button class="btn btn-primary mt-3">Simpan Nilai</button>
</form>

<?= $this->endSection() ?>
