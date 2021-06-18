<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    protected $table = '';
    protected $primaryKey = 'id';

    public function getTable()
    {
        return $this->table;
    }

    protected function base_query()
    {
        $q = $this->db->table($this->table . ' _');
        
        return $q;
    }

    function find_many($where)
    {
        if(array_key_exists('_.deleted_at', $where) == false)
        {
            $where['_.deleted_at'] = null;
        }

        // $res = $this->db->table($this->table)
        $res = $this->base_query()
            // ->where(['deleted_at' => null])
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

    public function create($data)
    {
        $this->db->table($this->table)->insert($data);
        // return $id;
        $id =  $this->db->insertID();
        return $this->find_one(['_.' . $this->primaryKey => $id]);
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

        $where2 = [ $this->primaryKey => $target[$this->primaryKey] ];
        $this->db->table($this->table)
            ->where($where2)
            ->update($data);
        
        $where2 = [ '_.' . $this->primaryKey => $target[$this->primaryKey] ];
        
        return $this->find_one($where2);
    }

    public function update_many($where, $data)
    {
        $targets = $this->find_many($where);

        if(count($targets) == 0)
        {
            return null;
        }

        $res = [];

        foreach($targets as $target)
        {
            $where2 = [$this->primaryKey => $target[$this->primaryKey] ];
            $this->db->table($this->table)
                ->where($where2)
                ->update($data);
            
            $res[] = $this->find_one($where2);
        }

        return $res;
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