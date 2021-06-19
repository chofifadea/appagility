<?php

namespace App\Models;

class SiteModel extends CrudModel
{
    protected $table = 'site';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'tipe'
    ];
}