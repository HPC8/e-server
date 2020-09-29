<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $_provinces = 'tbl_provinces';
    protected $_amphures = 'tbl_amphures';
    protected $_districts = 'tbl_districts';
    protected $_zipcodes = 'tbl_zipcodes';

    protected $_provincesID, $_amphurID;

    // set provinces id
    public function setProvincesID($ID)
    {
        return $this->_provincesID = $ID;
    }

    // set distric id
    public function setDistrictID($ID)
    {
        return $this->_amphurID = $ID;
    }

    // get provinces method
    public function getProvinces()
    {
        $builder = $this->db->table($this->_provinces);
        $builder->orderBy('province_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // get amphur method
    public function getAmphur()
    {
        $builder = $this->db->table($this->_amphures);
        $builder->where('province_id', $this->_provincesID);
        $builder->orderBy('amphur_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // get distric method
    public function getDistrict()
    {
        $builder = $this->db->table($this->_districts);
        $builder->where('amphur_id', $this->_amphurID);
        $builder->orderBy('district_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // get amphur name method
    public function amphurName($id)
    {
        $builder = $this->db->table($this->_amphures);
        $builder->where('amphur_id', $id);
        $query = $builder->get();
        $data = $query->getRowArray();
        return $data['amphur_name'];
    }

    // get districts name method
    public function districtName($id)
    {
        $builder = $this->db->table($this->_districts);
        $builder->where('district_id', $id);
        $query = $builder->get();
        $data = $query->getRowArray();
        return $data['district_name'];
    }
}
