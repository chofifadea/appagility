<?php

namespace App\Models;

class PalletModel extends CrudModel
{
    protected $table = 'pallet';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
    ];
}