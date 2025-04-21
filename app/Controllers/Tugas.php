<?php

namespace App\Controllers;

use App\Models\TugasModel;
use App\Models\AttachmentModel;
use App\Models\UserModel;
use App\Models\GroupModel; 
use App\Models\SharedModel; 


class Tugas extends BaseController
{
    protected $tugasModel;
    protected $attachmentModel;
    protected $userModel;
    protected $groupModel;
    protected $sharedModel;

    public function __construct()
    {
        // Buat instance model
        $this->tugasModel      = new TugasModel();
        $this->attachmentModel = new AttachmentModel();
        $this->userModel       = new UserModel();
        $this->groupModel     = new GroupModel(); 
        $this->sharedModel     = new SharedModel(); 

    }
    
    // Fungsi untuk menambah tugas
    public function create()
    {
        return view('tugas/create');
    }

    // Fungsi untuk menyimpan tugas
    public function store()
    {
        $dataTugas = [
            'id_user' => $this->request->getPost('creator_id'),
            'tugas' => $this->request->getPost('tugas'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'status' => $this->request->getPost('status'),
        ];

        // Simpan data tugas
        $this->tugasModel->save($dataTugas);

        // Ambil ID tugas yang baru disimpan
        $id = $this->tugasModel->insertID();

        // Tambahkan ke shared untuk user itu sendiri
        $this->sharedModel->insert([
            'id_tugas' => $id,
            'shared_type' => 'user',
            'shared_date' => date('Y-m-d H:i:s'),
            'accept_date' => date('Y-m-d H:i:s'),
            'shared_by' => $this->request->getPost('creator_id'),
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
        $this->tugasModel->update($id, [
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

    // Fungsi untuk upload attachment
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

    // Fungsi untuk menampilkan detail tugas
    public function detail($id)
{
    // Ambil data tugas
    $tugas = $this->tugasModel->find($id);

    // Ambil semua lampiran yang terhubung dengan tugas ini
    $lampiran = $this->attachmentModel
                     ->where('id_tugas', $id)
                     ->findAll();

    return view('tugas/detail', [
        'tugas'     => $tugas,
        'lampiran'  => $lampiran,
        // data lain seperti daftar user/grup untuk share
        'users'     => $this->userModel->findAll(),
        'groups'    => $this->groupModel->findAll(),
    ]);
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
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk membagikan tugas.');
        }

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

    // Fungsi untuk menyimpan pembagian tugas
    public function storeShared($id)
    {
        $sharedToUser = $this->request->getPost('shared_to_user');
        $sharedToGroup = $this->request->getPost('shared_to_group');
        $sharedTo = $sharedToUser ?: $sharedToGroup;  // Tentukan siapa yang akan mendapatkan tugas

        if (!$sharedTo) {
            return redirect()->to('/tugas/detail/' . $id)->with('error', 'Silakan pilih pengguna atau grup yang valid untuk membagikan tugas.');
        }

        // Cek apakah data sudah ada
        $existingShare = $this->sharedModel->where('id_tugas', $id)
                                           ->where('shared_to', $sharedTo)
                                           ->where('shared_type', $sharedToUser ? 1 : 2)
                                           ->first();

        if ($existingShare) {
            session()->setFlashdata('error', 'Tugas sudah dibagikan ke user atau grup ini.');
            return redirect()->to('/tugas/detail/' . $id);
        }

        // Mendapatkan ID pengguna yang sedang login
        $sharedBy = session()->get('id_user');
        if (!$sharedBy) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk membagikan tugas.');
        }

        // Lanjutkan dengan menyimpan data
        $data = [
            'id_tugas' => $id,
            'shared_type' => $sharedToUser ? 1 : 2,
            'shared_to' => $sharedTo,
            'shared_by' => $sharedBy,
            'accepted' => 'shared',
            'share_date' => date('Y-m-d H:i:s')
        ];

        $this->sharedModel->save($data);

        return redirect()->to('/tugas/detail/' . $id)->with('success', 'Tugas berhasil dibagikan!');
    }

    // Fungsi untuk merubah status tugas menjadi Selesai
    public function selesai($id)
    {
        $this->tugasModel->update($id, ['status' => 'Selesai']);

        return redirect()->to('/tugas/detail/' . $id)->with('success', 'Tugas berhasil ditandai sebagai selesai.');
    }

    // Menampilkan daftar tugas
   // Menampilkan daftar tugas
// Menampilkan daftar tugas
public function index()
{
    // Ambil ID user yang sedang login
    $userId = session()->get('id_user'); // Ambil ID user dari session yang sedang login
    $keyword = $this->request->getGet('keyword'); // Jika ada pencarian kata kunci
    $perPage = 10; // Set jumlah data per halaman

    // Cek apakah userId ada (jika belum login)
    if (!$userId) {
        return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    // Query untuk mengambil tugas yang hanya dibuat oleh user yang sedang login
    $query = $this->tugasModel->where('creator_id', $userId); // Ganti id_user dengan creator_id

    if ($keyword) {
        $query->like('tugas', $keyword); // Jika ada kata kunci pencarian, cari tugas yang sesuai
    }

    // Ambil data tugas
    $tugas = $query->paginate($perPage);

    // Data untuk tampilan
    $data = [
        'title'  => 'Daftar Tugas Saya',
        'tugas' => $tugas,
        'pager'  => $this->tugasModel->pager, // Untuk pagination
        'keyword' => $keyword
    ];

    return view('tugas/index', $data);
}


}
