<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SharedModel;
use App\Models\MemberModel;
use App\Models\TugasModel;
use App\Models\UserModel;
use App\Models\GroupsModel;

class shared extends BaseController
{
    protected $sharedModel;

    public function __construct()
    {
        $this->sharedModel = new SharedModel();
    }

    // Menyimpan data sharing tugas ke user
    public function store()
    {
        $id_tugas = $this->request->getPost('id_tugas');
        $shared_to = $this->request->getPost('shared_to');
        $shared_type = $this->request->getPost('shared_type');
        $shared_by = session()->get('id');

        // Cek apakah sudah pernah dibagikan sebelumnya
        $alreadyShared = $this->sharedModel
            ->where('id_tugas', $id_tugas)
            ->where('shared_to', $shared_to)
            ->where('shared_type', $shared_type)
            ->first();

        if ($alreadyShared) {
            return redirect()->back()->with('error', 'Tugas sudah pernah dibagikan ke tujuan yang sama.');
        }

        $this->sharedModel->save([
            'id_tugas'    => $id_tugas,
            'shared_to'   => $shared_to,
            'shared_type' => 'user',
            'shared_by'   => $shared_by,
            'shareddate' => date('Y-m-d H:i:s'),
            'accepted'   => "shared",
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dibagikan');
    }

    // Menyimpan data sharing tugas ke group
    public function shareToGroup($id_tugas)
    {
        $sharedModel = new SharedModel();
        $groupModel = new GroupsModel();
        $memberModel = new MemberModel();

        $groupId = $this->request->getPost('id_groups');
        $members = $memberModel->where('id_groups', $groupId)->findAll();

        $currentUserId = session()->get('id');

        foreach ($members as $member) {
            $targetUserId = $member['id_user'];

            // Skip jika user sama dengan yang sedang login
            if ($targetUserId == $currentUserId) {
                continue;
            }

            // Cek apakah sudah pernah dibagikan sebelumnya
            $alreadyShared = $sharedModel
                ->where('id_tugas', $id_tugas)
                ->where('shared_to', $targetUserId)
                ->where('shared_by', $currentUserId)
                ->first();

            // Jika belum pernah dibagikan, simpan
            if (!$alreadyShared) {
                $sharedModel->save([
                    'id_tugas'     => $id_tugas,
                    'shared_to'    => $targetUserId,
                    'shared_by'    => $currentUserId,
                    'shared_type'  => 'user',
                    'accepted'    => 'shared',
                    'shareddate'  => date('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect()->to('tugas/detail/' . $id_tugas)->with('success', 'Tugas berhasil dibagikan ke grup.');
    }

    // Menghapus sharing tugas dari halaman views/tugas/detail/share
    public function delete($id)
    {
        $model = new SharedModel();
        $shared = $model->find($id);

        if ($shared) {
            $id_tugas = $shared['id_tugas'];
            $model->delete($id);
            return redirect()->to('/tugas/detail/' . $id_tugas)->with('success', 'Sharing berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data sharing tidak ditemukan.');
    }

    // Update status shared tugas pada halaman views/tugas/shared_tome
    public function updateStatusNext($id)
    {
        $sharedModel = new SharedModel();
        $shared = $sharedModel->find($id);

        if (!$shared) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Daftar urutan status
        $statusList = ['shared', 'todo', 'ongoing', 'done', 'canceled'];

        // Tentukan status saat ini
        $currentStatus = $shared['accepted'] ?? 'shared';

        // Cari indeks status saat ini
        $currentIndex = array_search($currentStatus, $statusList);

        // Tentukan status berikutnya (loop kembali ke awal jika sudah terakhir)
        $nextIndex = ($currentIndex + 1) % count($statusList);
        $nextStatus = $statusList[$nextIndex];

        // Siapkan data untuk update
        $dataToUpdate = ['accepted' => $nextStatus];
        $dataToUpdate['acceptdate'] = date('Y-m-d H:i:s');

        // Update data
        $sharedModel->update($id, $dataToUpdate);

        return redirect()->back()->with('success', 'Status tugas diperbarui menjadi: ' . ucfirst($nextStatus));
    }
}
// if this line is still there, it means I just copy paste my friend's UKK application