<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Tugas</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('tugas/store'); ?>" method="post">
            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Tugas</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" name="tugas" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Tanggal</label>
                <div class="col-md-10">
                    <input class="form-control" type="date" name="tanggal" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Waktu</label>
                <div class="col-md-10">
                    <input class="form-control" type="time" name="waktu" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Status</label>
                <div class="col-md-10">
                    <select class="form-select" name="status" required>
                        <option value="To do">To do</option>
                        <option value="Berjalan">Berjalan</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Batal">Batal</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Alarm</label>
                <div class="col-md-10">
                    <select class="form-select" name="alarm" required>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Due Date</label>
                <div class="col-md-10">
                    <input class="form-control" type="date" name="date_due" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Time Due</label>
                <div class="col-md-10">
                    <input class="form-control" type="time" name="time_due">
                </div>
            </div>

            <input type="hidden" name="creator_id" value="<?= session()->get('id_user') ?>">


            <div class="mb-3 row">
                <div class="col-md-10 offset-md-2">
                    <a href="<?= site_url('tugas'); ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
