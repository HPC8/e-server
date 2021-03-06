<?php

namespace App\Controllers;

use App\Libraries\Thaidate;
use App\Models\HrModel;
use App\Models\PlanningModel;
use App\Models\PlanningModel\TrainingModel;
use App\Models\UserModel;
use App\Models\ProjectModel;
use Config\Services;

class Planning extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->hrModel = new HrModel();
        $this->planningModel = new PlanningModel();
        $this->thaidate = new Thaidate();
        $this->projectModel = new ProjectModel();
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
            $data['admin'] = $this->userModel->adminPlanning($data['user']['hospcode']);
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
                if ($data['trainingInfo']['hospcode'] == $data['user']['hospcode'] and $data['trainingInfo']['trainStatus'] == 1) {
                    return view('planning/training/edit', $data);
                } elseif (!empty($data['admin'])) {
                    if ($data['trainingInfo']['trainStatus'] == 2) {
                        foreach ($data['admin'] as $item) {
                            if ($item->level == 2) {
                                return view('planning/training/finance', $data);
                            }
                        }
                    } elseif ($data['trainingInfo']['trainStatus'] == 3) {
                        foreach ($data['admin'] as $item) {
                            if ($item->level == 3) {
                                $year = $this->thaidate->fiscalYear($data['trainingInfo']['startDate']);
                                $data['planList'] = $this->projectModel->planList($year);
                                return view('planning/training/plan', $data);
                            }
                        }
                    } else {
                        $sms = array(
                            'msg' => 1,
                            'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        session()->set($sms);
                        return redirect('training');
                    }
                } else {
                    $sms = array(
                        'msg' => 1,
                        'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    session()->set($sms);
                    return redirect('training');
                }
            } else {
                $sms = array(
                    'msg' => 1,
                    'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!2',
                );
                session()->set($sms);
                return redirect('training');
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

    public function expectAllowance()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));

            $trainId = $this->request->getVar('trainId');
            $personType = $this->request->getVar('personType');
            $peopleNumber = $this->request->getVar('peopleNumber');
            $dayNumber = $this->request->getVar('dayNumber');
            $price = $this->request->getVar('price');

            if (empty(trim($personType))) {
                $json['error']['personType'] = 'กรุณาระบุประเภทบุคคล';
            }
            if (empty(trim($peopleNumber))) {
                $json['error']['peopleNumber'] = 'กรุณาระบุจำนวนคน';
            }
            if (empty(trim($dayNumber))) {
                $json['error']['dayNumber'] = 'กรุณาระบุจำนวนวัน';
            }
            if (empty(trim($price))) {
                $json['error']['price'] = 'กรุณาระบุวันละ';
            }

            if (empty($json['error'])) {
                $data = [
                    'trainID' => $trainId,
                    'personType' => $personType,
                    'peopleNumber' => $peopleNumber,
                    'dayNumber' => $dayNumber,
                    'price' => $price,
                ];

                try {
                    $lastId = $this->planningModel->createAllowance($data);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function expectHotel()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));

            $trainId = $this->request->getVar('trainId');
            $roomType = $this->request->getVar('roomType');
            $roomNumber = $this->request->getVar('roomNumber');
            $dayNumber = $this->request->getVar('dayNumber');
            $price = $this->request->getVar('price');

            if (empty(trim($roomType))) {
                $json['error']['roomType'] = 'กรุณาระบุประเภทห้อง';
            }
            if (empty(trim($roomNumber))) {
                $json['error']['roomNumber'] = 'กรุณาระบุจำนวนห้อง';
            }
            if (empty(trim($dayNumber))) {
                $json['error']['dayNumber'] = 'กรุณาระบุจำนวนวัน';
            }
            if (empty(trim($price))) {
                $json['error']['price'] = 'กรุณาระบุวันละ';
            }

            if (empty($json['error'])) {
                $data = [
                    'trainID' => $trainId,
                    'roomType' => $roomType,
                    'roomNumber' => $roomNumber,
                    'dayNumber' => $dayNumber,
                    'price' => $price,
                ];

                try {
                    $lastId = $this->planningModel->createHotel($data);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function expectTraveling()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));

            $trainId = $this->request->getVar('trainId');
            $personType = $this->request->getVar('personType');
            $peopleNumber = $this->request->getVar('peopleNumber');
            $price = $this->request->getVar('price');

            if (empty(trim($personType))) {
                $json['error']['personType'] = 'กรุณาระบุประเภทบุคคล';
            }
            if (empty(trim($peopleNumber))) {
                $json['error']['peopleNumber'] = 'กรุณาระบุจำนวนคน';
            }
            if (empty(trim($price))) {
                $json['error']['price'] = 'กรุณาระบุจำนวนเงิน';
            }

            if (empty($json['error'])) {
                $data = [
                    'trainID' => $trainId,
                    'personType' => $personType,
                    'peopleNumber' => $peopleNumber,
                    'price' => $price,
                ];

                try {
                    $lastId = $this->planningModel->createTraveling($data);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
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

    public function getProduct()
    {
        $json = [];
        $json = $this->projectModel->selectProduct($this->request->getVar('planID'));
        echo json_encode($json);
    }

    public function getActivity()
    {
        $json = [];
        $json = $this->projectModel->selectActivity($this->request->getVar('productID'));
        echo json_encode($json);
    }
    public function getProgram()
    {
        $json = [];
        $json = $this->projectModel->selectProgram($this->request->getVar('productID'));
        echo json_encode($json);
    }
    // public function getProgram()
    // {
    //     $json = [];
    //     $json = $this->projectModel->selectProgram($this->request->getVar('activityID'));
    //     echo json_encode($json);
    // }

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
    public function trainingExpect($id = '')
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminPlanning($data['user']['hospcode']);
            $data['title'] = 'ขออนุมัติไปราชการ';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "ขออนุมัติไปราชการ" => "/e-service/public/planning/trainingEdit/$id",
                "การยืมเงิน" => "",
            ];

            $data['breadcrumb'] = $breadcrumb;
            $data['thaidate'] = $this->thaidate;
            $data['trainingInfo'] = $this->planningModel->getTraining($id);
            $data['trainingReport'] = $this->planningModel->trainingReport($id);
            $data['moneyType'] = $this->planningModel->moneyType();
            $data['expectInfo'] = $this->planningModel->getExpect($id);
            $data['personType'] = $this->planningModel->personType();
            $data['allowance'] = $this->planningModel->expectAllowance($id);
            $data['hotel'] = $this->planningModel->expectHotel($id);
            $data['roomType'] = $this->planningModel->roomType();
            $data['traveling'] = $this->planningModel->expectTraveling($id);

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // exit;

            return view('planning/training/expect', $data);
        }
    }

    public function expectAdd()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $trainId = $this->request->getVar('trainId');
            $loanNo = $this->request->getVar('loanNo');
            $moneyNo = $this->request->getVar('moneyNo');
            $moneyDate = $this->request->getVar('moneyDate');
            $borrower = $this->request->getVar('borrower');
            $moneyType = $this->request->getVar('moneyType');

            if (empty(trim($loanNo))) {
                $json['error']['loanNo'] = 'กรุณาระบุเลขที่ใบยืม';
            }
            if (empty(trim($moneyNo))) {
                $json['error']['moneyNo'] = 'กรุณาระบุเงินทดลองราชการเลขที่ ';
            }
            if (empty(trim($moneyDate))) {
                $json['error']['moneyDate'] = 'กรุณาระบุวันที่ยืมเงิน';
            }
            if (empty(trim($borrower))) {
                $json['error']['borrower'] = 'กรุณาระบุผู้ยืมเงิน';
            }
            if (empty(trim($moneyType))) {
                $json['error']['moneyType'] = 'กรุณาระบุประเภทเงินยืม';
            }

            if (empty($json['error'])) {
                $year = $this->thaidate->fiscalYear(date("Y-m-d"));
                $count = $this->planningModel->countExpect($year);

                $data = [
                    'trainId' => $trainId,
                    'loanNo' => $loanNo,
                    'moneyNo' => $moneyNo,
                    'moneyDate' => $moneyDate,
                    'borrower' => $borrower,
                    'moneyType' => $moneyType,
                    'expectDoc' => $year . "/" . ($count + 1),
                    'update' => date("Y-m-d H:i:s"),
                    'expectStatus' => '1',

                ];

                try {
                    $checkExpect = $this->planningModel->checkExpect($trainId);
                    if ($checkExpect == 0) {
                        $lastId = $this->planningModel->createExpect($data);
                    } else {
                        $lastId = $this->planningModel->updateExpect($data, $trainId);
                    }
                    $json['trainId'] = $trainId;
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

                if (!empty($lastId)) {

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

    public function trashAllowance()
    {
        $json = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $this->planningModel->deleteAllowance($id);
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function trashHotel()
    {
        $json = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $this->planningModel->deleteHotel($id);
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function trashTraveling()
    {
        $json = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $this->planningModel->deleteTraveling($id);
            echo json_encode($json);
        } else {
            return redirect('auth');
        }
    }

    public function demo()
    {
        $id = '10007';

        $data['admin'] = $this->userModel->adminPlanning($id);

        foreach ($data['admin'] as $row) {
            if ($row->hospcode == $id and $row->level == '2') {
                echo $row->level;
            }
        }


        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;