<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>

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

    <!-- Quotes -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <p class="text-muted">"Tugas yang diselesaikan hari ini, adalah langkah menuju kesuksesan."</p>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>
