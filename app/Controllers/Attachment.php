<?php

namespace App\Controllers;

use App\Models\AttachmentModel;

class Attachment extends BaseController
{
    protected $attachmentModel;

    public function __construct()
    {
        $this->attachmentModel = new AttachmentModel();
    }
        public function store()
        {
            $validation = \Config\Services::validation();
    
            $data = $this->request->getPost();
            $file = $this->request->getFile('photo');
    
            // Validasi input
            $isValid = $this->validate([
                'id_tugas' => 'required|numeric',
                'type' => 'required',
                'description' => 'permit_empty|string',
                'photo' => 'uploaded[photo]|max_size[photo,2048]|mime_in[photo,image/jpeg,image/png,application/pdf]',
            ]);
    
            if (!$isValid) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
    
            // Simpan file
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/atachment', $newName);
            }
    
            // Simpan ke database
            $attachmentModel = new AttachmentModel();
            $attachmentModel->insert([
                'id_tugas' => $data['id_tugas'],
                'type' => $data['type'],
                'file' => $newName ?? null,
                'description' => $data['description'],
            ]);
    
            return redirect()->to('/tugas/detail/' . $data['id_tugas'])->with('success', 'Attachment berhasil ditambahkan!');
        }
    

    // Method untuk menghapus lampiran
    public function delete($id)
    {
        $attachment = $this->attachmentModel->find($id);
        if ($attachment) {
            // Hapus file dari server
            unlink('public/uploads/attachment/' . $attachment['file']);

            // Hapus data lampiran dari database
            $this->attachmentModel->delete($id);

            return redirect()->back()->with('success', 'Lampiran berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Lampiran tidak ditemukan');
    }
}
