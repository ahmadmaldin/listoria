<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Shared</title>
</head>
<body>
    <h1>Create Shared</h1>

    <form action="<?= site_url('shared/store') ?>" method="POST">
        <label for="id_tugas">ID Task</label>
        <input type="number" name="id_tugas" required><br>

        <label for="id_user">ID User</label>
        <input type="number" name="id_user" required><br>

        <label for="shared_by_user_id">Shared By User ID</label>
        <input type="number" name="shared_by_user_id" required><br>

        <label for="accepted">Accepted</label>
        <select name="accepted">
            <option value="pending">Pending</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select><br>

        <label for="share_date">Share Date</label>
        <input type="datetime-local" name="share_date" value="<?= date('Y-m-d\TH:i') ?>" required><br>

        <label for="accept_date">Accept Date</label>
        <input type="datetime-local" name="accept_date"><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
