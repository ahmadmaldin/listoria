<!-- app/Views/tugas/detail.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Tugas</h2>
<div class="card mb-4">
  <div class="card-body">
    <p><strong>tugas:</strong> <?= esc($tugas['tugas']) ?></p>
    <p><strong>Tanggal:</strong> <?= esc($tugas['tanggal']) ?></p>
    <p><strong>Waktu:</strong> <?= esc($tugas['waktu']) ?></p>
    <p><strong>Deadline:</strong> <?= esc($tugas['date_finished']) ?></p>
    <p><strong>Status:</strong> <?= esc($tugas['status']) ?></p>
  </div>
</div>

<h3 class="mb-4">Tambah Attachment</h3>

<?php if (session()->getFlashdata('errors')): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form action="<?= site_url('attachment/store'); ?>" method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <input type="hidden" name="id_tugas" value="<?= esc($tugas['id']); ?>">

  <div class="row align-items-end mb-3">

    <!-- Kolom 1: type -->
    <div class="col-md-3">
      <label for="type" class="form-label">type</label>
      <select name="type" id="type" class="form-control" onchange="showInputField()" required>
        <option value="file" <?= old('type') == 'file' ? 'selected' : '' ?>>File</option>
        <option value="photo" <?= old('type') == 'photo' ? 'selected' : '' ?>>Photo</option>
        <option value="link" <?= old('type') == 'link' ? 'selected' : '' ?>>Link</option>
        <option value="maps" <?= old('type') == 'maps' ? 'selected' : '' ?>>Maps</option>
        <option value="text" <?= old('type') == 'text' ? 'selected' : '' ?>>Text</option>
      </select>
    </div>

    <!-- Kolom 2: Input Dinamis -->
    <div class="col-md-5">
      <!-- Semua input ditumpuk, hanya satu yang ditampilkan -->
      <div id="file-input" style="display:none;">
        <input type="file" name="file" class="form-control">
      </div>
      <div id="photo-input" style="display:none;">
        <input type="file" name="photo" class="form-control" accept="image/*">
      </div>
      <div id="link-input" style="display:none;">
        <input type="url" name="link" class="form-control" placeholder="Masukkan URL">
      </div>
      <div id="maps-input" style="display:none;">
        <input type="text" name="maps-url" class="form-control"
               placeholder="https://www.google.com/maps/..."
               pattern="https://www\.google\.com/maps/.*"
               oninput="updateMapPreview()">
      </div>
      <div id="text-input" style="display:none;">
        <textarea name="text" class="form-control" placeholder="Masukkan teks di sini"><?= old('text') ?></textarea>
      </div>
    </div>

    <!-- Kolom 3: Deskripsi -->
    <div class="col-md-4">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea name="description" class="form-control"><?= old('description') ?></textarea>
    </div>
  </div>

  <!-- Tombol -->
  <div class="text-end">
    <button type="submit" class="btn btn-primary">Upload</button>
  </div>
</form>


<script>
  function showInputField() {
    var type = document.getElementById("type").value;

    document.getElementById("file-input").style.display = 'none';
    document.getElementById("photo-input").style.display = 'none';
    document.getElementById("link-input").style.display = 'none';
    document.getElementById("maps-input").style.display = 'none';
    document.getElementById("text-input").style.display = 'none';

    if (type === 'file') {
      document.getElementById("file-input").style.display = 'block';
      document.getElementById("submit-btn").innerText = "Unggah File";
    } else if (type === 'photo') {
      document.getElementById("photo-input").style.display = 'block';
      document.getElementById("submit-btn").innerText = "Unggah Foto";
    } else if (type === 'link') {
      document.getElementById("link-input").style.display = 'block';
      document.getElementById("submit-btn").innerText = "Masukkan Link";
    } else if (type === 'maps') {
      document.getElementById("maps-input").style.display = 'block';
      document.getElementById("submit-btn").innerText = "Masukkan URL Peta";
    } else if (type === 'text') {
      document.getElementById("text-input").style.display = 'block';
      document.getElementById("submit-btn").innerText = "Simpan Teks";
    }
  }

  function updateMapPreview() {
    var mapsUrl = document.getElementById("maps-url").value;
    var mapPreview = document.getElementById("map-preview");
    var iframe = document.getElementById("google-map");

    if (mapsUrl && mapsUrl.startsWith("https://www.google.com/maps/")) {
      mapPreview.style.display = "block";
      iframe.src = mapsUrl;
    } else {
      mapPreview.style.display = "none";
    }
  }

  window.onload = showInputField;
</script>


<hr></hr>
<h3 class="mt-4">Daftar Attachment</h3>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Tipe</th>
        <th>File</th>
        <th>Deskripsi</th>
        <?php if ($tugas['creator_id'] == session()->get('id')): ?>
          <th>Aksi</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($attachment as $b): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= ucfirst($b['type']) ?></td>
          <td>
            <?php if (!empty($b['file'])): ?>
              <a href="<?= base_url('uploads/attachment/' . $b['file']) ?>" target="_blank">
                <?= esc($b['file']) ?>
              </a>
            <?php else: ?>
              Tidak ada file
            <?php endif; ?>
          </td>
          <td>
            <?php if ($b['type'] === 'maps'): ?>
              <a href="https://www.google.com/maps?q=<?= urlencode($b['description']) ?>" target="_blank">
                <?= esc($b['description']) ?>
              </a>
            <?php elseif ($b['type'] === 'link'): ?>
              <a href="<?= esc($b['description']) ?>" target="_blank">
                <?= esc($b['description']) ?>
              </a>
            <?php else: ?>
              <?= esc($b['description']) ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
