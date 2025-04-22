<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold py-3 mb-4 text-purple">Daftar User</h4>
        <a href="<?= base_url('/user/create') ?>" class="btn btn-primary rounded-pill">
            <i class="bx bx-user-plus"></i> Tambah User
        </a>
    </div>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Form Cari -->
    <form action="<?= base_url('user') ?>" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari user..." value="<?= esc($_GET['keyword'] ?? '') ?>">
            <button class="btn btn-outline-primary" type="submit"><i class="bx bx-search"></i> Cari</button>
        </div>
    </form>

    <!-- Tabel User -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($user as $row): ?>
                        <tr>
                            <td><?= $row['id_user'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><span class="badge bg-info text-dark"><?= $row['level'] ?></span></td>
                            <td>
                                <img src="<?= base_url('uploads/user/' . $row['photo']) ?>" alt="Foto" class="rounded-circle" width="40" height="40">
                            </td>
                            <td>
                                <a href="<?= base_url('/user/edit/' . $row['id_user']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>
                                <a href="<?= base_url('/user/delete/' . $row['id_user']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">
                                    <i class="bx bx-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        <?= $pager->links(); ?>
    </div>
</div>

<?= $this->endSection(); ?>
