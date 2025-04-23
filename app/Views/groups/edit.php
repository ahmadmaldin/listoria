<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h2>Edit Grup</h2>
<form action="<?= base_url('groups/update/' . $groups['id_groups']) ?>" method="post" enctype="multipart/form-data">
<label>Nama Grup:</label><br>
    <input type="text" name="group_name" value="<?= $groups['group_name'] ?>" required><br><br>

    <div class="mb-3 row">
            <div class="col-md-10">
                <input class="form-control" name="id_user" type="hidden" value="<?= $groups['id_user'] ?>" id="html5-text-input" required readonly />
            </div>
        </div>


    <label>Foto:</label><br>
    <input type="file" name="photo"><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="description"><?= $groups['description'] ?></textarea><br><br>

    <button type="submit">Update</button>
</form>
<?= $this->endSection(); ?>
