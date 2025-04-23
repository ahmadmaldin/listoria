<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\UserModel;
use App\Models\MemberModel;

class Groups extends BaseController
{
    protected $groupModel;
    protected $userModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
        $this->userModel = new UserModel();
        
    }

    
    public function create()
{
    return view('groups/create');
}

    // Menampilkan daftar grup
    public function index()
    {
        $userId = session()->get('id_user');
        
        // Grup yang dibuat oleh user
        $createdGroups = $this->groupModel
        ->where('groups.id_user', $userId) // <<< perjelas nama tabel
        ->join('user', 'user.id_user = groups.id_user')
        ->select('groups.*, user.username')
        ->findAll();
    
    
        // Grup yang user ikuti (dari tabel member)
        $joinedGroups = $this->groupModel->getGroupsForCurrentUser($userId);
    
        // Gabungkan dua array dan hilangkan duplikat
        $allGroups = array_merge($createdGroups, $joinedGroups);
    
        // Menghapus duplikat berdasarkan id_groups
        $uniqueGroups = [];
        $seen = [];
    
        foreach ($allGroups as $group) {
            if (!in_array($group['id_groups'], $seen)) {
                $uniqueGroups[] = $group;
                $seen[] = $group['id_groups'];
            }
        }
    
        $data['groups'] = $uniqueGroups;
        return view('groups/index', $data);
    }
    
    // Menyimpan grup baru
    public function store()
    {
        // Ambil ID user dari session, tidak perlu diambil dari form
        $createdBy = session()->get('id_user');

        // Menyimpan data grup
        $this->groupModel->save([
            'group_name' => $this->request->getPost('group_name'),
            'id_user' => $createdBy, // Set id_user dengan ID user dari session
            'photo' => $this->uploadphoto(),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/groups')->with('message', 'Grup berhasil dibuat');
    }

    public function edit($id)
    {
        $groups = $this->groupModel->find($id);
        if (!$groups) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Group tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Group',
            'groups' => $groups
        ];
        return view('groups/edit', $data);
    }

    // Mengupdate data groups yang diubah pada halaman views/groups/edit
    public function update($id)
    {
        $group = $this->groupModel->find($id);
        if (!$group) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Group tidak ditemukan');
        }

        $password = $this->request->getPost('password')
            ? ($this->request->getPost('password'))
            : $group['password'];

        $data = [
            'group_name'   => $this->request->getPost('group_name'),
            'created_by'   => $this->request->getPost('created_by'),
            'group_owner'  => $this->request->getPost('group_owner'),
            'description' => $this->request->getPost('description'),
            'password'    => $password
        ];

        $this->groupModel->update($id, $data);
        return redirect()->to('/groups')->with('success', 'Group berhasil diperbarui.');
    }


    // Menghapus grup
    public function delete($id)
    {
        $this->groupModel->delete($id);
        return redirect()->to('/groups');
    }

    // Menampilkan detail grup dan anggota
    public function detail($id)
    {
        $group = $this->groupModel->find($id);
        $members = $this->groupModel->getMembers($id); // Misal ada method untuk ambil anggota grup
        $isOwner = $group['id_user'] == session()->get('id_user');  // Cek apakah yang melihat adalah pembuat grup

        $users = $this->userModel->where('id_user !=', session()->get('id_user'))->findAll();

        return view('groups/detail', [
            'group' => $group,
            'members' => $members,
            'isOwner' => $isOwner,
            'users' => $users,
        ]);
    }

    // Menambahkan anggota baru ke grup
    public function addMember()
    {
        $data = [
            'id_groups' => $this->request->getPost('id_groups'),
            'user_id' => $this->request->getPost('user_id'),
            'member_level' => 'anggota',  // Default level anggota, bisa sesuaikan jika admin
        ];

        $memberModel = new MemberModel();
        $memberModel->save($data);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    // Fungsi untuk mengupload foto grup
    private function uploadphoto()
    {
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/groups/', $newName);
            return $newName;
        }
        return null;
    }

    public function deleteMember()
{
    $userId = $this->request->getPost('user_id');
    $groupId = $this->request->getPost('id_groups');

    $db = \Config\Database::connect();

    // Hapus member berdasarkan user_id dan id_groups
    $db->table('member')
        ->where('user_id', $userId)
        ->where('id_groups', $groupId)
        ->delete();

    return redirect()->back()->with('message', 'Member berhasil dihapus.');
}

}
