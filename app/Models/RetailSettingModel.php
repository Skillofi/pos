<?php

namespace App\Models;

use CodeIgniter\Model;


class RetailSettingModel extends Model
{
    protected $table = 'retail_setting';
    protected $allowedFields = ['id', 'name', 'phone', 'email', 'address', 'terms'];
}
