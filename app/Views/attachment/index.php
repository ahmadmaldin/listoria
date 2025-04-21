<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h1>Daftar Attachment</h1>

<a href="<?= base_url('attachment/create') ?>">Tambah Attachment</a>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID Tugas</th>
        <th>Type</th>
        <th>File</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($attachments as $attachment): ?>
    <tr>
        <td><?= esc($attachment['id_tugas']) ?></td>
        <td><?= esc($attachment['type']) ?></td>
        <td><?= esc($attachment['file']) ?></td>
        <td><?= esc($attachment['description']) ?></td>
        <td>
            <a href="<?= base_url('attachment/edit/' . $attachment['id_attachment']) ?>">Edit</a> |
            <a href="<?= base_url('attachment/delete/' . $attachment['id_attachment']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection(); ?>
