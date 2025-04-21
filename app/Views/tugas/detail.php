<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4 text-purple"><i class="bx bx-detail"></i> Detail Tugas</h4>

  <div class="card shadow-sm">
    <div class="card-body">
      <p><strong>Judul:</strong> <?= esc($tugas['tugas']) ?></p>
      <p><strong>Tanggal:</strong> <?= esc($tugas['tanggal']) ?></p>
      <p><strong>Waktu:</strong> <?= esc($tugas['waktu']) ?></p>
      <p><strong>Status:</strong> <span class="badge bg-label-primary"><?= esc($tugas['status']) ?></span></p>
      <hr class="my-4">
      <h5 class="text-purple"><i class="bx bx-upload"></i> Upload Lampiran</h5>

<form action="<?= base_url('tugas/upload') ?>" method="post" enctype="multipart/form-data" class="mb-4">
  <input type="hidden" name="tugas_id" value="<?= $tugas['id'] ?>">

  <div class="row g-2 align-items-end">
    <!-- Kolom Tipe -->
    <div class="col-md-3">
      <label for="type" class="form-label">Tipe</label>
      <select name="type" id="type" class="form-select" onchange="updateAttachmentInput()" required>
        <option value="">-- Pilih --</option>
        <option value="text">Teks</option>
        <option value="link">Link</option>
        <option value="file">File</option>
      </select>
    </div>

    <!-- Kolom Input Dinamis -->
    <div class="col-md-6">
      <label class="form-label">Isi</label>
      <div id="inputContainer">
        <input type="text" class="form-control" placeholder="Isi akan muncul setelah pilih tipe" disabled>
      </div>
    </div>

    <!-- Kolom Tombol -->
    <div class="col-md-3">
      <button type="submit" class="btn btn-purple w-100"><i class="bx bx-upload"></i> Upload</button>
    </div>
  </div>

  <!-- Kolom Deskripsi -->
  <div class="mt-3">
    <label for="description" class="form-label">Deskripsi</label>
    <input type="text" name="description" class="form-control" placeholder="Deskripsi lampiran (opsional)">
  </div>
</form>
<?php if (!empty($attachment)): ?>
  <h5 class="text-purple"><i class="bx bx-paperclip"></i> Lampiran</h5>
  <ul class="list-group mb-4">
    <?php foreach ($attachment as $file): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= esc($file['file_name']) ?>
        <a href="<?= base_url($file['path_file']) ?>" class="btn btn-sm btn-outline-purple" download><i class="bx bx-download"></i></a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>



      <hr class="my-4">

      <h5 class="text-purple"><i class="bx bx-share-alt"></i> Bagikan Tugas</h5>
      <form action="<?= base_url('tugas/storeShared/' . $tugas['id']) ?>" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="shared_to_user" class="form-label">Pilih User</label>
            <select name="shared_to_user" class="form-select">
              <option value="">-- Pilih User --</option>
              <?php foreach ($users as $user): ?>
                <option value="<?= $user['id_user'] ?>"><?= $user['username'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="shared_to_group" class="form-label">Pilih Grup</label>
            <select name="shared_to_group" class="form-select">
              <option value="">-- Pilih Grup --</option>
              <?php foreach ($groups as $group): ?>
                <option value="<?= $group['id_groups'] ?>"><?= $group['group_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-purple"><i class="bx bx-send"></i> Bagikan</button>
      </form>

      <div class="mt-4">
        <a href="<?= base_url('tugas') ?>" class="btn btn-outline-purple"><i class="bx bx-arrow-back"></i> Kembali</a>
        <a href="<?= base_url('tugas/edit/' . $tugas['id']) ?>" class="btn btn-warning"><i class="bx bx-edit-alt"></i> Edit</a>
      </div>
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

  .btn-outline-purple {
    border: 1px solid #ba68c8;
    color: #ba68c8;
  }

  .btn-outline-purple:hover {
    background-color: #ba68c8;
    color: white;
  }

  .text-purple {
    color: #7e57c2 !important;
  }
</style>

<script>
  function updateAttachmentInput() {
    const type = document.getElementById("type").value;
    const container = document.getElementById("inputContainer");

    let html = "";
    if (type === "text") {
      html = `<textarea name="content" class="form-control" placeholder="Tulis teks..." required></textarea>`;
    } else if (type === "link") {
      html = `<input type="url" name="content" class="form-control" placeholder="https://..." required>`;
    } else if (type === "file") {
      html = `<input type="file" name="file" class="form-control" required>`;
    } else {
      html = `<input type="text" class="form-control" placeholder="Isi akan muncul setelah pilih tipe" disabled>`;
    }

    container.innerHTML = html;
  }
</script>




<?= $this->endSection() ?>
