<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Daftar Tugas</h4>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
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
        $now = new DateTime();
        $deadline = new DateTime($item['tanggal'] . ' ' . $item['waktu']);
        if ($deadline > $now) {
            $interval = $now->diff($deadline);
            $jam = $interval->h + ($interval->d * 24);
            $menit = $interval->i;

            // Tambah badge berdasarkan waktu yang tersisa
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
