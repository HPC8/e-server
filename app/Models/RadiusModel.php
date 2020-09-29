<?php

namespace App\Models;

use CodeIgniter\Model;


class RadiusModel extends Model
{

    protected $employee = 'radius_employee';
    protected $radiusInfo = 'userinfo';
    protected $radiusRadcheck = 'radcheck';
    protected $raduserGroup = 'radusergroup';

    public function radiusInfo($id)
    {
        $builder = $this->db->table($this->employee);
        $builder->where('emp_id', $id);
        $query = $builder->get();
        $data = $query->getResult();
        $radiusInfo = [
            'username' => $data[0]->hospname,
            'firstname' => $data[0]->firstname,
            'lastname' => $data[0]->lastname,
            'email' => $data[0]->email,
        ];
        $this->db->table($this->radiusInfo)->insert($radiusInfo);
        //return ($radiusInfo);
    }

    public function radiusCheck($id)
    {
        $builder = $this->db->table($this->employee);
        $builder->where('emp_id', $id);
        $query = $builder->get();
        $data = $query->getResult();

        $nationalId = "";
        $arr_ph = explode("-", $data[0]->cid);
        foreach ($arr_ph as $i) {
            $nationalId = $nationalId . $i;
        }
        $radiusCheck = [
            'username' => $data[0]->hospname,
            'attribute' => 'Cleartext-Password',
            'op' => ':=',
            'value' => $nationalId,
        ];
        $this->db->table($this->radiusRadcheck)->insert($radiusCheck);
        //return ($radiusCheck);
    }


    public function radiusGroup($id)
    {
        $builder = $this->db->table($this->employee);
        $builder->where('emp_id', $id);
        $query = $builder->get();
        $data = $query->getResult();

        $radiusGroup = [
            'username' => $data[0]->hospname,
            'groupname' => 'personnel_profile',
            'priority' => '0',
        ];
        $this->db->table($this->raduserGroup)->insert($radiusGroup);
        // return ($radiusGroup);
    }
}
