<?php

namespace App\Controllers;

use App\Models\TugasModel;

class DashboardController extends BaseController
{
    protected $tugasModel;

    public function __construct()
    {
        $this->tugasModel = new TugasModel();
    }

    public function index()
    {
        $userId = session()->get('id_user');

        // Ambil tugas berdasarkan status
        $toDo = $this->tugasModel->where('status', 'to do')->where('id_user', $userId)->countAllResults();
        $berjalan = $this->tugasModel->where('status', 'doing')->where('id_user', $userId)->countAllResults();
        $selesai = $this->tugasModel->where('status', 'selesai')->where('id_user', $userId)->countAllResults();
        $batal = $this->tugasModel->where('status', 'batal')->where('id_user', $userId)->countAllResults();

        // Ambil deadline tugas mendekat
        $deadline = $this->tugasModel->where('date_due >=', date('Y-m-d'))
                                     ->where('id_user', $userId)
                                     ->orderBy('date_due', 'ASC')
                                     ->findAll();

        // Kirim data ke view
        $data = [
            'tanggal' => date('l, d F Y'),
            'quote'   => '"Urus tugasmu dengan cinta, bukan tekanan 💜"',
            'toDo'    => $toDo,
            'berjalan' => $berjalan,
            'selesai' => $selesai,
            'batal'   => $batal,
            'deadline' => $deadline
        ];

        return view('layouts/dashboard', $data);
    }
}
