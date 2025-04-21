<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h1>Edit Attachment</h1>

<form action="<?= base_url('/attachment/update/' . $attachment['id_attachment']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <label>ID Tugas</label>
    <input type="text" name="id_tugas" value="<?= $attachment['id_tugas'] ?>" required><br><br>

    <label>Type</label>
    <select name="type" required>
        <option value="file" <?= $attachment['type'] == 'file' ? 'selected' : '' ?>>File</option>
        <option value="photo" <?= $attachment['type'] == 'photo' ? 'selected' : '' ?>>Photo</option>
        <option value="link" <?= $attachment['type'] == 'link' ? 'selected' : '' ?>>Link</option>
        <option value="maps" <?= $attachment['type'] == 'maps' ? 'selected' : '' ?>>Maps</option>
    </select><br><br>

    <label>File</label><br>
    <input type="file" name="photo"><br><br>

    <label>Description</label>
    <textarea name="description"><?= $attachment['description'] ?></textarea><br><br>

    <button type="submit">Update</button>
    <a href="<?= site_url('attachment'); ?>" class="back-link">Kembali</a>

</form>

<a href="/attachment">Kembali ke Daftar Attachment</a>
