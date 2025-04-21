<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $session = session();
        $UserModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $UserModel->getUserByNama($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'level' => $user['level'],
                    'photo' => $user['photo'],
                    'logged_in' => true
                ]);

                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Nama tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}