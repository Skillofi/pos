<?php

namespace App\Models;
use CodeIgniter\Model;


class TransactionModel extends Model
{
    protected $table = 'wp_postmeta';
    protected $allowedFields = ['meta_id', 'post_id', 'meta_key', 'meta_value'];

    
    public function transaction_list(){
        
    }
}
