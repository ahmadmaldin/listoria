<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Buat Grup Baru</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('groups/store') ?>" method="post" enctype="multipart/form-data">
            
            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Nama Grup</label>
                <div class="col-md-10">
                    <input type="text" name="group_name" class="form-control" required>
                </div>
            </div>

            <input type="hidden" name="id_user" value="<?= session()->get('id') ?>">

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Foto</label>
                <div class="col-md-10">
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Deskripsi</label>
                <div class="col-md-10">
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-10 offset-md-2">
                    <a href="<?= site_url('groups'); ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection(); ?>
