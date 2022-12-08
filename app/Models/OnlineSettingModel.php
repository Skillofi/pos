<?php

namespace App\Models;

use CodeIgniter\Model;


class OnlineSettingModel extends Model
{
    protected $table = 'online_setting';
    protected $allowedFields = ['id', 'name', 'phone', 'email', 'address', 'terms'];
}
