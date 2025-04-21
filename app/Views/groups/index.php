<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>


<div class="container-xxl flex-grow-1 container-p-y">
<a href="<?= site_url('groups/create') ?>">Tambah groups</a>

<h2 class="text-center mb-4">Grup Saya</h2>

    <?php if (!empty($groups)): ?>
        <div class="row">
            <?php foreach ($groups as $group): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= base_url('uploads/groups/' . $group['photo']); ?>" class="card-img-top" alt="group-photo" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $group['group_name']; ?></h5>
                            <p class="card-text"><?= (strlen($group['description']) > 50) ? substr($group['description'], 0, 50) . '...' : $group['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Dibuat oleh: <?= $group['username']; ?></small></p>
                            <a href="<?= base_url('groups/detail/' . $group['id_groups']); ?>" class="btn btn-primary">Lihat Detail</a>
                            <a href="<?= base_url('groups/edit/' . $group['id_groups']); ?>" class="btn btn-primary">Edit</a>
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
