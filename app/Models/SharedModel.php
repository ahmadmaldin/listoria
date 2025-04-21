<?php
// if this line is still there, it means I just copy paste my friend's UKK application
namespace App\Models;

use CodeIgniter\Model;

class SharedModel extends Model
{
    protected $table = 'shared';
    protected $primaryKey = 'id_shared';
    protected $allowedFields = ['id_tugas', 'shared_to', 'shared_by', 'accepted', 'shared__date'];
}