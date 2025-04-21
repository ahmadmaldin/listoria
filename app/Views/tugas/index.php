<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Daftar Tugas</h4>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tugas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tugas as $item): ?>
                        <tr>
                            <td><?= esc($item['id']) ?></td>
                            <td><?= esc($item['tugas']) ?></td>
                            <td><?= esc($item['tanggal']) ?></td>
                            <td>
                                <span class="badge bg-label-primary"><?= esc($item['status']) ?></span>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('tugas/detail/' . $item['id']) ?>" class="btn btn-sm btn-icon btn-info"><i class="bx bx-detail"></i></a>
                                <a href="<?= base_url('tugas/edit/' . $item['id']) ?>" class="btn btn-sm btn-icon btn-warning"><i class="bx bx-edit"></i></a>
                                <a href="<?= base_url('tugas/delete/' . $item['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                                    <i class="bx bx-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
