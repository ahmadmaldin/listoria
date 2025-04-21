<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<a href="<?= base_url('/user/create') ?>">Tambah user</a>

<form action="<?= base_url('user') ?>" method="GET">
    <input type="text" name="keyword" placeholder="Cari user..." value="<?= esc($_GET['keyword'] ?? '') ?>">
    <button type="submit">Cari</button>
</form>
<!-- Notifikasi Flash -->
<?php if (session()->getFlashdata('success')): ?>
        <div class="flash-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Level</th>
        <th>Foto</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1 + (5 * ($pager->getCurrentPage() - 1)); ?>

    <?php foreach ($user as $row): ?>
        <tr>
            <td><?= $row['id_user'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['level'] ?></td>
            <td><img src="<?= base_url('uploads/user/' . $row['photo']) ?>" width="50"></td>
            <td>
                <a href="<?= base_url('/user/edit/' . $row['id_user']) ?>">Edit</a> |
                <a href="<?= base_url('/user/delete/' . $row['id_user']) ?>" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
    <?= $pager->links(); ?>
</div>
</body>
<?= $this->endSection(); ?>