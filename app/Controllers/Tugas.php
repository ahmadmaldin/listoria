<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TugasModel;
use App\Models\AttachmentModel;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\SharedModel;
use App\Models\FriendshipModel;

class Tugas extends BaseController
{
    protected $tugasModel;
    protected $attachmentModel;
    protected $userModel;
    protected $groupModel;
    protected $sharedModel;

    public function __construct()
    {
        $this->tugasModel      = new TugasModel();
        $this->attachmentModel = new AttachmentModel();
        $this->userModel       = new UserModel();
        $this->groupModel      = new GroupModel();
        $this->sharedModel      = new SharedModel();

    }

    public function create()
    {
        return view('tugas/create');
    }

    public function store()
    {
        $id_user = session()->get('id_user'); 
        $dataTugas = [
            'creator_id'  => $id_user,
            'tugas'    => $this->request->getPost('tugas'),
            'tanggal'  => $this->request->getPost('tanggal'),
            'waktu'    => $this->request->getPost('waktu'),
            'status'   => $this->request->getPost('status'),
            'alarm'   => $this->request->getPost('alarm'),
            'date_due'   => $this->request->getPost('date_due'),
            'time_due'   => $this->request->getPost('time_due'),
            'time_finished' => $this->request->getPost('status') === 'selesai' ? date('Y-m-d H:i:s') : null,
            'date_finished'   => $this->request->getPost('date_finished'),
        ];

        $this->tugasModel->save($dataTugas);

        return redirect()->to(site_url('tugas'))->with('success', 'Tugas berhasil dibuat...');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit tugas';
        $data['tugas'] = $this->tugasModel->find($id);
        return view('tugas/edit', $data);
    }

    public function update($id)
{
    $dataTugas = [
        'tugas'    => $this->request->getPost('tugas'),
        'tanggal'  => $this->request->getPost('tanggal'),
        'status'   => $this->request->getPost('status'),
        'alarm'    => $this->request->getPost('alarm'),
        'date_due' => $this->request->getPost('date_due'),
        'time_due' => $this->request->getPost('time_due'),
        'time_finished' => $this->request->getPost('status') === 'selesai' ? date('Y-m-d H:i:s') : null,
        'date_finished' => $this->request->getPost('date_finished'),
    ];

    $this->tugasModel->update($id, $dataTugas);

    return redirect()->to('/tugas')->with('success', 'Tugas berhasil diperbarui!');
}


public function delete($id)
{
    $this->tugasModel->delete($id);
    session()->setFlashdata('success', 'Tugas berhasil dihapus!');
    return redirect()->to('/tugas');
}

