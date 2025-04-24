<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<h1>Daftar Tugas yang Dibagikan</h1>

<?php if (!empty($shared_tugas)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tugas</th>
                <th>Ke Pengguna</th>
                <th>Status</th>
                <th>Tanggal Dibagikan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shared_tugas as $tugas): ?>
                <tr>
                    <td><?= $tugas['id_tugas'] ?></td>
                    <td><?= $tugas['tugas'] ?></td>
                    <td><?= $tugas['username'] ?></td>
                    <td><?= $tugas['accepted'] ? 'Diterima' : 'Belum Diterima' ?></td>
                    <td><?= $tugas['share_date'] ?></td>
                    <td>
                        <a href="/tugas/detail/<?= $tugas['id_tugas'] ?>" class="btn btn-info">Lihat Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Belum ada tugas yang dibagikan.</p>
<?php endif; ?>
<?= $this->endSection(); ?>