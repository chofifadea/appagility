<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionsModel extends Model
{
    function __construct()

    {
        $this->db = db_connect();
    }

    function tampildata()
    {
        return $this->db->table('transactions')->get();
    }

    function simpan($data)
    {
        return $this->db->table('transactions')->insert($data);
    }
}
