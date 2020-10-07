<?php

namespace App\Models\PlanningModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TrainingModel extends Model
{
    protected $table = "view_tbl_planning_training";
    protected $column_order = array('trainID', 'letter', 'createDate', 'hospcode', 'reportHospcode', 'subject', 'location', 'form', 'startTravel', 'endTravel', 'title_hospcode', 'first_hospcode', 'last_hospcode', 'title_report', 'first_report', 'last_report', 'trainStatus', 'trainDoc', 'label');
    protected $column_search = array('letter', 'hospcode', 'reportHospcode', 'subject', 'location', 'form', 'startTravel', 'endTravel', 'title_hospcode', 'first_hospcode', 'last_hospcode', 'title_report', 'first_report', 'last_report', 'trainDoc', 'label');
    protected $order = array('trainID' => 'DESC');
    protected $request;
    protected $db;
    protected $dt;

    public function __construct(RequestInterface $request)
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
                if (count($this->column_search) - 1 == $i) {
                    $this->dt->groupEnd();
                }

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
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1) {
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        }

        // $this->dt->where('status', 1);
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        // $this->dt->where('status', 1);
        return $this->dt->countAllResults();
    }

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        // $builder->where('status', 1);
        return $builder->countAllResults();
    }
}
