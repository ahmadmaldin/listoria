<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SharedModel;
use App\Models\UserModel;
use App\Models\TugasModel;
use App\Models\GroupsModel;

class Shared extends BaseController
{
    protected $sharedModel;
    protected $tugasModel;

    public function __construct()
    {
        $this->sharedModel = new SharedModel();
        $this->tugasModel = new TugasModel();
    }

    // Tugas yang saya bagikan ke teman/grup
    public function sharedList()
    {
        $userId = session()->get('id_user');
        $sharedTasks = $this->sharedModel
            ->select('shared.*, tugas.tugas, user.username AS target_user, groups.group_name AS target_group')
            ->join('tugas', 'tugas.id = shared.id_tugas')
            ->join('user', 'user.id_user = shared.id_user', 'left')
            ->join('groups', 'groups.id_groups = shared.id_user', 'left') // karena id_user juga bisa grup
            ->where('shared.shared_by_user_id', $userId)
            ->orderBy('shared.share_date', 'DESC')
            ->findAll();

        return view('tugas/sharedlist', ['sharedTasks' => $sharedTasks]);
    }

    // Tugas yang dibagikan ke saya (teman/grup)
    public function sharedToMe()
    {
        $userId = session()->get('id_user');

        $sharedToMe = $this->sharedModel
            ->select('shared.*, tugas.tugas, user.username AS from_user')
            ->join('tugas', 'tugas.id = shared.id_tugas')
            ->join('user', 'user.id_user = shared.shared_by_user_id')
            ->where('shared.id_user', $userId)
            ->orderBy('shared.share_date', 'DESC')
            ->findAll();

        return view('tugas/sharedtome', ['sharedToMe' => $sharedToMe]);
    }

    // Konfirmasi penerimaan tugas (opsional)
    public function accept($id_shared)
    {
        $this->sharedModel->update($id_shared, [
            'accepted' => 1,
            'accept_date' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('message', 'Tugas diterima.');
    }

    // Tolak atau hapus sharing (opsional)
    public function reject($id_shared)
    {
        $this->sharedModel->delete($id_shared);
        return redirect()->back()->with('message', 'Tugas ditolak.');
    }
}
