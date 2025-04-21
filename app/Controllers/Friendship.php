<?php

namespace App\Controllers;

use App\Models\FriendshipModel;
use App\Models\UserModel;

class Friendship extends BaseController
{
    protected $friendshipModel;
    protected $userModel;

    public function __construct()
    {
        $this->friendshipModel = new FriendshipModel();
        $this->userModel = new UserModel();
    }

    // Menampilkan data pertemanan
    public function index()
    {
        $userId = session()->get('id');

        $data = [
            'title' => 'Pertemanan Anda',
            'friends' => $this->friendshipModel->getFriends($userId),
            'friendRequests' => $this->friendshipModel->getFriendRequests($userId),
            'sentRequests' => $this->friendshipModel->getSentRequests($userId)
        ];

        return view('friendship/index', $data);
    }

    // Menambahkan teman
    public function add()
    {
        $userId = session()->get('id');
        $friendId = $this->request->getPost('friend_id');

        if (!$friendId || !is_numeric($friendId) || $friendId == $userId) {
            return redirect()->to('/friendship')->with('error', 'ID teman tidak valid.');
        }

        $friend = $this->userModel->find($friendId);
        if (!$friend) {
            return redirect()->to('/friendship')->with('error', 'User dengan ID tersebut tidak ditemukan.');
        }

        $existing = $this->friendshipModel
            ->groupStart()
                ->where('user_id', $userId)
                ->where('friend_id', $friendId)
            ->groupEnd()
            ->orGroupStart()
                ->where('user_id', $friendId)
                ->where('friend_id', $userId)
            ->groupEnd()
            ->first();

        if ($existing) {
            if ($existing['status'] === 'pending') {
                return redirect()->to('/friendship')->with('info', 'Permintaan pertemanan sudah dikirim.');
            } else {
                return redirect()->to('/friendship')->with('info', 'Kamu sudah berteman dengan user ini.');
            }
        }

        $this->friendshipModel->addFriendRequest($userId, $friendId);
        return redirect()->to('/friendship')->with('success', 'Permintaan pertemanan berhasil dikirim.');
    }

    // Menerima pertemanan
    public function accept($id)
    {
        $cek = $this->friendshipModel->find($id);
        if (!$cek) {
            return redirect()->to('/friendship')->with('error', 'Permintaan tidak ditemukan.');
        }

        $this->friendshipModel->acceptFriendRequest($id);
        return redirect()->to('/friendship')->with('success', 'Permintaan pertemanan diterima.');
    }

    // Menolak pertemanan
    public function decline($id)
    {
        $cek = $this->friendshipModel->find($id);
        if (!$cek) {
            return redirect()->to('/friendship')->with('error', 'Permintaan tidak ditemukan.');
        }

        $this->friendshipModel->declineFriendRequest($id);
        return redirect()->to('/friendship')->with('success', 'Permintaan pertemanan ditolak.');
    }

    // Menghapus pertemanan
    public function remove($id)
    {
        $cek = $this->friendshipModel->find($id);
        if (!$cek) {
            return redirect()->to('/friendship')->with('error', 'Pertemanan tidak ditemukan.');
        }

        $this->friendshipModel->removeFriendById($id);
        return redirect()->to('/friendship')->with('success', 'Pertemanan berhasil dihapus.');
    }
}
