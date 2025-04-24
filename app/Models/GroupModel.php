<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'groups'; // Tabel utama
    protected $primaryKey = 'id_groups';
    protected $allowedFields = [
        'group_name', 'id_user', 'created_date',
        'photo', 'password', 'description'
    ];

    // Menampilkan semua grup dengan username
    public function getAllGroups($keyword = null, $perPage = 10)
    {
        $builder = $this->table('groups');
        $builder->select('groups.*, user.username');
        $builder->join('user', 'user.id_user = groups.id_user'); // Pastikan konsisten dengan id_user

        if ($keyword) {
            $builder->groupStart()
                ->like('user.username', $keyword)
                ->orLike('groups.created_date', $keyword)
                ->groupEnd();
        }

        return $builder->paginate($perPage);
    }

    // Mendapatkan grup dengan username (untuk digunakan di index)
    public function getGroupsWithUsername()
    {
        return $this->db->table('groups')
            ->select('groups.*, user.username')
            ->join('user', 'user.id_user = groups.id_user') // Pastikan join sesuai dengan relasi yang benar
            ->get()
            ->getResultArray();
    }

    // Mendapatkan data anggota grup jika diperlukan
    public function getMembers($groupId)
    {
        return $this->db->table('member')
            ->select('member.*, user.username')
            ->join('user', 'user.id_user = member.user_id')
            ->where('member.id_groups', $groupId)
            ->get()
            ->getResultArray();
    }

    public function getGroupsForCurrentUser($userId)
    {
        return $this->db->table('groups')
            ->select('groups.*, user.username')
            ->join('user', 'user.id_user = groups.id_user')
            ->join('member', 'member.id_groups = groups.id_groups')
            ->where('member.user_id', $userId) // <<< Tambah nama tabel biar gak ambigu
            ->get()
            ->getResultArray();
    }
    
    public function isUserInGroup($userId, $groupId)
    {
        return $this->db->table('member')
                        ->where('user_id', $userId)
                        ->where('id_groups', $groupId)
                        ->countAllResults() > 0;
    }
    
    public function getmember($groupId)
{
    return $this->db->table('member')
                    ->join('user', 'user.id_user = member.user_id')
                    ->where('member.id_groups', $groupId)
                    ->get()
                    ->getResultArray();
}

public function isGroupCreator($userId, $groupId)
{
    // Mengecek apakah pengguna adalah pembuat grup
    return $this->db->table('groups')
                    ->where('id_user', $userId)  // ID user yang sedang login (pembuat grup)
                    ->where('id_groups', $groupId)  // ID grup yang dipilih
                    ->countAllResults() > 0;
}

public function isUserGroupMember($userId, $groupId)
{
    // Mengecek apakah pengguna adalah anggota grup
    return $this->db->table('member')
                    ->where('user_id', $userId)  // ID user yang sedang login
                    ->where('id_groups', $groupId) // ID grup yang dipilih
                    ->countAllResults() > 0;
}

public function getUserGroups($userId)
{
    return $this->db->table('member')
        ->join('groups', 'groups.id_groups = member.id_groups')
        ->where('member.user_id', $userId)
        ->get()
        ->getResultArray();
}


}
