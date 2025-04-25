<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><?= esc($title) ?></h4>

    <!-- Profil Pengguna -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Profil Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Foto Profil -->
                <div class="col-md-4 text-center">
                    <?php
                    // Jika tidak ada foto, tampilkan foto default
                    $photo = $user['photo'] ?? 'default.jpg'; // Foto profil, jika tidak ada, default.jpg
                    ?>
                    <img src="<?= base_url('uploads/user/' . $photo) ?>" alt="Profil" class="rounded-circle" width="150" height="150">
                </div>

                <!-- Detail Profil -->
                <div class="col-md-8">
                    <h5 class="mt-3"><?= esc($user['username']) ?></h5>  <!-- Nama Pengguna -->
                    <a href="<?= base_url('user/edit') ?>" class="btn btn-primary">Edit Profil</a> <!-- Tombol Edit Profil -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
