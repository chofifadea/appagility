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

    protected function base_query()
    {
        $m_pallet = new PalletModel();
        $m_wh = new SiteModel();
        $m_pgn = new PenggunaModel();

        $t_pallet = $m_pallet->getTable();
        $t_wh = $m_wh->getTable();
        $t_pgn = $m_pgn->getTable();

        return $this->db->table($this->table . ' _')
            ->join($t_pallet . ' pal', 'pal.id = _.id_pallet', 'left')
            ->join($t_wh . ' from_wh', 'from_wh.id = _.id_site_asal', 'left')
            ->join($t_wh . ' to_wh', 'to_wh.id = _.id_site_tujuan', 'left')
            ->join($t_pgn . ' pgn_creator', 'pgn_creator.id = _.created_by', 'left')
            ->join($t_pgn . ' pgn_approver', 'pgn_approver.id = _.approved_by', 'left')
            ->select([
                '_.*',
                'pal.nama as nama_pallet',
                'from_wh.nama as nama_site_asal',
                'to_wh.nama as nama_site_tujuan',
                'pgn_creator.nama as nama_creator',
                'pgn_approver.nama as nama_approver'
            ]);
    }

    public function data_in_wh($id_wh)
    {
        $q = $this->base_query()
            ->groupStart()
                ->where(['id_site_asal' => $id_wh])
                ->orWhere(['id_site_tujuan' => $id_wh])
            ->groupEnd()
            ->groupStart()
                ->whereIn('status', ['waiting_approval', 'approved'])
            ->groupEnd()
            ->where(['_.deleted_at' => null])
            ->get()->getResultArray();
        return $q;
    }

    public function all_data()
    {
        $q = $this->base_query()
            ->groupStart()
                ->whereIn('status', ['waiting_approval', 'approved'])
            ->groupEnd()
            ->where(['_.deleted_at' => null])
            ->get()->getResultArray();
        return $q;
    }
}
