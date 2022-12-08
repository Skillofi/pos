<?php

namespace App\Models;

use CodeIgniter\Model;


class SystemSettingModel extends Model
{
    protected $table = 'system_setting';
    protected $allowedFields = ['id', 'title', 'favicon', 'logo', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'];
}
