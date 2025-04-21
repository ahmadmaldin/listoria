<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id_member';

    protected $allowedFields = ['id_groups', 'user_id', 'member_level'];
}
