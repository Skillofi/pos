<?php

namespace App\Models;

use CodeIgniter\Model;


class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $allowedFields = ['id', 'name', 'phone', 'email', 'company', 'address', 'city', 'state', 'postal_code', 'country'];
    
}
