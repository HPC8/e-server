<?php

namespace App\Models;

use CodeIgniter\Model;


class ProjectModel extends Model
{
    protected $tblPlan = 'tbl_project_plan';
    protected $tblProduct = 'tbl_project_product';
    protected $tblActivity = 'tbl_project_activity';
    protected $tblProgram = 'tbl_project_program';


    public function planList($year)
    {
        $builder = $this->db->table($this->tblPlan);
        $builder->where('plan_year', $year);
        $builder->where('plan_status', 1);
        $builder->orderBy('plan_id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
    public function createPlan($data)
    {
        // $this->db->table($this->tblPlan)->insert($data);
        // return $this->insertID();

        $builder = $this->db->table($this->tblPlan);
        $builder->insert($data);
        return $this->insertID();
    }
    public function getPlan($id)
    {
        $builder = $this->db->table($this->tblPlan);
        $builder->where('plan_id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updatePlan($data, $id)
    {
        $builder = $this->db->table($this->tblPlan);
        $builder->where('plan_id', $id);
        $builder->update($data);
        return $this->affectedRows();
    }

    public function productList($year)
    {
        $builder = $this->db->table($this->tblProduct);
        $builder->where('product_year', $year);
        $builder->where('product_status', 1);
        $builder->orderBy('plan_id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function createProduct($data)
    {
        $builder = $this->db->table($this->tblProduct);
        $builder->insert($data);
        return $this->insertID();
    }

    public function getProduct($id)
    {
        $builder = $this->db->table($this->tblProduct);
        $builder->where('product_id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function updateProduct($data, $id)
    {
        $builder = $this->db->table($this->tblProduct);
        $builder->where('product_id', $id);
        $builder->update($data);
        return $this->affectedRows();
    }

    public function activityList($year)
    {
        $builder = $this->db->table($this->tblActivity);
        $builder->where('activity_year', $year);
        $builder->where('activity_status', 1);
        $builder->orderBy('activity_id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function createActivity($data)
    {
        $builder = $this->db->table($this->tblActivity);
        $builder->insert($data);
        return $this->insertID();
    }

    public function getActivity($id)
    {
        $builder = $this->db->table($this->tblActivity);
        $builder->where('activity_id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function planName($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblPlan);
            $builder->where('plan_id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['plan_name'];
        } else {
            return "";
        }
    }
    public function productName($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblProduct);
            $builder->where('product_id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['product_name'];
        } else {
            return "";
        }
    }
    public function productId($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblProduct);
            $builder->where('product_id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['plan_id'];
        } else {
            return "";
        }
    }

    public function activityId($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblActivity);
            $builder->where('activity_id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['product_id'];
        } else {
            return "";
        }
    }

    public function activityName($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblActivity);
            $builder->where('activity_id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['activity_name'];
        } else {
            return "";
        }
    }
    public function updateActivity($data, $id)
    {
        $builder = $this->db->table($this->tblActivity);
        $builder->where('activity_id', $id);
        $builder->update($data);
        return $this->affectedRows();
    }

    public function programList($year)
    {
        $builder = $this->db->table($this->tblProgram);
        $builder->where('program_year', $year);
        $builder->where('program_status', 1);
        // $builder->orderBy('program_id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function createProgram($data)
    {
        $builder = $this->db->table($this->tblProgram);
        $builder->insert($data);
        return $this->insertID();
    }

    public function getProgram($id)
    {
        $builder = $this->db->table($this->tblProgram);
        $builder->where('program_id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function updateProgram($data, $id)
    {
        $builder = $this->db->table($this->tblProgram);
        $builder->where('program_id', $id);
        $builder->update($data);
        return $this->affectedRows();
    }

    public function selectProduct($id)
    {
        $builder = $this->db->table($this->tblProduct);
        $builder->where('plan_id', $id);
        $builder->orderBy('product_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function selectActivity($id)
    {
        $builder = $this->db->table($this->tblActivity);
        $builder->where('product_id', $id);
        $builder->orderBy('activity_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function selectProgram($id)
    {
        $builder = $this->db->table($this->tblProgram);
        $builder->where('activity_id', $id);
        $builder->orderBy('program_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
