<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= esc($title) ?></h2>

<?php if (session()->getFlashdata('success')) : ?>
    <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>
<?php if (session()->getFlashdata('info')) : ?>
    <p style="color: blue;"><?= session()->getFlashdata('info') ?></p>
<?php endif; ?>

<!-- Teman Anda -->
<h3>Teman Anda</h3>
<ul>
    <?php if (!empty($friends)) : ?>
        <?php foreach ($friends as $friend) : ?>
            <li>
                <img src="<?= base_url('assets/images/' . $friend['photo']) ?>" width="30" alt="photo">
                <?= esc($friend['username']) ?>
                <form action="<?= base_url('friendship/remove/' . $friend['id']) ?>" method="post" style="display: inline;" onsubmit="return confirm('Hapus pertemanan ini?')">
                    <button type="submit">Hapus</button>
                </form>
            </li>
        <?php endforeach; ?>
    <?php else : ?>
        <li>Belum ada teman.</li>
    <?php endif; ?>
</ul>

<!-- Permintaan Masuk -->
<h3>Permintaan Masuk</h3>
<ul>
    <?php if (!empty($friendRequests)) : ?>
        <?php foreach ($friendRequests as $req) : ?>
            <li>
                <img src="<?= base_url('assets/images/' . $req['photo']) ?>" width="30" alt="photo">
                <?= esc($req['username']) ?>
                <a href="<?= base_url('friendship/accept/' . $req['id']) ?>">Terima</a>
                <a href="<?= base_url('friendship/decline/' . $req['id']) ?>">Tolak</a>
            </li>
        <?php endforeach; ?>
    <?php else : ?>
        <li>Tidak ada permintaan masuk.</li>
    <?php endif; ?>
</ul>

<!-- Permintaan Terkirim -->
<h3>Permintaan Terkirim</h3>
<ul>
    <?php if (!empty($sentRequests)) : ?>
        <?php foreach ($sentRequests as $sent) : ?>
            <li>
                <img src="<?= base_url('assets/images/' . $sent['photo']) ?>" width="30" alt="photo">
                <?= esc($sent['username']) ?> (Menunggu)
            </li>
        <?php endforeach; ?>
    <?php else : ?>
        <li>Tidak ada permintaan terkirim.</li>
    <?php endif; ?>
</ul>

<!-- Form Tambah Teman -->
<h4>Tambah Teman</h4>
<form action="<?= base_url('friendship/add') ?>" method="post">
    <label for="friend_id">ID Teman:</label>
    <input type="number" name="friend_id" id="friend_id" required>
    <button type="submit">Tambah</button>
</form>

<?= $this->endSection() ?>