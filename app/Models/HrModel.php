<?php

namespace App\Models;

use CodeIgniter\Model;


class HrModel extends Model
{
    protected $Employee = 'tbl_employee';
    protected $tblTitlename = 'tbl_titlename';
    protected $tblEmployee = 'view_tbl_employee';
    protected $tblBlood = 'tbl_blood';
    protected $tblEducation = 'tbl_education';
    protected $tblDegree = 'tbl_degree';
    protected $tblCategory = 'tbl_category';
    protected $tblPosition = 'tbl_position';
    protected $tblLevel = 'tbl_level';
    protected $tblDepartment = 'tbl_department';
    protected $tblSection = 'tbl_section';
    protected $retire = 'tbl_retire';


    private $_empId,
        $_addBy,
        $_hospcode,
        $_sex,
        $_marital,
        $_blood,
        $_titlename,
        $_firstname,
        $_lastname,
        $_cid,
        $_birthday,
        $_firstnameEng,
        $_lastnameEng,
        $_email,
        $_address,
        $_province,
        $_amphur,
        $_district,
        $_mobile,
        $_education,
        $_degree,
        $_branch,
        $_positionNo,
        $_startDate,
        $_stopDate,
        $_accountNo,
        $_salary,
        $_category,
        $_position,
        $_level,
        $_department,
        $_section,
        $_hospname,
        $_updateBy,
        $_passwd,

        $_gpa,
        $_path,
        $_upload,

        $_retire,
        $_retireDate,
        $_retireDetail,
        $_discardDoc,
        $_note;

    public function setEmpId($empId)
    {
        $this->_empId = $empId;
    }
    public function setNote($note)
    {
        $this->_note = $note;
    }
    public function setRetire($retire)
    {
        $this->_retire = $retire;
    }
    public function setRetireDate($date)
    {
        $this->_retireDate = $date;
    }

