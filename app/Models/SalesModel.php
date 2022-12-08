<?php

namespace App\Models;

use CodeIgniter\Model;


class SalesModel extends Model
{
    protected $table = 'sales';
    protected $allowedFields = ['id', 'customer_id', 'date_time', 'reference_no', 'warehouse', 'tax', 'discount', 'shipping', 'grand_total', 'status', 'payment_status', 'sale_note', 'staff_note', 'invoice'];
}
