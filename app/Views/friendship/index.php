<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h2 class="mb-0"><?= esc($title) ?></h2>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('info')) : ?>
            <div class="alert alert-info"><?= session()->getFlashdata('info') ?></div>
        <?php endif; ?>

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <!-- Teman Anda -->
                <div class="mb-4">
                    <h4>Teman Anda</h4>
                    <ul class="list-group">
                        <?php if (!empty($friends)) : ?>
                            <?php foreach ($friends as $friend) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('uploads/friendship/' . $friend['photo']) ?>" width="30" alt="photo" class="rounded-circle me-2">
                                        <span><?= esc($friend['username']) ?></span>
                                    </div>
                                    <form action="<?= base_url('friendship/remove/' . $friend['id']) ?>" method="post" onsubmit="return confirm('Hapus pertemanan ini?')">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="list-group-item">Belum ada teman.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Permintaan Masuk -->
                <div class="mb-4">
                    <h4>Permintaan Masuk</h4>
                    <ul class="list-group">
                        <?php if (!empty($friendRequests)) : ?>
                            <?php foreach ($friendRequests as $req) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('uploads/friendship/' . $req['photo']) ?>" width="30" alt="photo" class="rounded-circle me-2">
                                        <span><?= esc($req['username']) ?></span>
                                    </div>
                                    <div>
                                        <a href="<?= base_url('friendship/accept/' . $req['id']) ?>" class="btn btn-success btn-sm">Terima</a>
                                        <a href="<?= base_url('friendship/decline/' . $req['id']) ?>" class="btn btn-danger btn-sm">Tolak</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="list-group-item">Tidak ada permintaan masuk.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Permintaan Terkirim -->
                <div class="mb-4">
                    <h4>Permintaan Terkirim</h4>
                    <ul class="list-group">
                        <?php if (!empty($sentRequests)) : ?>
                            <?php foreach ($sentRequests as $sent) : ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="<?= base_url('uploads/friendship/' . $sent['photo']) ?>" width="30" alt="photo" class="rounded-circle me-2">
                                    <span><?= esc($sent['username']) ?> (Menunggu)</span>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="list-group-item">Tidak ada permintaan terkirim.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <h4>Tambah Teman</h4>
                <form action="<?= base_url('friendship/add') ?>" method="post" class="p-3 border rounded bg-light">
                    <div class="mb-3">
                        <label for="friend_id" class="form-label">ID Teman:</label>
                        <input type="number" name="friend_id" id="friend_id" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>