    public function setRetireDetail($detail)
    {
        $this->_retireDetail = $detail;
    }
    public function setUpdateBy($hospcode)
    {
        $this->_updateBy = $hospcode;
    }
    public function setAddBy($hospcode)
    {
        $this->_addBy = $hospcode;
    }
    public function setHospcode($hospcode)
    {
        $this->_hospcode = $hospcode;
    }
    public function setSex($sex)
    {
        $this->_sex = $sex;
    }
    public function setMarital($marital)
    {
        $this->_marital = $marital;
    }
    public function setBlood($blood)
    {
        $this->_blood = $blood;
    }
    public function setTitlename($titlename)
    {
        $this->_titlename = $titlename;
    }
    public function setFirstname($firstname)
    {
        $this->_firstname = $firstname;
    }
    public function setLastname($lastname)
    {
        $this->_lastname = $lastname;
    }
    public function setCid($cid)
    {
        $this->_cid = $cid;
    }
    public function setBirthday($birthday)
    {
        $this->_birthday = $birthday;
    }
    public function setNameEng($firstnameEng, $lastnameEng)
    {
        $this->_firstnameEng = strtoupper($firstnameEng);
        $this->_lastnameEng = strtoupper($lastnameEng);

        $lastFirst = substr($lastnameEng, 0, 1);

        $this->_hospname = strtolower($firstnameEng . '.' . $lastFirst);
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }
    public function setAddress($address)
    {
        $this->_address = $address;
    }
    public function setProvince($province)
    {
        $this->_province = $province;
    }
    public function setAmphur($amphur)
    {
        $this->_amphur = $amphur;
    }
    public function setDistrict($district)
    {
        $this->_district = $district;
    }
    public function setMobile($mobile)
    {
        $this->_mobile = $mobile;
    }
    public function setEducation($education)
    {
        $this->_education = $education;
    }
    public function setDegree($degree)
    {
        $this->_degree = $degree;
    }
    public function setBranch($branch)
    {
        $this->_branch = $branch;
    }
    public function setPositionNo($positionNo)
    {
        $this->_positionNo = $positionNo;
    }
    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
    }
    public function setStopDate($stopDate)
    {
        $this->_stopDate = $stopDate;
    }
    public function setAccountno($accountNo)
    {
        $this->_accountNo = $accountNo;
    }
    public function setSalary($salary)
    {
        $this->_salary = $salary;
    }
    public function setCategory($category)
    {
        $this->_category = $category;
    }
    public function setPosition($position)
    {
        $this->_position = $position;
    }
    public function setLevel($level)
    {
        $this->_level = $level;
    }
    public function setDepartment($department)
    {
        $this->_department = $department;
    }
    public function setSection($section)
    {
        $this->_section = $section;
    }
    public function setPassword($encrypt)
    {
        $this->_passwd = $encrypt;
    }

    public function hospcodeLast()
    {
        $builder = $this->db->table($this->tblEmployee);
        $builder->selectMax('hospcode');
        $query = $builder->get();
        $data = $query->getRowArray();
        return $data['hospcode'] + 1;
    }

    public function getTitlename()
    {
        $builder = $this->db->table($this->tblTitlename);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getBlood()
    {
        $builder = $this->db->table($this->tblBlood);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getEducation()
    {
        $builder = $this->db->table($this->tblEducation);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDegree()
    {
        $builder = $this->db->table($this->tblDegree);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getCategory($id = '')
    {
        if ($id) {
            $builder = $this->db->table($this->tblCategory);
            $builder->where('category_id', $id);
            $query = $builder->get();
            return $query->getResult();
        } else {
            $builder = $this->db->table($this->tblCategory);
            $query = $builder->get();
            return $query->getResult();
        }
    }

    public function getPosition()
    {
        $builder = $this->db->table($this->tblPosition);
        $builder->orderBy('position_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getLevel()
    {
        $builder = $this->db->table($this->tblLevel);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getDepartment()
    {
        $builder = $this->db->table($this->tblDepartment);
        $builder->orderBy('department_letter', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getSection()
    {
        $builder = $this->db->table($this->tblSection);
        $builder->orderBy('section_name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getAge()
    {
        $builder = $this->db->table($this->tblEmployee);
        $builder->where('status', 1);
        $builder->select('birthday');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getListings()
    {
        $builder = $this->db->table($this->tblEmployee);
        $builder->where('status', 1);
        $builder->orderBy('titlename', 'ASC')->orderBy('firstname', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    function countEmp($id)
    {
        if ($id != '') {
            $builder = $this->db->table($this->tblEmployee);
            $builder->where('status', 1);
            $builder->where('category_id', $id);
            echo $builder->countAllResults();
        } elseif ($id == '0') {
            $builder = $this->db->table($this->tblEmployee);
            $builder->where('status', 0);
            echo $builder->countAllResults();
        } else {
            $builder = $this->db->table($this->tblEmployee);
            $builder->where('status', 1);
            echo $builder->countAllResults();
        }
    }
    function pieCategory()
    {

        $builder = $this->db->table('view_emp_count');
        $query = $builder->get();
        return $query->getResult();
    }
    function pieEducation()
    {
        $builder = $this->db->table('view_emp_count_education');
        $query = $builder->get();
        return $query->getResult();
    }
    function pieLavel()
    {
        $builder = $this->db->table('view_emp_count_lavel');
        $query = $builder->get();
        return $query->getResult();
    }

    public function listCategory($id)
    {
        $builder = $this->db->table($this->tblEmployee);
        $builder->where('category_id', $id);
        $builder->where('status', 1);
        $builder->orderBy('titlename', 'ASC')->orderBy('firstname', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function doubleCid($cid)
    {
        $builder = $this->db->table($this->tblEmployee);
        $builder->where('cid', $cid);
        $query = $builder->get();
        $data = $query->getResult();

        if (!empty($data)) {
            return TRUE;
        }
    }

    public function createUsers()
    {
        $data = [
            'hospcode' => $this->_hospcode,
            'titlename' => $this->_titlename,
            'firstname' => $this->_firstname,
            'lastname' => $this->_lastname,
            'lastname_eng' => $this->_firstnameEng,
            'firstname_eng' => $this->_lastnameEng,
            'hospname' => $this->_hospname,
            'sex' => $this->_sex,
            'marital' => $this->_marital,
            'blood' => $this->_blood,
            'position_number' => $this->_positionNo,
            'birthday' => $this->_birthday,
            'cid' => $this->_cid,
            'email' => $this->_email,
            'mobile' => $this->_mobile,
            'address' => $this->_address,
            'province_id' => $this->_province,
            'amphur_id' => $this->_amphur,
            'district_id' => $this->_district,
            'account_number' => $this->_accountNo,
            'salary' => $this->_salary,
            'start_date' => $this->_startDate,
            'stop_date' => $this->_stopDate,
            'education_id' => $this->_education,
            'degree_id' => $this->_degree,
            'branch' => $this->_branch,
            'category_id' => $this->_category,
            'position_id' => $this->_position,
            'level_id' => $this->_level,
            'department_id' => $this->_department,
            'section_id' => $this->_section,
            'passwd' => $this->_passwd,
            'add_by' => $this->_addBy,
            'add_ip' => $_SERVER['REMOTE_ADDR'],
            'add_date' => date("Y-m-d H:i:s"),
        ];

        $this->db->table($this->Employee)->insert($data);
        return $this->insertID();
    }

    public function updateUsers()
    {
        $data = [
            'titlename' => $this->_titlename,
            'firstname' => $this->_firstname,
            'lastname' => $this->_lastname,
            'lastname_eng' => $this->_firstnameEng,
            'firstname_eng' => $this->_lastnameEng,
            'hospname' => $this->_hospname,
            'sex' => $this->_sex,
            'marital' => $this->_marital,
            'blood' => $this->_blood,
            'position_number' => $this->_positionNo,
            'birthday' => $this->_birthday,
            'email' => $this->_email,
            'mobile' => $this->_mobile,
            'address' => $this->_address,
            'province_id' => $this->_province,
            'amphur_id' => $this->_amphur,
            'district_id' => $this->_district,
            'account_number' => $this->_accountNo,
            'salary' => $this->_salary,
            'start_date' => $this->_startDate,
            'stop_date' => $this->_stopDate,
            'education_id' => $this->_education,
            'degree_id' => $this->_degree,
            'branch' => $this->_branch,
            'category_id' => $this->_category,
            'position_id' => $this->_position,
            'level_id' => $this->_level,
            'department_id' => $this->_department,
            'section_id' => $this->_section,
            'note' => $this->_note,
            'edit_by' => $this->_updateBy,
            'edit_ip' => $_SERVER['REMOTE_ADDR'],
            'edit_date' => date("Y-m-d H:i:s"),
        ];


        $builder = $this->db->table($this->Employee);
        $builder->where('hospcode', $this->_hospcode);
        $builder->update($data);
        return $this->_hospcode; // return $this->affectedRows();

    }

    public function getRetire()
    {
        $builder = $this->db->table($this->retire);
        $query = $builder->get();
        return $query->getResult();
    }

    public function transferUsers()
    {
        $data = [
            'status' => 0,
            'retire_id' => $this->_retire,
            'discard_detail' => $this->_retireDetail,
            'discard_date' => $this->_retireDate,
            'discard_by' => $this->_updateBy,
            'discard_ip' => $_SERVER['REMOTE_ADDR'],
            'discard_bydate' => date("Y-m-d H:i:s"),
        ];

        $builder = $this->db->table($this->Employee);
        $builder->where('hospcode', $this->_hospcode);
        $builder->update($data);
        return $this->_hospcode; // return $this->affectedRows();
    }

    public function resetPasswd($passwd, $hospcode)
    {
        $builder = $this->db->table($this->Employee);
        $builder->where('hospcode', $hospcode);
        $builder->update($passwd);
        return $this->affectedRows();
    }

    public function userUpdate($data, $hospcode)
    {
        $builder = $this->db->table($this->Employee);
        $builder->where('hospcode', $hospcode);
        $builder->update($data);
        return $this->affectedRows();
    }
}
