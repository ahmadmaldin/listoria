<?php
namespace App\Models;

use CodeIgniter\Model;

class SharedModel extends Model
{
    protected $table      = 'shared';
    protected $primaryKey = 'id_shared';
    protected $allowedFields = [
        'id_tugas', 'shared_type', 'shared_to', 'shared_by', 
        'accepted', 'share_date', 'accept_date'
    ];

    public function getSharedUserByTugas($id)
    {
        return $this->join('user', 'user.id_user = shared.shared_by')  // Menyertakan tabel users
                    ->where('shared.id_tugas', $id)  // Memfilter berdasarkan id_tugas
                    ->findAll();
    }
}
