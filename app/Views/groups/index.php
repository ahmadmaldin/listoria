<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <a href="<?= site_url('groups/create') ?>" class="btn btn-primary mb-4">Tambah Grup</a>

    <h2 class="text-center mb-4">Grup Saya</h2>

    <?php if (!empty($groups)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($groups as $group): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="<?= base_url('uploads/groups/' . $group['photo']); ?>" class="card-img-top" alt="group-photo" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $group['group_name']; ?></h5>
                            <p class="card-text"><?= (strlen($group['description']) > 100) ? substr($group['description'], 0, 100) . '...' : $group['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Dibuat oleh: <?= $group['username']; ?></small></p>
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('groups/detail/' . $group['id_groups']); ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                                <a href="<?= base_url('groups/edit/' . $group['id_groups']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= base_url('groups/delete/' . $group['id_groups']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            Anda belum membuat grup.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
