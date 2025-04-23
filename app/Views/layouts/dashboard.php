<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>

    <!-- Tugas Mendekati Deadline -->
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Tugas yang Mendekati Deadline</h5>
                    <a href="<?= base_url('tugas') ?>" class="text-muted small"><i class="bx bx-list-ul"></i> Lihat Semua</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($tugasMendekatiDeadline)): ?>
                        <div class="list-group">
                            <?php foreach ($tugasMendekatiDeadline as $tugas): ?>
                                <?php
                                    $now = new DateTime();
                                    $deadline = new DateTime($tugas['date_due'] . ' ' . $tugas['time_due']);
                                    if ($deadline > $now) {
                                        $interval = $now->diff($deadline);
                                        $jam = $interval->h + ($interval->d * 24);
                                        $menit = $interval->i;

                                        $badgeColor = $jam < 1 ? 'bg-danger' : ($jam < 3 ? 'bg-warning text-dark' : 'bg-info text-dark');

                                        $badge = "<span class='badge $badgeColor'>⏰ ";
                                        if ($jam > 0) $badge .= "$jam j ";
                                        if ($menit > 0) $badge .= "$menit m ";
                                        $badge .= "lagi</span>";
                                    } else {
                                        $interval = $deadline->diff($now);
                                        $jam = $interval->h + ($interval->d * 24);
                                        $menit = $interval->i;

                                        $badge = "<span class='badge bg-secondary'>⚠️ Telat ";
                                        if ($jam > 0) $badge .= "$jam j ";
                                        if ($menit > 0) $badge .= "$menit m ";
                                        $badge .= "</span>";
                                    }
                                ?>
                                <a href="<?= base_url('tugas/detail/' . $tugas['id']) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= esc($tugas['tugas']) ?></strong><br>
                                        <small class="text-muted">Deadline: <?= esc($tugas['date_due']) ?> <?= esc($tugas['time_due']) ?></small>
                                    </div>
                                    <?= $badge ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Tidak ada tugas yang mendekati deadline.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Statistik Tugas</h5>
                    <a href="<?= base_url('tugas') ?>" class="text-muted small"><i class="bx bx-bar-chart-alt-2"></i> Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <h6>To Do</h6>
                            <div class="progress">
                                <div class="progress-bar bg-primary" style="width: <?= $totalToDo ?>%"><?= $totalToDo ?>%</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <h6>Doing</h6>
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: <?= $totalDoing ?>%"><?= $totalDoing ?>%</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <h6>Selesai</h6>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: <?= $totalSelesai ?>%"><?= $totalSelesai ?>%</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <h6>Batal</h6>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: <?= $totalBatal ?>%"><?= $totalBatal ?>%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tugas Hari Ini -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Tugas Hari Ini</h5>
                    <a href="<?= base_url('tugas') ?>" class="text-muted small"><i class="bx bx-calendar-event"></i> Lihat Semua</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($tugasHariIni as $tugas): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= esc($tugas['tugas']) ?></strong><br>
                                    <small class="text-muted">Deadline: <?= esc($tugas['date_due']) ?> <?= esc($tugas['time_due']) ?></small>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($tugasHariIni)) echo '<li class="list-group-item text-muted">Tidak ada tugas hari ini.</li>'; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Grup yang Diikuti -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Grup yang Kamu Ikuti</h5>
                    <a href="<?= base_url('groups') ?>" class="text-muted small"><i class="bx bx-group"></i> Lihat Semua</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($groups as $group): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= esc($group['group_name']) ?>
                                <a href="<?= base_url('groups/detail/' . $group['id_groups']) ?>" class="badge bg-info text-white">Lihat</a>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($groups)) echo '<li class="list-group-item text-muted">Kamu belum ikut grup apapun.</li>'; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>
