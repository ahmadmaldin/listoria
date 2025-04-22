<?php
namespace App\Models;

use CodeIgniter\Model;

class AttachmentModel extends Model
{
    protected $table         = 'attachment';
    protected $primaryKey    = 'id_attachment';
    protected $allowedFields = ['id_tugas', 'type', 'file', 'description', 'content'];
   

    /**
     * Cari lampiran berdasarkan keyword dan paginasi
     *
     * @param string $keyword
     * @param int    $perPage
     * @param int    $id_tugas
     * @return \CodeIgniter\Pager\Pager
     */
    public function search(string $keyword, int $perPage, int $id_tugas)
    {
        return $this->where('id_tugas', $id_tugas)
                    ->groupStart()
                        ->like('file', $keyword)
                        ->orLike('type', $keyword)
                    ->groupEnd()
                    ->paginate($perPage);
    }

    /**
     * Ambil semua lampiran untuk tugas tertentu
     *
     * @param int $id_tugas
     * @return array
     */
    public function getByTugas(int $id_tugas): array
    {
        return $this->where('id_tugas', $id_tugas)
                    ->findAll();
    }
}
