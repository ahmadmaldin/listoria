<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tugas yang Dibagikan ke Saya</h4>
    </div>
    <div class="card-body">
        <?php if (!empty($shared_tugas)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tugas</th>
                            <th>Dibagikan Oleh</th>
                            <th>Tanggal Dibagikan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($shared_tugas as $index => $tugas): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($tugas['tugas']) ?></td>
                                <td><?= esc($users[$tugas['shared_by_user_id']] ?? 'Tidak diketahui') ?></td>
                                <td><?= date('d M Y, H:i', strtotime($tugas['share_date'])) ?></td>
                                <td>
                                    <a href="<?= site_url('tugas/detail/' . $tugas['id_tugas']) ?>" class="btn btn-sm btn-info">
                                        <i class="mdi mdi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Belum ada tugas yang dibagikan kepada Anda.
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>