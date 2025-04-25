<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h3>Bagikan Tugas ke Teman </h3>

<form action="<?= site_url('tugas/processShare/' . $task['id']); ?>" method="post" class="text-start">
    <?= csrf_field(); ?>

    <!-- Pilih Teman -->
    <div class="mb-3">
        <label class="form-label">Pilih Teman</label>
        <select name="friends[]" class="form-select" required>
            <option value="">-- Pilih Teman --</option>
            <?php foreach ($friends as $friend): ?>
                <option value="<?= $friend['id_user']; ?>"><?= esc($friend['username']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            Bagikan
        </button>
    </div>
</form>

<!-- Aktifkan Select2 -->
<script>
    $(document).ready(function() {
        $('.form-select').select2({
            placeholder: "Pilih...",
            width: '100%'
        });
    });
</script>

<?= $this->endSection(); ?>
