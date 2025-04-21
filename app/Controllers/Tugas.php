<?php

namespace App\Controllers;

use App\Models\TugasModel;
use App\Models\UserModel;
use App\Models\SharedModel;
use App\Models\AttachmentModel;
use App\Models\FriendshipModel;
use CodeIgniter\Controller;

class Tugas extends Controller
{
    protected $tugasModel;
    protected $sharedModel;
    protected $userModel;
    protected $friendshipModel;

    public function __construct()
    {
        $this->tugasModel = new TugasModel();
        $this->userModel = new UserModel();
        $this->sharedModel = new SharedModel();
        $this->friendshipModel = new FriendshipModel();
    }
    
    // Fungsi untuk menambah tugas
    public function create()
    {
        return view('tugas/create');
    }

    // Fungsi untuk menyimpan tugas
    public function store()
    {
        $tugasModel = new TugasModel();
        $sharedModel = new SharedModel();

    

        $dataTugas = [
            'id_user' => $this->request->getPost('creator_id'),
            'tugas' => $this->request->getPost('tugas'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'status' => $this->request->getPost('status'),
        ];

        // Simpan data tugas
        $tugasModel->save($dataTugas);

        // Ambil ID tugas yang baru disimpan
        $id = $tugasModel->insertID();

        // Tambahkan ke shared untuk user itu sendiri
        $sharedModel->insert([
            'id'    => $id,
            'shared_type' => 'user',
            'shared_date' => date('Y-m-d H:i:s'),
            'accept_date' => date('Y-m-d H:i:s'),

        ]);

        return redirect()->to('tugas/index')->with('success', 'Tugas berhasil dibuat dan dibagikan ke diri sendiri.');
    }

    // Fungsi untuk edit tugas
    public function edit($id)
    {
        $data['title'] = 'Edit tugas';
        $data['tugas'] = $this->tugasModel->find($id);
        return view('tugas/edit', $data);
    }

    // Fungsi untuk update tugas
    public function update($id)
    {
        $model = new TugasModel();
        $file = $this->request->getFile('foto');

        $model->update($id, [
            'tugas' => $this->request->getPost('tugas'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('tugas/index');
    }
    // Fungsi untuk delete tugas
    public function delete($id)
    {
        $this->tugasModel->delete($id);
        session()->setFlashdata('success', 'Tugas berhasil dihapus!');
        return redirect()->to('/tugas');
    }
    

    // Fungsi untuk upload lampiran
    public function upload()
    {
        $file = $this->request->getFile('attachment');
        $tugasId = $this->request->getPost('tugas_id');
    
        // Cek apakah file ada dan valid
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'File tidak valid atau tidak ditemukan.');
        }
    
        // Generate nama acak untuk file
        $newName = $file->getRandomName();
    
        // Pindahkan file ke folder uploads
        $file->move('uploads', $newName);
    
        // Simpan ke database
        $model = new \App\Models\AttachmentModel();
        $model->insert([
            'id_tugas'   => $tugasId,
            'file_name'  => $file->getClientName(),
            'path_file'  => 'uploads/' . $newName,
            'type'       => 'file', // bisa kamu ubah sesuai logika tipe kalau perlu
            'description'=> null,   // kalau ada kolom ini, kasih nilai default aja dulu
            'content'    => null    // supaya null kalau tidak digunakan
        ]);
    
        return redirect()->back()->with('success', 'Lampiran berhasil diunggah!');
    }
    

    // Menampilkan detail tugas
    public function detail($id)
    {
        $data['title'] = 'Detail Tugas';
        $model = new AttachmentModel();
        $sharedModel = new SharedModel();
        $userModel = new UserModel();
        $groupModel = new \App\Models\GroupModel();
    
        // Menyesuaikan dengan kolom di database
        $data['attachment'] = $model->select('*')
            ->where('id_tugas', $id)
            ->findAll();
    
        $data['tugas'] = $this->tugasModel
            ->join('user', 'user.id_user = tugas.creator_id', 'left')  // Menyesuaikan relasi dengan user
            ->where('tugas.id', $id)
            ->first();
    
        // Mengambil semua pengguna
        $data['users'] = $userModel->findAll();
    
        // Mengambil semua grup yang ada
        $data['groups'] = $groupModel->findAll();
    
        return view('tugas/detail', $data);
    }
    
    
    
    // Fungsi untuk membagikan tugas
public function share($id)
{
    $tugas = $this->tugasModel->find($id);

    if (!$tugas) {
        return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan.');
    }

    // Mendapatkan ID pengguna yang sedang login
    $userId = session()->get('id_user');

    // Mendapatkan data dari form
    $sharedTo = $this->request->getPost('shared_to');  // ID user atau ID grup
    $sharedType = $this->request->getPost('shared_type');  // 'user' atau 'group'

    if ($sharedTo && $sharedType) {
        $sharedData = [
            'id_tugas' => $id,
            'shared_by' => $userId,
            'shared_to' => $sharedTo,
            'shared_type' => $sharedType,
            'shared_date' => date('Y-m-d H:i:s'),
        ];

        // Simpan data pembagian tugas ke tabel shared
        $this->sharedModel->insert($sharedData);

        return redirect()->to('/tugas/detail/' . $id)->with('success', 'Tugas berhasil dibagikan!');
    } else {
        return redirect()->to('/tugas/detail/' . $id)->with('error', 'Silakan pilih pengguna atau grup yang valid untuk membagikan tugas.');
    }
}
public function storeShared($id)
{
    $sharedToUser = $this->request->getPost('shared_to_user');
    $sharedToGroup = $this->request->getPost('shared_to_group');
    $tugasId = $id;  // Mendapatkan ID tugas dari URL

    if (!$tugasId) {
        return redirect()->back()->with('error', 'ID tugas tidak valid!');
    }

    // Pastikan hanya satu yang dipilih (Pengguna atau Grup)
    if (!empty($sharedToUser) && empty($sharedToGroup)) {
        // Pilihan Pengguna
        $this->sharedModel->insert([
            'shared_to' => $sharedToUser,
            'shared_type' => 'user',
            'id_tugas' => $tugasId,
            'shared_by' => session()->get('id_user')
        ]);
    } elseif (empty($sharedToUser) && !empty($sharedToGroup)) {
        // Pilihan Grup
        $this->sharedModel->insert([
            'shared_to' => $sharedToGroup,
            'shared_type' => 'group',
            'id_tugas' => $tugasId,
            'shared_by' => session()->get('id_user')
        ]);
    } else {
        // Jika tidak ada yang dipilih
        return redirect()->back()->with('error', 'Pilih Pengguna atau Grup terlebih dahulu!');
    }

    return redirect()->back()->with('success', 'Tugas berhasil dibagikan!');
}



    // Menampilkan tugas yang dibagikan kepada user
    public function sharedToMe()
    {
        $sharedModel = new SharedModel();
        $userId = session()->get('id_user');  // Sesuaikan dengan session id_user

        $keyword = $this->request->getGet('keyword');

        $sharedQuery = $sharedModel
            ->select('shared.*, tugas.tugas, tugas.tanggal, u.username as shared_by_name')
            ->join('tugas', 'tugas.id_tugas = shared.id_tugas') // Menyesuaikan dengan id_tugas
            ->join('user u', 'u.id_user = shared.shared_by')
            ->where('shared.shared_to', $userId)
            ->where('shared.shared_type', 'user');

        if ($keyword) {
            $sharedQuery->like('tugas.tugas', $keyword);
        }

        $sharedTasks = $sharedQuery->orderBy('shared.shareddate', 'DESC')->paginate(10);

        return view('tugas/sharedtome', [
            'sharedTasks' => $sharedTasks,
            'title'   => 'Tugas Dibagikan kepada Saya',
            'pager' => $sharedModel->pager,
        ]);
    }

    // Fungsi untuk merubah status tugas menjadi Selesai
    public function selesai($id)
    {
        $tugasModel = new TugasModel();

        // Update status tugas menjadi "Selesai"
        $tugasModel->update($id, ['status' => 'Selesai']);

        return redirect()->to('/tugas/detail/' . $id)->with('success', 'Tugas berhasil ditandai sebagai selesai.');
    }
    
    // Menampilkan daftar tugas
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $perPage = 10;

        if ($keyword) {
            $tugas = $this->tugasModel->search($keyword, $perPage);
        } else {
            $tugas = $this->tugasModel->paginate($perPage);
        }

        $data = [
            'title'  => 'Daftar Tugas',
            'tugas' => $tugas,
            'pager'  => $this->tugasModel->pager,
            'keyword' => $keyword
        ];
        return view('tugas/index', $data);
    }
}
