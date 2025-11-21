<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4 fw-semibold">Rencana Studi</h3>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?= session()->getFlashdata('success') ?>
  <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form method="post" action="<?= base_url('mahasiswa/rencana-studi/simpan') ?>">
  <?= csrf_field() ?>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-primary">
        <tr>
          <th style="width: 70px;">Pilih</th>
          <th>Mata Kuliah</th>
          <th>Dosen</th>
          <th>Hari</th>
          <th>Jam</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($jadwal as $j): ?>
        <tr>
          <td class="text-center">
            <input type="checkbox" class="form-check-input"
                name="jadwal_id[]" value="<?= $j['id'] ?>"
                <?= in_array($j['id'], $dipilih) ? 'checked' : '' ?>>
          </td>

          <td><?= $j['nama_mata_kuliah'] ?> (<?= $j['sks'] ?> SKS)</td>
          <td><?= $j['nama_dosen'] ?></td>
          <td><?= $j['hari'] ?></td>
          <td><?= date('H:i', strtotime($j['jam_mulai'])) ?> - <?= date('H:i', strtotime($j['jam_selesai'])) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <button class="btn btn-primary mt-3 px-4">Simpan Rencana Studi</button>
</form>

<?= $this->endSection() ?>
