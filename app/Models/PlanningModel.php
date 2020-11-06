<?php

namespace App\Models;

use CodeIgniter\Model;


class PlanningModel extends Model
{
    protected $tblTraining = 'tbl_planning_training';
    protected $tblTrainingUser = 'tbl_planning_training_user';
    protected $tblTrainingExpenses = 'tbl_planning_training_expenses';
    protected $tblTrainingMission = 'tbl_planning_training_mission';
    protected $tblMoneyType = 'tbl_money_type';
    protected $tblExpect = 'tbl_planning_training_expect';
    protected $tblAllowance = 'tbl_planning_training_allowance';
    protected $tblPersonType = 'tbl_person_type';
    protected $tblHotel = 'tbl_planning_training_hotel';
    protected $tblRoomType = 'tbl_room_type';
    protected $tblTraveling = 'tbl_planning_training_traveling';

    protected $Employee = 'tbl_employee';
    
    public function countTraining($year)
    {
        $builder = $this->db->table($this->tblTraining);
        $builder->orLike('trainDoc', $year);
        return $builder->countAllResults();
    }

    public function countExpect($year)
    {
        $builder = $this->db->table($this->tblExpect);
        $builder->orLike('expectDoc', $year);
        return $builder->countAllResults();
    }

    public function checkExpect($id)
    {
        $builder = $this->db->table($this->tblExpect);
        $builder->where('trainID', $id);
        return $builder->countAllResults();
    }


    public function createTraining($data)
    {
        $builder = $this->db->table($this->tblTraining);
        $builder->insert($data);
        return $this->insertID();
    }

    public function createExpect($data)
    {
        $builder = $this->db->table($this->tblExpect);
        $builder->insert($data);
        return $this->insertID();
    }

    public function updateExpect($data, $trainId)
    {
        $builder = $this->db->table($this->tblExpect);
        $builder->where('trainId', $trainId);
        $builder->update($data);
        return $this->affectedRows();
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

    public function getExpect($id)
    {
        $builder = $this->db->table($this->tblExpect);
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

    public function createAllowance($data)
    {
        $builder = $this->db->table($this->tblAllowance);
        $builder->insert($data);
        return $this->insertID();
    }

    public function createHotel($data)
    {
        $builder = $this->db->table($this->tblHotel);
        $builder->insert($data);
        return $this->insertID();
    }

    public function createTraveling($data)
    {
        $builder = $this->db->table($this->tblTraveling);
        $builder->insert($data);
        return $this->insertID();
    }

    public function trainingDeleteUser($id)
    {
        $builder = $this->db->table($this->tblTrainingUser);
        $builder->where('id', $id);
        $builder->delete();
    }

    public function deleteAllowance($id)
    {
        $builder = $this->db->table($this->tblAllowance);
        $builder->where('id', $id);
        $builder->delete();
    }

    public function deleteHotel($id)
    {
        $builder = $this->db->table($this->tblHotel);
        $builder->where('id', $id);
        $builder->delete();
    }

    public function deleteTraveling($id)
    {
        $builder = $this->db->table($this->tblTraveling);
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
    public function moneyType()
    {
        $builder = $this->db->table($this->tblMoneyType);
        $query = $builder->get();
        return $query->getResult();
    }

    public function expectAllowance($id)
    {
        $builder = $this->db->table($this->tblAllowance);
        $builder->where('trainID', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function expectHotel($id)
    {
        $builder = $this->db->table($this->tblHotel);
        $builder->where('trainID', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function expectTraveling($id)
    {
        $builder = $this->db->table($this->tblTraveling);
        $builder->where('trainID', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function personType()
    {
        $builder = $this->db->table($this->tblPersonType);
        $query = $builder->get();
        return $query->getResult();
    }  

    public function roomType()
    {
        $builder = $this->db->table($this->tblRoomType);
        $query = $builder->get();
        return $query->getResult();
    }  

    public function getPersonType($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblPersonType);
            $builder->where('id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['name'];
        } else {
            return "";
        }
    }

    public function getRoomType($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblRoomType);
            $builder->where('id', $id);
            $query = $builder->get();
            $data = $query->getRowArray();
            return $data['name'];
        } else {
            return "";
        }
    }
    
}
