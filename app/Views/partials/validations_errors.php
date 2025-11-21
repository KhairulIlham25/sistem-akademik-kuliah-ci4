<!-- app/Views/partials/validation_errors.php -->
<?php if (isset($validation)): ?>
  <div class="alert alert-danger">
    <?= $validation->listErrors() ?>
  </div>
<?php endif; ?>

