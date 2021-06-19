<?php

namespace App\Models;

class TransInfoModel extends CrudModel
{
    protected $table = 'trans_info';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'info',
        'tipe',
    ];
}