<?php 

namespace App\Models;

use CodeIgniter\Model;

class FriendshipModel extends Model
{
    protected $table = 'friendships';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'friend_id', 'status'];

    // Menambahkan permintaan pertemanan
    public function addFriendRequest($userId, $friendId)
    {
        $data = [
            'user_id' => $userId,
            'friend_id' => $friendId,
            'status' => 'pending',
        ];

        return $this->insert($data);
    }

    // Mendapatkan daftar teman (yang sudah accepted), dengan informasi username dan photo dari tabel user
    public function getFriends($userId)
    {
        return $this->select('u.username, u.photo, friendships.*')
            ->join('user u', 'u.id_user = friendships.friend_id', 'left') // Ganti id menjadi id_user
            ->where('friendships.user_id', $userId)
            ->where('friendships.status', 'accepted')
            ->orGroupStart()
                ->join('user u2', 'u2.id_user = friendships.user_id', 'left') // Ganti id menjadi id_user
                ->where('friendships.friend_id', $userId)
                ->where('friendships.status', 'accepted')
            ->groupEnd()
            ->findAll();
    }

    // Mendapatkan daftar permintaan masuk yang pending (dikirim ke user login)
    public function getFriendRequests($userId)
    {
        return $this->select('user.username, user.photo, friendships.*')
            ->join('user', 'user.id_user = friendships.user_id')
            ->where('friendships.friend_id', $userId)
            ->where('friendships.status', 'pending')
            ->findAll();
    }

    // Mendapatkan daftar permintaan yang telah dikirim oleh user (pending)
    public function getSentRequests($userId)
    {
        return $this->select('user.username, user.photo, friendships.*')
            ->join('user', 'user.id_user = friendships.friend_id')
            ->where('friendships.user_id', $userId)
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
