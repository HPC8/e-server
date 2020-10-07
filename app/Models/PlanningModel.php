<?php

namespace App\Models;

use CodeIgniter\Model;


class PlanningModel extends Model
{
    protected $tblTraining = 'tbl_planning_training';
    protected $tblTrainingUser = 'tbl_planning_training_user';
    protected $tblTrainingExpenses = 'tbl_planning_training_expenses';
    protected $tblTrainingMission = 'tbl_planning_training_mission';
    protected $Employee = 'tbl_employee';

    public function countTraining($year)
    {
        $builder = $this->db->table($this->tblTraining);
        $builder->orLike('trainDoc', $year);
        return $builder->countAllResults();
    }

    public function createTraining($data)
    {
        $builder = $this->db->table($this->tblTraining);
        $builder->insert($data);
        return $this->insertID();
    }

    public function insertTrainingUser($data)
    {
        $this->db->table($this->tblTrainingUser)->insert($data);
        return TRUE;
    }

    public function insertTrainingExpenses($data)
    {
        $this->db->table($this->tblTrainingExpenses)->insert($data);
        return TRUE;
    }

    public function getTraining($id)
    {
        $builder = $this->db->table($this->tblTraining);
        $builder->where('trainID', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function trainingReport($id)
    {
        $builder = $this->db->table($this->tblTrainingUser);
        $builder->select('*');
        $builder->join($this->Employee, $this->Employee . '.hospcode = ' . $this->tblTrainingUser . '.hospcode', 'left');
        $builder->where($this->tblTrainingUser . '.trainID =', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function trainingUser($id)
    {
        $builder = $this->db->table($this->tblTrainingUser);
        $builder->where('trainID', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function trainingExpenses($id)
    {
        $builder = $this->db->table($this->tblTrainingExpenses);
        $builder->where('trainID', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function trainingStatus()
    {
        $builder = $this->db->table($this->tblTrainingMission);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getMission($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblTrainingMission);
            $builder->where('id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['name'];
        } else {
            return "";
        }
    }

    public function trainingCheckUser($id, $hospcode)
    {
        $builder = $this->db->table($this->tblTrainingUser);
        $builder->where('trainID', $id);
        $builder->where('hospcode', $hospcode);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function trainingCreateUser($data)
    {
        $builder = $this->db->table($this->tblTrainingUser);
        $builder->insert($data);
        return $this->insertID();
    }

    public function trainingDeleteUser($id)
    {
        $builder = $this->db->table($this->tblTrainingUser);
        $builder->where('id', $id);
        $builder->delete();
    }

    public function trainingUpdate($data, $trainId)
    {
        $builder = $this->db->table($this->tblTraining);
        $builder->where('trainId', $trainId);
        $builder->update($data);
        return $this->affectedRows();
    }

    public function trainingExpensesUpdate($data, $trainId)
    {
        $builder = $this->db->table($this->tblTrainingExpenses);
        $builder->where('trainId', $trainId);
        $builder->update($data);
        return $this->affectedRows();
    }
}
