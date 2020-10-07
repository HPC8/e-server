<?php

namespace App\Controllers;

use App\Libraries\Thaidate;
use App\Models\HrModel;
use App\Models\PlanningModel;
use App\Models\PlanningModel\TrainingModel;
use App\Models\UserModel;
use Config\Services;

class Planning extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->hrModel = new HrModel();
        $this->planningModel = new PlanningModel();
        $this->thaidate = new Thaidate();
    }
    public function training()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['title'] = 'ขออนุมัติไปราชการ';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "ขออนุมัติไปราชการ" => "",
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
                "ขออนุมัติไปราชการ" => "",
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
            $reportHospcode = $this->request->getVar('hospcode');
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
            if ($startDate > $endDate) {
                $json['error']['startDate'] = 'ช่วงวันที่มีราชการไม่ถูกต้อง';
            }
            if ($startTravel > $endTravel) {
                $json['error']['startTravel'] = 'ช่วงวันที่ขออนุมัติเดินทางไม่ถูกต้อง';
            }

            if (empty($json['error'])) {
                $year = $this->thaidate->fiscalYear(date("Y-m-d"));
                $count = $this->planningModel->countTraining($year);

                $data = [
                    'letter' => $letter,
                    'createDate' => $createDate,
                    'hospcode' => $hospcode,
                    'reportHospcode' => $reportHospcode,
                    'subject' => $subject,
                    'location' => $location,
                    'form' => $form,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'startTravel' => $startTravel,
                    'endTravel' => $endTravel,
                    'trainDoc' => $year . "/" . ($count + 1),
                    'create' => date("Y-m-d H:i:s"),

                ];

                try {
                    $lastId = $this->planningModel->createTraining($data);
                    $json['lastId'] = $lastId;
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

                if (!empty($lastId)) {

                    $data = [
                        'trainID' => $lastId,
                        'hospcode' => $this->request->getVar('userList'),
                        'status' => $this->request->getVar('userStatus'),
                        'doc' => $this->request->getVar('userDoc'),
                        'create' => date("Y-m-d H:i:s"),
                    ];
                    $this->planningModel->insertTrainingUser($data);

                    $data = [
                        'trainID' => $lastId,
                        'allowance' => $this->request->getVar('allowance'),
                        'hotel' => $this->request->getVar('hotel'),
                        'traveling' => $this->request->getVar('traveling'),
                        'oilPrice' => $this->request->getVar('oilPrice'),
                        'otherValues' => $this->request->getVar('otherValues'),
                        'create' => date("Y-m-d H:i:s"),
                    ];
                    $this->planningModel->insertTrainingExpenses($data);
                    $sms = array(
                        'msg' => 0,
                        'info' => 'คุณได้ทำการบันข้อมูลเรียบร้อย',
                    );
                    session()->set($sms);
                } else {
                    $sms = array(
                        'msg' => 1,
                        'info' => 'ระบบไม่สามารถทำการบันข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    session()->set($sms);
                }
            }

            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function trainingEdit($id = '')
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['title'] = 'ขออนุมัติไปราชการ';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "ขออนุมัติไปราชการ" => "",
            ];

            $data['breadcrumb'] = $breadcrumb;
            $data['userList'] = $this->hrModel->getListings();
            $data['trainingInfo'] = $this->planningModel->getTraining($id);
            $data['trainingReport'] = $this->planningModel->trainingReport($id);
            $data['trainingUser'] = $this->planningModel->trainingUser($id);
            $data['trainingExpenses'] = $this->planningModel->trainingExpenses($id);
            $data['trainingStatus'] = $this->planningModel->trainingStatus();

            if (!empty($data['trainingInfo'])) {
                if ($data['trainingInfo']['trainStatus'] == "1") {
                    if ($data['trainingInfo']['hospcode'] == $data['user']['hospcode']) {
                        return view('planning/training/edit', $data);
                    } else {
                        $sms = array(
                            'msg' => 1,
                            'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        session()->set($sms);
                        return redirect()->to(base_url('planning/training'));
                    }
                } else {
                    $sms = array(
                        'msg' => 1,
                        'info' => 'ใบงานนี้อยู่ระหว่างรอดำเนินการ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    session()->set($sms);
                    return redirect()->to(base_url('planning/training'));
                }
            }
        } else {
            return redirect('auth');
        }
    }

    public function trainingAddUser()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));

            $trainId = $this->request->getVar('trainId');
            $userList = $this->request->getVar('userList');
            $status = $this->request->getVar('status');
            $doc = $this->request->getVar('doc');
            $checkUser = $this->planningModel->trainingCheckUser($trainId, $userList);

            if (empty(trim($userList))) {
                $json['error']['userList'] = 'กรุณาระบุชื่อผู้ไปราชการ';
            }
            if (!empty($checkUser)) {
                $json['error']['userList'] = 'มีรายชื่อผู้ไปราชการแล้ว ไม่สามารถใส่ซ้ำได้!';
            }
            if (empty(trim($status))) {
                $json['error']['status'] = 'กรุณาระบุสถานะ';
            }

            if (empty($json['error'])) {
                $data = [
                    'trainID' => $trainId,
                    'hospcode' => $userList,
                    'status' => $status,
                    'doc' => $doc,
                    'create' => date("Y-m-d H:i:s"),
                ];

                try {
                    $lastId = $this->planningModel->trainingCreateUser($data);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }

            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function trainingTrashUser()
    {
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $this->planningModel->trainingDeleteUser($id);
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function trainingUpdate()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $trainId = $this->request->getVar('trainId');
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
            if ($startDate > $endDate) {
                $json['error']['startDate'] = 'ช่วงวันที่มีราชการไม่ถูกต้อง';
            }
            if ($startTravel > $endTravel) {
                $json['error']['startTravel'] = 'ช่วงวันที่ขออนุมัติเดินทางไม่ถูกต้อง';
            }

            if (empty($json['error'])) {
                $data = [
                    'letter' => $letter,
                    'createDate' => $createDate,
                    'hospcode' => $hospcode,
                    'reportHospcode' => $reportHospcode,
                    'subject' => $subject,
                    'location' => $location,
                    'form' => $form,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'startTravel' => $startTravel,
                    'endTravel' => $endTravel,
                    'modified' => date("Y-m-d H:i:s"),
                ];

                try {
                    $query = $this->planningModel->trainingUpdate($data, $trainId);
                    $json['trainId'] = $trainId;
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

                if (!empty($query)) {

                    $data = [
                        'allowance' => $this->request->getVar('allowance'),
                        'hotel' => $this->request->getVar('hotel'),
                        'traveling' => $this->request->getVar('traveling'),
                        'oilPrice' => $this->request->getVar('oilPrice'),
                        'otherValues' => $this->request->getVar('otherValues'),
                        'modified' => date("Y-m-d H:i:s"),
                    ];
                    $this->planningModel->trainingExpensesUpdate($data, $trainId);
                    $sms = array(
                        'msg' => 0,
                        'info' => 'คุณได้ทำการบันข้อมูลเรียบร้อย',
                    );
                    session()->set($sms);
                } else {
                    $sms = array(
                        'msg' => 1,
                        'info' => 'ระบบไม่สามารถทำการบันข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    session()->set($sms);
                }
            }

            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function trainingConfirm()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $trainId = $this->request->getVar('trainId');

            $data = [
                'trainStatus' => '2',
                'modified' => date("Y-m-d H:i:s"),
            ];

            try {
                $query = $this->planningModel->trainingUpdate($data, $trainId);
                $json['trainId'] = $trainId;
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            if (!empty($query)) {
                $sms = array(
                    'msg' => 0,
                    'info' => 'คุณได้ทำการยืนยันข้อมูลเรียบร้อย',
                );
                session()->set($sms);
            } else {
                $sms = array(
                    'msg' => 1,
                    'info' => 'ระบบไม่สามารถทำการยืนยันข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                session()->set($sms);
            }

            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function ajaxTraining()
    {
        $request = Services::request();
        $training = new TrainingModel($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $training->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $rs) {
                $no++;
                $row = [];
                $row[] = $rs->trainDoc;
                $row[] = $rs->subject;
                $row[] = $this->thaidate->rangeDate($rs->startTravel, $rs->endTravel);
                $row[] = $rs->label;
                $row[] = $rs->location . ' ' . $rs->form;
                $row[] = $rs->title_hospcode . $rs->first_hospcode . ' ' . $rs->first_hospcode;
                $row[] = $this->thaidate->dateFullmonth($rs->createDate);
                $row[] = "<div class='action-buttons'>
        					<a class='text-blue mx-1' href='$rs->trainID'>
          						<i class='fa fa-search-plus text-105'></i>
       						</a>
        					<a class='text-success mx-1' href='planning/trainingEdit/$rs->trainID'>
          						<i class='fa fa-pencil-alt text-105'></i>
        					</a>
        					<a class='text-danger-m1 mx-1' href='$rs->trainID'>
          						<i class='fa fa-trash-alt text-105'></i>
        					</a>
      					</div>";
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $training->count_all(),
                "recordsFiltered" => $training->count_filtered(),
                "data" => $data,
            ];
            echo json_encode($output);
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
                "ขออนุมัติจัดประชุม" => "",
            ];

            $data['breadcrumb'] = $breadcrumb;

            return view('planning/meeting/index', $data);
        } else {
            return redirect('auth');
        }
    }

    public function demo()
    {
        $start = '2020-10-04';
        $end = '2020-01-12';

        echo $this->thaidate->rangeDate($start, $end);
        // $start = '2020-10-04';
        // $end = '2021-01-12';
        // //echo $this->thaidate->cutdate($start);

        // if ($this->thaidate->fullmonth($start) == $this->thaidate->fullmonth($end)) {
        //     if ($this->thaidate->cutdate($start) == $this->thaidate->cutdate($end)) {
        //         echo $this->thaidate->shortdate($start);
        //     } else {
        //         echo $this->thaidate->cutdate($start) . ' - ' . $this->thaidate->cutdate($end) . ' ' . $this->thaidate->shortMonthYear($start);
        //     }
        // } elseif ($this->thaidate->yearth($start) == $this->thaidate->yearth($end)) {
        //     echo $this->thaidate->dateShortMonth($start) . ' - ' . $this->thaidate->shortdate($end);
        // } else {
        //     echo $this->thaidate->shortdate($start) . ' - ' . $this->thaidate->shortdate($end);
        // }
    }
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
