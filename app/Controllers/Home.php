<?php 

namespace App\Controllers;

use App\Models\TugasModel;
use App\Models\GroupModel;
use App\Models\MemberModel;

class Home extends BaseController
{
    protected $tugasModel;
    protected $groupModel;
    protected $memberModel;

    public function __construct()
    {
        $this->tugasModel = new TugasModel();
        $this->groupModel = new GroupModel();
        $this->memberModel = new MemberModel();
    }

    public function index()
    {
        $userId = session()->get('id_user');

        // Statistik jumlah tugas
        $data['totalToDo'] = $this->tugasModel->where('creator_id', $userId)->where('status', 'to do')->countAllResults();
        $data['totalDoing'] = $this->tugasModel->where('creator_id', $userId)->where('status', 'doing')->countAllResults();
        $data['totalSelesai'] = $this->tugasModel->where('creator_id', $userId)->where('status', 'selesai')->countAllResults();
        $data['totalBatal'] = $this->tugasModel->where('creator_id', $userId)->where('status', 'batal')->countAllResults();

        // Tugas mendekati deadline (misal < 24 jam)
        $now = date('Y-m-d H:i:s');
        $besok = date('Y-m-d H:i:s', strtotime('+1 day'));

        $data['tugasMendekatiDeadline'] = $this->tugasModel
            ->where('creator_id', $userId)
            ->where('status !=', 'selesai')
            ->where("CONCAT(date_due, ' ', time_due) BETWEEN '$now' AND '$besok'")
            ->findAll();

        // Tugas hari ini
        $today = date('Y-m-d');
        $data['tugasHariIni'] = $this->tugasModel
            ->where('creator_id', $userId)
            ->where('date_due', $today)
            ->findAll();

        // Grup yang user ikuti
        $data['groups'] = $this->memberModel
            ->join('groups', 'groups.id_groups = member.id_groups')
            ->where('member.user_id', $userId)
            ->select('groups.*')
            ->findAll();

        return view('layouts/dashboard', $data);
    }
}
