<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="card mx-auto" style="max-width: 800px;">
  <div class="card-body text-center">
    <?php if (!empty($group['photo'])): ?>
      <img src="<?= base_url('uploads/groups/' . $group['photo']); ?>" class="card-img-top" alt="group-photo" style="height: 200px; object-fit: cover;">
      <?php endif; ?>

    <h4 class="card-title"><?= esc($group['group_name']) ?></h4>
    <p class="text-muted mb-2">Dibuat oleh:
      <strong>
        <?= esc($group['id_user']) == session()->get('id_user') ? 'Kamu' : esc($group['creator_username'] ?? 'Pengguna lain') ?>
      </strong>
    </p>
    <?php if (!empty($group['description'])): ?>
      <p class="mb-3"><?= esc($group['description']) ?></p>
    <?php endif; ?>

    <hr class="my-4">
    <h5 class="text-start">Anggota Grup:</h5>
<ul class="list-group text-start mb-4">
  <?php foreach ($members as $member): ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <div>
        <strong><?= esc($member['username']) ?></strong>
        <span class="badge bg-primary ms-2"><?= esc($member['member_level']) ?></span>
      </div>
      <div class="dropdown">
        <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <form action="<?= base_url('groups/deleteMember') ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus member ini?');">
            <input type="hidden" name="user_id" value="<?= $member['user_id'] ?>">
            <input type="hidden" name="id_groups" value="<?= $group['id_groups'] ?>">
            <button type="submit" class="dropdown-item text-danger">
              <i class="bx bx-trash me-1"></i> Hapus
            </button>
          </form>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>


    <?php if ($isOwner): ?>
      <form action="<?= site_url('groups/addMember') ?>" method="post" class="text-start">
        <?= csrf_field() ?>
        <input type="hidden" name="id_groups" value="<?= $group['id_groups'] ?>">

        <div class="mb-3">
          <label class="form-label">Tambah Anggota</label>
          <select name="user_id" class="form-select" required>
            <option value="">-- Pilih Pengguna --</option>
            <?php foreach ($users as $user): ?>
              <option value="<?= $user['id_user'] ?>"><?= esc($user['username']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Level</label>
          <select name="member_level" class="form-select">
            <option value="anggota">Anggota</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-success">
            <i class="bx bx-user-plus me-1"></i> Tambah
          </button>
        </div>
      </form>
    <?php endif; ?>

    <a href="<?= base_url('groups') ?>" class="btn btn-outline-secondary mt-4">
      <i class="bx bx-arrow-back me-1"></i> Kembali ke Daftar Grup
    </a>
  </div>
</div>

<?= $this->endSection(); ?>
