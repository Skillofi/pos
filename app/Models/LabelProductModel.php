<?php

namespace App\Models;

use CodeIgniter\Model;


class LabelProductModel extends Model
{
    protected $table = 'label_product';
    protected $allowedFields = ['id', 'dnumber', 'brand', 'make', 'storage', 'model_no', 'color', 'grade', 'icloud', 'carrier'];
}
