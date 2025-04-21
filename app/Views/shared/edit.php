<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shared</title>
</head>
<body>
    <h1>Edit Shared</h1>

    <form action="<?= site_url('shared/update/' . $shared['id_shared']) ?>" method="POST">
        <label for="id_tugas">ID Task</label>
        <input type="number" name="id_tugas" value="<?= esc($shared['id_tugas']) ?>" required><br>

        <label for="id_user">ID User</label>
        <input type="number" name="id_user" value="<?= esc($shared['id_user']) ?>" required><br>

        <label for="shared_by_user_id">Shared By User ID</label>
        <input type="number" name="shared_by_user_id" value="<?= esc($shared['shared_by_user_id']) ?>" required><br>

        <label for="accepted">Accepted</label>
        <select name="accepted">
            <option value="pending" <?= $shared['accepted'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="yes" <?= $shared['accepted'] == 'yes' ? 'selected' : '' ?>>Yes</option>
            <option value="no" <?= $shared['accepted'] == 'no' ? 'selected' : '' ?>>No</option>
        </select><br>

        <label for="share_date">Share Date</label>
        <input type="datetime-local" name="share_date" value="<?= esc($shared['share_date']) ?>" required><br>

        <label for="accept_date">Accept Date</label>
        <input type="datetime-local" name="accept_date" value="<?= esc($shared['accept_date']) ?>"><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
