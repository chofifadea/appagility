<?php

namespace App\Models;

class RelPenggunaSite extends CrudModel
{
    protected $table = 'rel_pengguna_site';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_pengguna',
        'id_site',
        'start_at',
        'end_at',
    ];

    protected function base_query()
    {
        $m_site = new SiteModel();
        
        $t_site = $m_site->getTable();

        $q = parent::base_query();
        $q->join($t_site . ' st', 'st.id = _.id_site', 'left')
            ->select([
                'st.nama as nama_site',
                '_.*'
            ])
            // ->select('st.nama as nama_site')
            ;
        
        return $q;
    }

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