<?php
namespace App\Models;

use CodeIgniter\Model;

class SharedModel extends Model
{
    protected $table      = 'shared';
    protected $primaryKey = 'id_shared';
    protected $allowedFields = [
        'id_tugas', 'shared_type', 'shared_to', 'shared_by', 
        'accepted', 'share_date', 'accept_date'
    ];

    // Jika perlu, bisa ditambahkan aturan validasi dan sebagainya.
}
