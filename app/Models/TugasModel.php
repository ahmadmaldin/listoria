<?php
namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['creator_id', 'tugas', 'tanggal', 'waktu', 'status', 'alarm','date_due','time_due','date_finished','time_finished'];

    public function search1($keyword, $perPage, $creator_id)
    {
        return $this->where('creator_id', $creator_id)
            ->groupStart()
            ->like('tugas', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd()
            ->paginate($perPage);
    }

    public function search($keyword, $perPage)
    {
        return $this->like('tugas', $keyword)
            ->orLike('status', $keyword)
            ->paginate($perPage);
    }

    public function getTugasMendekatiDeadline($userId) {
        $builder = $this->db->table('tugas');
        return $builder->where('id_user', $userId)
                       ->where('date_due >=', date('Y-m-d'))
                       ->where('time_due >=', date('H:i:s'))
                       ->orderBy('date_due', 'ASC')
                       ->orderBy('time_due', 'ASC')
                       ->limit(5)
                       ->get()
                       ->getResult();
    }
    
}