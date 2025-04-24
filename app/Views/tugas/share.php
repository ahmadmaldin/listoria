<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h3>Bagikan Tugas ke Teman dan Grup</h3>

<form action="<?= site_url('tugas/processShare/' . $task['id']); ?>" method="post">
    <?= csrf_field(); ?>

    <!-- Pilih Teman -->
    <label for="friends">Pilih Teman:</label>
    <select multiple name="friends[]" id="friends" class="form-control">
        <?php foreach ($friends as $friend): ?>
            <option value="<?= $friend['id_user']; ?>"><?= $friend['username']; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Pilih Grup -->
    <label for="groups">Pilih Grup:</label>
    <select multiple name="groups[]" id="groups" class="form-control">
        <?php foreach ($groups as $group): ?>
            <option value="<?= $group['id_groups']; ?>"><?= $group['group_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-primary mt-3">Bagikan</button>
</form>

<?= $this->endSection(); ?>