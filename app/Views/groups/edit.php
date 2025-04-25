<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="card p-4 shadow-sm">
    <h2 class="text-center mb-4">Edit Grup</h2>

    <form action="<?= base_url('groups/update/' . $groups['id_groups']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Nama Grup -->
        <div class="mb-3">
            <label for="group_name" class="form-label">Nama Grup</label>
            <input type="text" name="group_name" id="group_name" class="form-control" value="<?= $groups['group_name'] ?>" required>
        </div>

        <!-- ID User (Hidden) -->
        <div class="mb-3">
            <input class="form-control" name="id_user" type="hidden" value="<?= $groups['id_user'] ?>" required readonly />
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label for="photo" class="form-label">Foto Grup</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4"><?= $groups['description'] ?></textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Grup</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>
