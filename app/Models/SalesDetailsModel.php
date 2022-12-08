<?php

namespace App\Models;

use CodeIgniter\Model;


class SalesDetailsModel extends Model
{
    protected $table = 'sales_details';
    protected $allowedFields = ['id', 'sales_id', 'product_id', 'price', 'qty', 'amount'];
}
