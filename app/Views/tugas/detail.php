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

    <!-- Kolom 1: Tipe -->
    <div class="col-md-3">
      <label for="type" class="form-label">Tipe</label>
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
    <button type="submit" class="btn btn-primary">Simpan</button>
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
<h3>Daftar Attachment</h3>

<?php if (!empty($attachments)): ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th>Deskripsi</th>
                    <th>File/Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($attachments as $attach): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc(ucfirst($attach['type'])); ?></td>
                        <td><?= esc($attach['description']); ?></td>
                        <td>
                            <?php if ($attach['type'] === 'link' || $attach['type'] === 'maps'): ?>
                                <a href="<?= esc($attach['file']); ?>" target="_blank">Buka</a>
                            <?php else: ?>
                                <a href="<?= base_url('uploads/attachment/' . $attach['file']); ?>" target="_blank">Download</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="<?= site_url('attachment/delete/' . $attach['id_attachment']); ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this attachment?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Belum ada attachment untuk tugas ini.</p>
<?php endif; ?>
<h4></h4>
<hr></hr>
<h3>Bagikan Tugas</h3>

<?= $this->endSection() ?>
