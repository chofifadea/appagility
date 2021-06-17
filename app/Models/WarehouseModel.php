<?php

namespace App\Models;

class WarehouseModel extends CrudModel
{
    protected $table = 'warehouse';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
    ];
}