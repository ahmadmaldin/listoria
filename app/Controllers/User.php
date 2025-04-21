<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class user extends Controller
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $perPage = 10; // Jumlah data per halaman

        if ($keyword) {
            $user = $this->UserModel->search($keyword, $perPage);
        } else {
            $user = $this->UserModel->paginate($perPage);
        }

        $data = [
            'title'  => 'Data user',
            'user' => $user,
            'pager'  => $this->UserModel->pager, // Untuk pagination
            'keyword' => $keyword
        ];
        return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title'  => 'Tambah user',
        ];
        return view('user/create', $data);
    }

    public function store()
{
    $userModel = new \App\Models\UserModel();

    // Ambil data dari form
    $data = [
        'username' => $this->request->getPost('username'),
        'level'    => $this->request->getPost('level'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ];

    // Cek apakah ada foto yang diupload
    $photo = $this->request->getFile('photo');
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move('uploads/users/', $photoName);
        $data['photo'] = $photoName;
    }

    // Simpan data ke database
    $userModel->insert($data);

    // Redirect ke login dengan pesan sukses
    return redirect()->to('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
}


    public function edit($id)
    {
        $data = [
            'title'  => 'Tambah user',
        ];

        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('user/edit', $data);
    }

    public function update($id_user)
    {
        $model = new UserModel();
        $user = $model->find($id_user);
        $password = $this->request->getPost('password') ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT) : $user['password'];

        $data = [
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
            'password' => $password
        ];

        if ($photo = $this->uploadphoto()) {
            $data['photo'] = $photo;
        }

        $model->update($id_user, $data);
        return redirect()->to('/user')->with('success', 'Data user berhasil diperbarui.');
    }

    public function delete($id_user)
    {
        $model = new UserModel();
        $model->delete($id_user);
        return redirect()->to('/user')->with('success', 'Data user berhasil dihapus.');
    }

    private function uploadphoto()
    {
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/user/', $newName);
            return $newName;
        }
        return null;
    }
}