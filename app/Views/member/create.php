<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h2>Tambah Member</h2>

<form action="<?= site_url('member/store') ?>" method="post">
    <label>Group ID:</label>
    <input type="number" name="id_groups"><br>

    <label>User ID:</label>
    <input type="number" name="user_id"><br>

    <label>Level:</label>
    <select name="member_level">
        <option value="anggota">Anggota</option>
        <option value="admin">Admin</option>
    </select><br>

    <div class="form-buttons">
                <button type="submit">Simpan</button>
                <a href="<?= site_url('groups'); ?>" class="back-link">Kembali</a>
            </div>
</form>
