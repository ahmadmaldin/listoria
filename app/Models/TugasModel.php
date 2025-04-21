<?php
namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['creator_id', 'tugas', 'tanggal', 'waktu', 'status', 'foto'];

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
}