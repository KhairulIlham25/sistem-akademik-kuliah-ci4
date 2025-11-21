<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Hasil Studi</h3>

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>Mata Kuliah</th>
        <th>Dosen</th>
        <th>SKS</th>
        <th>Nilai Huruf</th>
        <th>Nilai Mutu</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach($hasil as $r): ?>
      <tr>
        <td><?= $r['nama_mata_kuliah'] ?></td>
        <td><?= $r['nama_dosen'] ?></td>
        <td><?= $r['sks'] ?></td>
        <td><?= $r['nilai_huruf'] ?? '-' ?></td>
        <td><?= $r['nilai_mutu'] ?? '-' ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<h5 class="mt-3"><strong>IPK: </strong><?= $ipk ?></h5>

<?= $this->endSection() ?>
