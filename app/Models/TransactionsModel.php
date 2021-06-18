<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionsModel extends CrudModel
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pallet_name',
        'information',
        'site',
        'quantity'

    ];

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

    public function data_in_wh($id_wh)
    {
        $m_pallet = new PalletModel();
        $m_wh = new WarehouseModel();

        $t_pallet = $m_pallet->getTable();
        $t_wh = $m_wh->getTable();

        $q = $this->db->table($this->table . ' _')
            ->join($t_pallet . ' pal', 'pal.id = _.id_pallet', 'left')
            ->join($t_wh . ' from_wh', 'from_wh.id = _.id_warehouse_asal', 'left')
            ->join($t_wh . ' to_wh', 'to_wh.id = _.id_warehouse_tujuan', 'left')
            ->groupStart()
                ->where(['id_warehouse_asal' => $id_wh])
                ->orWhere(['id_warehouse_tujuan' => $id_wh])
            ->groupEnd()
            ->where(['_.deleted_at' => null])
            ->select([
                '_.*',
                'pal.nama as nama_pallet',
                'from_wh.nama as nama_wh_asal',
                'to_wh.nama as nama_wh_tujuan',
            ])
            ->get()->getResultArray();
        return $q;
    }
}
