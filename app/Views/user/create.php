<?= $this->extend('layouts/blank'); ?> <!-- Gunakan layout kosong Sneat -->
<?= $this->section('content'); ?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
  <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
    <h3 class="text-center mb-4 text-purple">Buat Akun</h3>

    <form action="<?= base_url('/user/store') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field(); ?>

      <!-- Nama -->
      <div class="mb-3">
        <label for="username" class="form-label">Nama</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <!-- Foto -->
      <div class="mb-3">
        <label for="photo" class="form-label">Foto</label>
        <input type="file" name="photo" id="photo" class="form-control">
      </div>

      <!-- Tombol -->
      <div class="d-flex justify-content-between">
        <a href="<?= site_url('user'); ?>" class="btn btn-outline-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<style>
  .text-purple {
    color: #a66bbe;
  }
</style>

<?= $this->endSection(); ?>
