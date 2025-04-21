<?php

namespace App\Controllers;

use App\Models\MemberModel;
use CodeIgniter\Controller;

class Member extends BaseController
{
    protected $MemberModel;

    public function __construct()
    {
        $this->MemberModel = new MemberModel();
    }

    public function index()
    {
        $data['member'] = $this->MemberModel->findAll();
        return view('member/index', $data);
    }

    public function create()
    {
        return view('member/create');
    }

    public function store()
    {
        $this->MemberModel->save($this->request->getPost());
        session()->setFlashdata('success', 'Member berhasil ditambahkan!');
        return redirect()->to('/member');
    }

    public function edit($id)
    {
        $data['member'] = $this->MemberModel->find($id);
        return view('member/edit', $data);
    }

    public function update($id)
    {
        $this->MemberModel->update($id, $this->request->getPost());
        session()->setFlashdata('success', 'Member berhasil diperbarui!');
        return redirect()->to('/member');
    }

    public function delete($id)
    {
        $this->MemberModel->delete($id);
        session()->setFlashdata('success', 'Member berhasil dihapus!');
        return redirect()->to('/member');
    }
}
