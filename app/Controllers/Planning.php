<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\HrModel;

class Planning extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->hrModel = new HrModel();
    }
    public function training()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['title'] = 'ขออนุมัติไปราชการ';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "ขออนุมัติไปราชการ" => ""
            ];

            $data['breadcrumb'] = $breadcrumb;

            return view('planning/training/index', $data);
        } else {
            return redirect('auth');
        }
    }

    public function trainingCreate()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['title'] = 'ขออนุมัติไปราชการ';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "ขออนุมัติไปราชการ" => ""
            ];

            $data['breadcrumb'] = $breadcrumb;
            $data['userList'] = $this->hrModel->getListings();
            return view('planning/training/create', $data);
        } else {
            return redirect('auth');
        }
    }

    public function trainingAdd()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));

            $letter = $this->request->getVar('letter');
            $createDate = $this->request->getVar('createDate');
            $hospcode = $this->request->getVar('hospcode');
            $reportHospcode = $this->request->getVar('reportHospcode');
            $subject = $this->request->getVar('subject');
            $location = $this->request->getVar('location');
            $form = $this->request->getVar('form');
            $startDate = $this->request->getVar('startDate');
            $endDate = $this->request->getVar('endDate');
            $startTravel = $this->request->getVar('startTravel');
            $endTravel = $this->request->getVar('endTravel');


            if (empty(trim($letter))) {
                $json['error']['letter'] = 'กรุณาระบุเลขที่หนังสือขออนุมัติ';
            }
            if (empty(trim($createDate))) {
                $json['error']['createDate'] = 'กรุณาระบุวันที่ขออนุมัติ';
            }
            if (empty(trim($subject))) {
                $json['error']['subject'] = 'กรุณาระบุข้อมูล ';
            }
            if (empty(trim($location))) {
                $json['error']['location'] = 'กรุณาระบุข้อมูล ';
            }
            if (empty(trim($form))) {
                $json['error']['form'] = 'กรุณาระบุข้อมูล ';
            }
            if (empty(trim($startDate))) {
                $json['error']['startDate'] = 'กรุณาระบุช่วงวันที่มีราชการ';
            }
            if (empty(trim($endDate))) {
                $json['error']['startDate'] = 'กรุณาระบุช่วงวันที่มีราชการ';
            }
            if (empty(trim($startTravel))) {
                $json['error']['startTravel'] = 'กรุณาระบุช่วงวันที่ขออนุมัติเดินทาง';
            }
            if (empty(trim($endTravel))) {
                $json['error']['startTravel'] = 'กรุณาระบุช่วงวันที่ขออนุมัติเดินทาง';
            }


            // $data = [
            //     'plan_year' => $planYear,
            //     'plan_name' => $planName,
            //     'created' => date("Y-m-d H:i:s"),
            //     'created_code' => $data['user']['hospcode'],
            // ];

            try {
                // $lastId = $this->projectModel->createPlan($data);
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            // if (!empty($lastId)) {
            //     $sms = array(
            //         'msg' => 0,
            //         'info' => 'คุณได้ทำการเพิ่มข้อมูลเรียบร้อย',
            //     );
            //     session()->set($sms);
            // } else {
            //     $sms = array(
            //         'msg' => 1,
            //         'info' => 'ระบบไม่สามารถทำการเพิ่มข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
            //     );

            //     session()->set($sms);
            // }



            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function meeting()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['title'] = 'ขออนุมัติจัดประชุม';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "ขออนุมัติจัดประชุม" => ""
            ];

            $data['breadcrumb'] = $breadcrumb;

            return view('planning/meeting/index', $data);
        } else {
            return redirect('auth');
        }
    }
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
