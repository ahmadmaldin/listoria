<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Tugas</h4>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('tugas/update/' . $tugas['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="tugas" class="form-label">Nama Tugas</label>
                    <input type="text" name="tugas" id="tugas" class="form-control" value="<?= esc($tugas['tugas']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Deadline</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= esc($tugas['tanggal']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu Deadline</label>
                    <input type="time" name="waktu" id="waktu" class="form-control" value="<?= esc($tugas['waktu']) ?>" required>
                </div>

                <!-- ALARM SISA WAKTU -->
                <div class="mb-3">
                    <label class="form-label">Sisa Waktu</label>
                    <div>
                        <?php
                            $deadline = strtotime($tugas['tanggal'] . ' ' . $tugas['waktu']);
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
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="to do" <?= $tugas['status'] == 'to do' ? 'selected' : '' ?>>To Do</option>
                        <option value="berjalan" <?= $tugas['status'] == 'berjalan' ? 'selected' : '' ?>>Berjalan</option>
                        <option value="selesai" <?= $tugas['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="batal" <?= $tugas['status'] == 'batal' ? 'selected' : '' ?>>Batal</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('tugas') ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
