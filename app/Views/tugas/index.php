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
                        <th>Sisa Waktu</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tugas as $item): ?>
                        <tr>
                            <td><?= esc($item['id']) ?></td>
                            <td><?= esc($item['tugas']) ?></td>
                            <td><?= esc($item['tanggal']) ?> <?= esc($item['waktu']) ?></td>
                            <td>
                                <?php
                                    $deadline = strtotime($item['tanggal'] . ' ' . $item['waktu']);
                                    $now = time();
                                    $selisih = $deadline - $now;

                                    if ($selisih > 0) {
                                        $hari = floor($selisih / 86400);
                                        $jam = floor(($selisih % 86400) / 3600);
                                        $menit = floor(($selisih % 3600) / 60);

                                        echo '<span class="badge bg-info text-dark">⏳ ';
                                        if ($hari > 0) echo $hari . 'h ';
                                        if ($jam > 0) echo $jam . 'j ';
                                        if ($menit > 0) echo $menit . 'm ';
                                        echo 'lagi</span>';
                                    } else {
                                        $selisih = abs($selisih);
                                        $hari = floor($selisih / 86400);
                                        $jam = floor(($selisih % 86400) / 3600);
                                        $menit = floor(($selisih % 3600) / 60);

                                        echo '<span class="badge bg-danger">⚠️ Telat ';
                                        if ($hari > 0) echo $hari . 'h ';
                                        if ($jam > 0) echo $jam . 'j ';
                                        if ($menit > 0) echo $menit . 'm ';
                                        echo '</span>';
                                    }
                                ?>
                            </td>
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
