<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Data</title>
</head>
<body>
    <h1>Shared Data</h1>
    
    <a href="<?= site_url('shared/create') ?>">Add New Shared</a>
    
    <table>
        <thead>
            <tr>
                <th>ID tugas</th>
                <th>ID User</th>
                <th>Shared By User ID</th>
                <th>Accepted</th>
                <th>Share Date</th>
                <th>Accept Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shared as $row): ?>
            <tr>
                <td><?= esc($row['id_tugas']) ?></td>
                <td><?= esc($row['id_user']) ?></td>
                <td><?= esc($row['shared_by_user_id']) ?></td>
                <td><?= esc($row['accepted']) ?></td>
                <td><?= esc($row['share_date']) ?></td>
                <td><?= esc($row['accept_date']) ?></td>
                <td>
                    <a href="<?= site_url('shared/edit/' . $row['id_shared']) ?>">Edit</a>
                    <a href="<?= site_url('shared/delete/' . $row['id_shared']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?= $this->endSection(); ?>
