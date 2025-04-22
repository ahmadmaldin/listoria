<?php

namespace App\Models;

use CodeIgniter\Model;

class FriendshipModel extends Model
{
    protected $table = 'friendships';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'id_friend', 'status'];

    // Menambahkan permintaan pertemanan
    public function addFriendRequest($userId, $friendId)
    {
        $data = [
            'id_user' => $userId,
            'id_friend' => $friendId,
            'status' => 'pending',
        ];

        return $this->insert($data);
    }

    // Mendapatkan daftar teman (yang sudah accepted), dengan informasi username dari tabel user
    public function getFriends($userId)
    {
        return $this->select('user.username, user.photo, friendships.*')
            ->join('user', 'user.id_user = IF(friendships.id_user = ' . $userId . ', friendships.id_friend, friendships.id_user)')
            ->where('friendships.status', 'accepted')
            ->groupStart()
                ->where('friendships.id_user', $userId)
                ->orWhere('friendships.id_friend', $userId)
            ->groupEnd()
            ->findAll();
    }

    // Mendapatkan daftar permintaan masuk yang pending (dikirim ke user login)
    public function getFriendRequests($userId)
    {
        return $this->select('user.username, user.photo, friendships.*')
            ->join('user', 'user.id_user = friendships.id_user')
            ->where('friendships.id_friend', $userId)
            ->where('friendships.status', 'pending')
            ->findAll();
    }

    // Mendapatkan daftar permintaan pertemanan yang dikirim user login dan masih pending
    public function getSentRequests($userId)
    {
        return $this->select('user.username, user.photo, friendships.*')
            ->join('user', 'user.id_user = friendships.id_friend')
            ->where('friendships.id_user', $userId)
            ->where('friendships.status', 'pending')
            ->findAll();
    }

    // Menerima permintaan pertemanan
    public function acceptFriendRequest($requestId)
    {
        return $this->update($requestId, ['status' => 'accepted']);
    }

    // Menolak permintaan pertemanan
    public function declineFriendRequest($requestId)
    {
        return $this->delete($requestId);
    }

    // Menghapus pertemanan berdasarkan ID pertemanan
    public function removeFriendById($friendshipId)
    {
        return $this->delete($friendshipId);
    }
}