    public function upload()
    {
        $file = $this->request->getFile('file');
        $tugasId = $this->request->getPost('tugas_id');
    
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'File tidak valid atau tidak ditemukan.');
        }
    
        $newName = $file->getRandomName();
        $file->move('uploads/attachment', $newName);
    
        $this->attachmentModel->insert([
            'id_tugas' => $tugasId,
            'type' => 'file',
            'file' => 'uploads/attachment/' . $newName,
            'description' => null,
            'content' => null
        ]);
    
        return redirect()->to('/tugas/detail/' . $tugasId)->with('success', 'Lampiran berhasil diunggah!');
    }
    // Menampilkan detail tugas
    public function detail($id)
    {
        $attachmentModel = new AttachmentModel();
        $userModel = new UserModel();
        $groupModel = new GroupModel();
        $sharedModel = new SharedModel();

        // Ambil data tugas
        $tugas = $this->tugasModel->find($id);

        if (!$tugas) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan.');
        }

        // Mengambil lampiran tugas
        $attachments = $attachmentModel->where('id_tugas', $id)->findAll();

        // Mengambil daftar teman dan grup
        $users = $userModel->findAll();
        $groups = $groupModel->findAll();

        // Mengambil pengguna yang telah berbagi tugas
        $sharedUsers = $sharedModel
        ->join('user', 'user.id_user = shared.id_user')
        ->where('shared.id_tugas', $id)
        ->findAll();
    
        return view('tugas/detail', [
            'title' => 'Detail Tugas',
            'tugas' => $tugas,
            'attachments' => $attachments,
            'users' => $users,
            'groups' => $groups,
            'sharedUsers' => $sharedUsers
        ]);
    }
    

    public function show($id)
    {
        $tugas = $this->tugasModel->getTugasWithCreator($id);
        return view('tugas/detail', ['tugas' => $tugas]);
    }

    public function selesai($id)
    {
        $this->tugasModel->update($id, ['status' => 'Selesai']);
        return redirect()->to('/tugas/detail/' . $id)->with('success', 'Tugas berhasil ditandai sebagai selesai.');
    }

    public function index()
    {
        $userId = session()->get('id_user');
        $keyword = $this->request->getGet('keyword');
        $perPage = 10;

        $query = $this->tugasModel->where('creator_id', $userId);
        if ($keyword) {
            $query->like('tugas', $keyword);
        }

        $tugas = $query->paginate($perPage);

        $data = [
            'title'  => 'Daftar Tugas Saya',
            'tugas' => $tugas,
            'pager'  => $this->tugasModel->pager,
            'keyword' => $keyword
        ];

        return view('tugas/index', $data);
    }

    public function dashboard()
    {
        $userId = session()->get('id_user');
        $tugasMendekatiDeadline = $this->tugasModel->getTugasMendekatiDeadline($userId);

        return view('layouts/dashboard', [
            'tugasMendekatiDeadline' => $tugasMendekatiDeadline
        ]);
    }

    // Menampilkan tugas yang dibagikan kepada pengguna
    public function sharedToMe()
    {
        $id_user = session()->get('id_user');
        $sharedTugas = $this->sharedModel
            ->join('tugas', 'tugas.id = shared.id_tugas')
            ->select('shared.*, tugas.tugas, tugas.id as tugas_id')
            ->where('shared.id_user', $id_user)
            ->findAll();
    
        $userModel = new UserModel();
        $users = [];
    
        foreach ($sharedTugas as $shared) {
            $user = $userModel->find($shared['shared_by_user_id']);
            if ($user) {
                $users[$shared['shared_by_user_id']] = $user['username'];
            }
        }
    
        return view('tugas/sharedtome', [
            'shared_tugas' => $sharedTugas,
            'users' => $users
        ]);
    }

     // Menampilkan form berbagi tugas
     public function share($taskId)
     {
         $task = $this->tugasModel->find($taskId);
 
         if (!$task) {
             return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan.');
         }
 
         $friendshipModel = new FriendshipModel();
         $groupModel = new GroupModel();
         $friends = $friendshipModel->getFriends(session()->get('id_user')); // Ambil teman berdasarkan id_user
         $groups = $groupModel->findAll(); // Ambil semua grup
 
         return view('tugas/share', [
             'task' => $task,
             'friends' => $friends,
             'groups' => $groups
         ]);
     }
 
     // Memproses pembagian tugas
     public function processShare($taskId)
     {
         // Periksa apakah taskId valid
         if (!$taskId || !is_numeric($taskId)) {
             return redirect()->to('/tugas')->with('error', 'ID tugas tidak valid.');
         }
 
         // Ambil data teman dan grup yang dipilih
         $friendsSelected = $this->request->getPost('friends');
         $groupsSelected = $this->request->getPost('groups');
 
         if (!empty($friendsSelected)) {
             foreach ($friendsSelected as $friendId) {
                 $this->shareTaskToFriend($taskId, $friendId);
             }
         }
 
         if (!empty($groupsSelected)) {
             foreach ($groupsSelected as $groupId) {
                 $this->shareTaskToGroup($taskId, $groupId);
             }
         }
 
         return redirect()->to('/tugas')->with('message', 'Tugas berhasil dibagikan.');
     }
 
     public function shareTaskToFriend($taskId, $friendId)
     {
         $sharedData = [
             'id_tugas' => $taskId,
             'id_user' => $friendId,
             'shared_by_user_id' => session()->get('id_user'),
             'share_date' => date('Y-m-d H:i:s'),
             'accept_date' => null
         ];
     
         $this->sharedModel->save($sharedData);
     }
     
 
     // Membagikan tugas ke grup
     public function shareTaskToGroup($taskId, $groupId)
     {
         // Logic untuk membagikan tugas ke grup akan ditambahkan sesuai kebutuhan
     }
}
