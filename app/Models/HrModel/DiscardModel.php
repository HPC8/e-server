<?php

namespace App\Models\HrModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DiscardModel extends Model
{
    protected $table = "view_tbl_employee";
    protected $column_order = array('emp_id', 'hospcode', 'titlename', 'firstname', 'lastname', 'position_name', 'level_name', 'department_name', 'status');
    protected $column_search = array('hospcode', 'firstname', 'lastname', 'department_name');
    protected $order = array('emp_id' => 'ASC');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();

                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {

                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $this->dt->where('status', 0);
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->dt->where('status', 0);
        return $this->dt->countAllResults();
    }

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $builder->where('status', 0);
        return $builder->countAllResults();
    }
}
