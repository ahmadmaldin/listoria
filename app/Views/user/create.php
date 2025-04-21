
<body>
    <h2>Tambah User</h2>
    <form action="<?= base_url('/user/store') ?>" method="post" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="username" required>
        <br>
        <label>Level:</label>
        <select name="level">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <label>Foto:</label>
        <input type="file" name="photo">
        <br>
        <div class="form-buttons">
                <button type="submit">Simpan</button>
                <a href="<?= site_url('user'); ?>" class="back-link">Kembali</a>
            </div>    </form>
</body>
