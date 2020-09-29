<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\MyLibrary;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Libraries\Thaidate;


class Project extends Controller
{

    protected $hrModel, $myLibrary, $projectModel, $thaidate;

    public function __construct()
    {
        $this->myLibrary = new MyLibrary();
        $this->userModel = new UserModel();
        $this->projectModel = new ProjectModel();
        $this->thaidate = new Thaidate();
    }

    public function plan($year = '')
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);
            $data['title'] = 'แผนงาน';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "แผนงานโครงการ" => ""
            ];
            $data['breadcrumb'] = $breadcrumb;


            if ($year != '') {
                $data['planList'] = $this->projectModel->planList($year);
            } else {
                $data['planList'] = $this->projectModel->planList($this->thaidate->fiscalYear(date("Y-m-d")));
            }

            return view('project/plan/index', $data);
        } else {
            return redirect('auth');
        }
    }

    public function addPlan()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $_planYear = $this->request->getVar('planYear');
                    $_planName = $this->request->getVar('planName');

                    if (empty(trim($_planYear))) {
                        $json['error']['plan-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($_planName))) {
                        $json['error']['plan-name'] = 'กรุณาระบุชื่อแผนงาน';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'plan_year' => $_planYear,
                            'plan_name' => $_planName,
                            'created' => date("Y-m-d H:i:s"),
                            'created_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $lastId = $this->projectModel->createPlan($data);
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }

                        if (!empty($lastId)) {
                            $sms = array(
                                'msg' => 0,
                                'info' => 'คุณได้ทำการเพิ่มข้อมูลเรียบร้อย',
                            );
                            session()->set($sms);
                        } else {
                            $sms = array(
                                'msg' => 1,
                                'info' => 'ระบบไม่สามารถทำการเพิ่มข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                            );

                            session()->set($sms);
                        }
                    }
                }
            } else {
                $sms = array(
                    'msg' => 1,
                    'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                session()->set($sms);
                $json['access'] = 'denied';
            }
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }
    public function viewPlan()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');

            $data['plan'] = $this->projectModel->getPlan($id);

            return view('project/plan/renderView', $data);
        } else {
            return redirect('auth');
        }
    }
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;