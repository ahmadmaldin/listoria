<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">🌸 Daftar Tugas</h4>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tugas</th>
                        <th>Deadline</th>
                        <th>Sisa Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tugas as $i => $item): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="text-start"><?= esc($item['tugas']) ?></td>
                            <td><?= esc($item['tanggal']) ?> <br><small><?= esc($item['waktu']) ?></small></td>
                            <td>
                                <?php
                                    $now = new DateTime();
                                    $deadline = new DateTime($item['tanggal'] . ' ' . $item['waktu']);
                                    if ($deadline > $now) {
                                        $interval = $now->diff($deadline);
                                        $jam = $interval->h + ($interval->d * 24);
                                        $menit = $interval->i;

                                        if ($jam < 1) {
                                            $warna = 'bg-danger';
                                        } elseif ($jam < 3) {
                                            $warna = 'bg-warning text-dark';
                                        } else {
                                            $warna = 'bg-info text-dark';
                                        }

                                        echo "<span class='badge $warna'>⏳ ";
                                        if ($jam > 0) echo $jam . 'j ';
                                        if ($menit > 0) echo $menit . 'm ';
                                        echo "lagi</span>";
                                    } else {
                                        $interval = $deadline->diff($now);
                                        $jam = $interval->h + ($interval->d * 24);
                                        $menit = $interval->i;
                                        echo "<span class='badge bg-secondary'>⚠️ Telat ";
                                        if ($jam > 0) echo $jam . 'j ';
                                        if ($menit > 0) echo $menit . 'm ';
                                        echo "</span>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $status = $item['status'];
                                    $warna = match($status) {
                                        'to do' => 'bg-label-secondary',
                                        'berjalan' => 'bg-label-warning',
                                        'selesai' => 'bg-label-success',
                                        'batal' => 'bg-label-danger',
                                        default => 'bg-label-dark'
                                    };
                                ?>
                                <span class="badge <?= $warna ?>"><?= ucfirst($status) ?></span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= base_url('tugas/detail/' . $item['id']) ?>" class="btn btn-sm btn-icon btn-info" title="Detail">
                                        <i class="bx bx-detail"></i>
                                    <a href="<?= base_url('tugas/share/' . $item['id']) ?>" class="btn btn-sm btn-icon btn-info" title="Share">
                                        <i class="bx bx-share"></i>
                                    </a>
                                    <a href="<?= base_url('tugas/edit/' . $item['id']) ?>" class="btn btn-sm btn-icon btn-warning" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="<?= base_url('tugas/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')" style="display: inline;">
                                        <?= csrf_field() ?>
                                    
                                    
                                        <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
