<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h2>Daftar Member</h2>
<a href="<?= site_url('member/create') ?>">Tambah Member</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Group</th>
        <th>User</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($member as $row): ?>
        <tr>
            <td><?= $row['id_member'] ?></td>
            <td><?= $row['id_groups'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['member_level'] ?></td>
            <td>
                <a href="<?= site_url('member/edit/' . $row['id_member']) ?>">Edit</a> |
                <a href="<?= site_url('member/delete/' . $row['id_member']) ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<?= $this->endSection(); ?>
