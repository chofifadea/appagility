<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'password',
        'nama'
    ];

    private $encrypter = null;

    function __construct()
    {
        $this->db = db_connect();
        $this->encrypter = \Config\Services::encrypter();
    }

    function find_many($where)
    {
        $relpw = new RelPenggunaSite();
        $wh = new SiteModel();

        $t_relpw = $relpw->getTable();
        $t_wh = $wh->getTable();

        if(array_key_exists('_.deleted_at', $where) == false)
        {
            $where['_.deleted_at'] = null;
        }

        $res = $this->db->table($this->table . ' _')
            ->join($t_relpw . ' rpw', '_.id = rpw.id_pengguna and rpw.end_at is null', 'left')
            ->join($t_wh . ' wh', 'rpw.id_site = wh.id', 'left')
            // ->where(['deleted_at' => null])
            ->where($where)
            ->select([
                '_.*',
                'wh.nama as nama_site',
                'rpw.id_site'
            ])
            ->get()->getResultArray();
        // print_r($res);
        // exit();
        return $res;
    }

    function find_one($where)
    {
        $res = $this->find_many($where);
        if(count($res) == 0)
        {
            return null;
        }
        return $res[0];
    }

    public function hash_pass($pass)
    {
        return $this->encrypter->encrypt($pass);
    }

    public function create_super_admin($password)
    {
        $data = [
            'username' => 'admin',
            // 'password' => $this->hash_pass($password),
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'nama' => 'Super Admin',
            'tipe' => 'superadmin'
        ];
        
        return $this->create($data);
    }

    public function create($data)
    {
        $this->db->table($this->table)->insert($data);
        // return $id;
        $id =  $this->db->insertID();
        return $this->find_one(['_.'.$this->primaryKey => $id]);
    }

    public function update_data($where, $data)
    {
        $target = $this->find_one($where);

        if($target == null)
        {
            // echo 'hmm';
            // print_r($where);
            // print_r($data);
            return null;
        }

        $where2 = [ '_.' . $this->primaryKey => $target[$this->primaryKey] ];
        $this->db->table($this->table)
            ->where($where2)
            ->update($data);
        
        return $this->find_one($where2);
    }

    public function flag_hapus($where)
    {
        $target = $this->find_one($where);

        if($target == null)
        {
            return null;
        }

        $where2 = [ $this->primaryKey => $target[$this->primaryKey] ];

        $skrg = date('Y-m-d H:i:s');

        $data = ['deleted_at' => $skrg];

        $this->db->table($this->table)->where($where2)->update($data);

        return $target;
    }
}