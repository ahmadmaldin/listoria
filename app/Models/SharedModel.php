<?php namespace App\Models;

use CodeIgniter\Model;

class SharedModel extends Model
{
    protected $table      = 'shared';
    protected $primaryKey = 'id_shared';

    protected $allowedFields = [
        'id_tugas', 'shared_to_id_user','shared_to_group_id','shared_by_user_id', 'accepted', 'share_date', 'accept_date'
    ];

    // Fungsi untuk mendapatkan tugas yang dibagikan ke pengguna
    public function getSharedToMe($id_user)
    {
        return $this->select('shared.*, tugas.tugas')
                    ->join('tugas', 'tugas.id = shared.id_tugas')
                    ->where('shared.shared_to_user_id', $shared_to_user_id)
                    ->findAll();
    }
    
}
