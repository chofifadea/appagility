<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionsModel extends Model
{
    protected $table = 'transactions';
    protected $useTimestamps = true;
    protected $allowedFields = ['pallet_name', 'information', 'site', 'quantity'];
}
