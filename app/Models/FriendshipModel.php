<?php

namespace App\Models;

use CodeIgniter\Model;

class FriendshipModel extends Model
{
    protected $table = 'friendship';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'id_friend', 'status'];

    /**
     * Tambah permintaan pertemanan
     */
    public function addFriendRequest($userId, $friendId)
    {
        return $this->insert([
            'id_user' => $userId,
            'id_friend' => $friendId,
            'status' => 'pending',
        ]);
    }

    /**
     * Ambil semua teman dari user yang statusnya sudah accepted
     */
    public function getFriends($userId)
    {
        return $this->db->table($this->table)
            ->select('user.id_user, user.username, user.photo, friendship.id, friendship.id_user, friendship.id_friend')
            ->join('user', "user.id_user = IF(friendship.id_user = $userId, friendship.id_friend, friendship.id_user)")
            ->where('friendship.status', 'accepted')
            ->groupStart()
                ->where('friendship.id_user', $userId)
                ->orWhere('friendship.id_friend', $userId)
            ->groupEnd()
            ->get()->getResultArray();
    }

    /**
     * Ambil daftar permintaan masuk (pending) ke user yang sedang login
     */
    public function getFriendRequests($userId)
    {
        return $this->select('user.id_user, user.username, user.photo, friendship.id')
            ->join('user', 'user.id_user = friendship.id_user')
            ->where('friendship.id_friend', $userId)
            ->where('friendship.status', 'pending')
            ->findAll();
    }

    /**
     * Ambil daftar permintaan pertemanan yang dikirim user dan masih pending
     */
    public function getSentRequests($userId)
    {
        return $this->select('user.id_user, user.username, user.photo, friendship.id')
            ->join('user', 'user.id_user = friendship.id_friend')
            ->where('friendship.id_user', $userId)
            ->where('friendship.status', 'pending')
            ->findAll();
    }

    /**
     * Menerima permintaan pertemanan
     */
    public function acceptFriendRequest($friendshipId)
    {
        return $this->update($friendshipId, ['status' => 'accepted']);
    }

    /**
     * Menolak permintaan pertemanan
     */
    public function declineFriendRequest($friendshipId)
    {
        return $this->delete($friendshipId);
    }

    /**
     * Hapus pertemanan berdasarkan ID friendship
     */
    public function removeFriendById($friendshipId)
    {
        return $this->delete($friendshipId);
    }
}