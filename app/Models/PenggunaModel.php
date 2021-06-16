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
        $res = $this->db->table($this->table)
            ->where(['deleted_at' => null])
            ->where($where)
            ->get()->getResultArray();
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
        return $this->find_one([$this->primaryKey => $id]);
    }
}