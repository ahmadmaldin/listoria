<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TugasModel;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\MemberModel;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $allowedFields = ['id_groups', 'user_id', 'member_level'];
}
