<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 text-purple"><i class="bx bx-edit"></i> Edit Tugas</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= site_url('tugas/update/' . $tugas['id']); ?>" method="post">
                <!-- Tugas Field -->
                <div class="mb-3">
                    <label for="tugas" class="form-label">Tugas</label>
                    <input type="text" name="tugas" value="<?= esc($tugas['tugas']); ?>" id="tugas" class="form-control" required>
                </div>

                <!-- Tanggal Field -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" value="<?= esc($tugas['tanggal']); ?>" id="tanggal" class="form-control" required>
                </div>

                <!-- Waktu Field -->
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" name="waktu" value="<?= esc($tugas['waktu']); ?>" id="waktu" class="form-control" required>
                </div>

                <!-- Status Field -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="To do" <?= $tugas['status'] === 'To do' ? 'selected' : ''; ?>>To do</option>
                        <option value="Berjalan" <?= $tugas['status'] === 'Berjalan' ? 'selected' : ''; ?>>Berjalan</option>
                        <option value="Selesai" <?= $tugas['status'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                        <option value="Batal" <?= $tugas['status'] === 'Batal' ? 'selected' : ''; ?>>Batal</option>
                    </select>
                </div>

                <div class="button-group d-flex gap-3">
                    <button type="submit" class="btn btn-purple">Update Tugas</button>
                    <a href="<?= site_url('tugas'); ?>" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-purple {
        background-color: #ba68c8;
        color: white;
    }

    .btn-purple:hover {
        background-color: #ab47bc;
        color: white;
    }

    .btn-outline-secondary {
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .text-purple {
        color: #7e57c2 !important;
    }

    .container-xxl {
        padding: 20px;
    }
</style>

<?= $this->endSection(); ?>
