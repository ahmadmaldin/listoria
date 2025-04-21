<!-- app/Views/tugas/detail.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Tugas</h2>
<div class="card mb-4">
  <div class="card-body">
    <p><strong>tugas:</strong> <?= esc($tugas['tugas']) ?></p>
    <p><strong>Tanggal:</strong> <?= esc($tugas['tanggal']) ?></p>
    <p><strong>Waktu:</strong> <?= esc($tugas['waktu']) ?></p>
    <p><strong>Status:</strong> <?= esc($tugas['status']) ?></p>
  </div>
</div>

<!-- Form Upload Lampiran -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Upload Lampiran</h5>
    <form action="<?= base_url('tugas/upload/' . $tugas['id']) ?>"
          method="post"
          enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($tugas['id']) ?>">

        <div class="mb-3">
          <label for="file" class="form-label">Pilih berkas</label>
          <input type="file" name="file" id="file" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi (opsional)</label>
          <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>
</div>

<!-- Daftar Lampiran -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Daftar Lampiran</h5>
    <?php if (! empty($lampiran)): ?>
      <ul class="list-group">
        <?php foreach ($lampiran as $att): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= esc($att['description'] ?: $att['file']) ?>
            <a href="<?= base_url('uploads/' . $att['file']) ?>" 
               target="_blank" 
               class="badge bg-primary text-decoration-none">
               Download
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    <?php else: ?>
      <p class="text-muted">Belum ada lampiran.</p>
    <?php endif ?>
  </div>
</div>

<?= $this->endSection() ?>
