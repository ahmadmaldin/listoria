<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h2>Edit Member</h2>

<form action="<?= site_url('member/update/' . $member['id_member']) ?>" method="post">
    <label>Group ID:</label>
    <input type="number" name="id_groups" value="<?= $member['id_groups'] ?>"><br>

    <label>User ID:</label>
    <input type="number" name="user_id" value="<?= $member['user_id'] ?>"><br>

    <label>Level:</label>
    <select name="member_level">
        <option value="anggota" <?= $member['member_level'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
        <option value="admin" <?= $member['member_level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br>

    <button type="submit">Update</button>
    <a href="<?= site_url('member'); ?>" class="back-link">Kembali</a>

</form>
