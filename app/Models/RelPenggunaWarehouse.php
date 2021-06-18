<?php

namespace App\Models;

class RelPenggunaWarehouse extends CrudModel
{
    protected $table = 'rel_pengguna_warehouse';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_pengguna',
        'id_warehouse',
        'start_at',
        'end_at',
    ];

    public function create($data)
    {
        $skrg = date('Y-m-d H:i:s');
        
        $where = [
            'id_pengguna' => $data['id_pengguna'],
            'end_at' => null,
        ];
        $upd = [
            'end_at' => $skrg
        ];
        
        $this->update_many($where, $upd);
        
        $data['start_at'] = $skrg;
        
        return parent::create($data);
    }
}