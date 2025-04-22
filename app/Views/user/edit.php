<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 text-purple">Edit User</h4>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('/user/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select name="level" class="form-select">
                        <option value="admin" <?= $user['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= $user['level'] == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="photo" class="form-control">
                    <?php if ($user['photo']): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/user/' . $user['photo']) ?>" width="60" class="rounded shadow-sm" alt="Foto lama">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('user'); ?>" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
