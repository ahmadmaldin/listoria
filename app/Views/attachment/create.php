<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h1>Tambah Attachment</h1>

<!-- Menampilkan pesan error jika ada kesalahan dalam input -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('/tugas/detail') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <!-- ID Tugas -->
    <label for="id_tugas">ID Tugas</label>
    <input type="text" name="id_tugas" id="id_tugas" value="<?= old('id_tugas') ?>" required><br><br>

    <!-- Type -->
    <label for="type">Type</label>
    <select name="type" id="type" required>
        <option value="file" <?= old('type') == 'file' ? 'selected' : '' ?>>File</option>
        <option value="photo" <?= old('type') == 'photo' ? 'selected' : '' ?>>Photo</option>
        <option value="link" <?= old('type') == 'link' ? 'selected' : '' ?>>Link</option>
        <option value="maps" <?= old('type') == 'maps' ? 'selected' : '' ?>>Maps</option>
    </select><br><br>

    <!-- File -->
    <label>File</label>
    <input type="file" name="photo"><br><br>

    <!-- Description -->
    <label for="description">Description</label>
    <textarea name="description" id="description"><?= old('description') ?></textarea><br><br>

    <div class="form-buttons">
                <button type="submit">Simpan</button>
                <a href="<?= site_url('attachment'); ?>" class="back-link">Kembali</a>
            </div>
</form>

