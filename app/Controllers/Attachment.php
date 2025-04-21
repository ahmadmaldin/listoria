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

    // Method untuk menyimpan lampiran
    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            // Mengambil file dari form input
            $file = $this->request->getFile('foto');

            // Pastikan file valid
            if ($file->isValid() && !$file->hasMoved()) {
                // Tentukan folder tujuan penyimpanan file
                $filePath = 'uploads/attachment/';
                $fileName = $file->getRandomName(); // Nama file acak

                // Pindahkan file ke folder tujuan
                $file->move($filePath, $fileName);

                // Menyimpan data lampiran ke database
                $data = [
                    'id_tugas' => $this->request->getPost('idtugas'),
                    'file' => $fileName,
                    'tipe' => $this->request->getPost('tipe'),
                    'desk' => $this->request->getPost('desk')
                ];

                // Insert data ke database
                $this->attachmentModel->insert($data);

                return redirect()->to('tugas/detail/' . $this->request->getPost('idtugas'));
            } else {
                return redirect()->back()->with('error', 'File gagal diupload');
            }
        }
    }

    // Method untuk menghapus lampiran
    public function delete($id)
    {
        $attachment = $this->attachmentModel->find($id);
        if ($attachment) {
            // Hapus file dari server
            unlink('uploads/attachment/' . $attachment['file']);

            // Hapus data lampiran dari database
            $this->attachmentModel->delete($id);

            return redirect()->back()->with('success', 'Lampiran berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Lampiran tidak ditemukan');
    }
}
