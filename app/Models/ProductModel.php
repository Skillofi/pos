<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductModel extends Model
{
    protected $table = 'product';
    protected $allowedFields = ['id', 'name', 'code', 'price', 'stock', 'post_id'];
}
