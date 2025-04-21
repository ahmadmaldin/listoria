<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'level', 'password', 'photo'];

    public function getUserByNama($username)
    {
        return $this->where('username', $username)->first();
    }

    public function search($keyword, $perPage)
    {
        return $this->like('username', $keyword)
            ->orLike('level', $keyword)
            ->paginate($perPage);
    }
}