<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<body>
    <h2>Edit User</h2>
    <form action="<?= base_url('/user/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="username" value="<?= $user['username'] ?>" required>
        <br>
        <label>Level:</label>
        <select name="level">
            <option value="admin" <?= $user['level'] == 'admin' ? 'selected' : '' ?>>admin</option>
            <option value="user" <?= $user['level'] == 'user' ? 'selected' : '' ?>>user</option>
        </select>
        <br>
        <label>Password (kosongkan jika tidak ingin mengubah):</label>
        <input type="password" name="password">
        <br>
        <label>Foto:</label>
        <input type="file" name="photo">
        <br>
        <button type="submit">Update</button>
        <a href="<?= site_url('user'); ?>" class="back-link">Kembali</a>

    </form>
</body>
<?= $this->endSection(); ?>