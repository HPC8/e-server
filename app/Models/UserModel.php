<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $_employee = 'view_tbl_employee';
    protected $_adminHr = 'tbl_user_hr';
    protected $_adminProject = 'tbl_user_project';
    protected $_adminPlanning = 'tbl_user_planning';
    

    public function checkCode($id)
    {
        $builder = $this->db->table($this->_employee);
        $builder->where('hospcode', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function checkEmail($id)
    {
        $builder = $this->db->table($this->_employee);
        $builder->where('email', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function checkUser($id)
    {
        $builder = $this->db->table($this->_employee);
        $builder->where('hospname', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getUser($id)
    {
        $builder = $this->db->table($this->_employee);
        $builder->where('emp_id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function adminHr($id)
    {
        $builder = $this->db->table($this->_adminHr);
        $builder->where('hospcode', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function adminProject($id)
    {
        $builder = $this->db->table($this->_adminProject);
        $builder->where('hospcode', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getUsername($hospcode)
    {
        if ($hospcode != '') {
            $builder = $this->db->table($this->_employee);
            $builder->where('hospcode', $hospcode);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['titlename'] . $data['firstname'] . ' ' . $data['lastname'];
        } else {
            return "";
        }
    }
    public function getHospcode($hospcode)
    {
        $builder = $this->db->table($this->_employee);
        $builder->where('hospcode', $hospcode);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function adminPlanning($id)
    {
        $builder = $this->db->table($this->_adminPlanning);
        $builder->where('hospcode', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
