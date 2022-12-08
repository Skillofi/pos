<?php

namespace App\Models;

use CodeIgniter\Model;


class PaymentModel extends Model
{
    protected $table = 'payment';
    protected $allowedFields = ['id', 'sales_id', 'amount', 'payment_method', 'payment_note', 'datetime'];
}
