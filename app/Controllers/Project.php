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
                "แผนงานและโครงการ" => ""
            ];
            $data['breadcrumb'] = $breadcrumb;
            if ($year == '') {
                $year = $this->thaidate->fiscalYear(date("Y-m-d"));
            }
            $data['planList'] = $this->projectModel->planList($year);

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
                    $planYear = $this->request->getVar('planYear');
                    $planName = $this->request->getVar('planName');

                    if (empty(trim($planYear))) {
                        $json['error']['plan-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($planName))) {
                        $json['error']['plan-name'] = 'กรุณาระบุชื่อแผนงาน';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'plan_year' => $planYear,
                            'plan_name' => $planName,
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

    public function editPlan()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');

            $data['plan'] = $this->projectModel->getPlan($id);
            return view('project/plan/renderEdit', $data);
        } else {
            return redirect('auth');
        }
    }

    public function updatePlan()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('planId');
                    $planYear = $this->request->getVar('planYear');
                    $planName = $this->request->getVar('planName');

                    if (empty(trim($planYear))) {
                        $json['error']['plan-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($planName))) {
                        $json['error']['plan-name'] = 'กรุณาระบุชื่อแผนงาน';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'plan_year' => $planYear,
                            'plan_name' => $planName,
                            'modified' => date("Y-m-d H:i:s"),
                            'modified_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $query = $this->projectModel->updatePlan($data, $id);
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }

                        if (!empty($query)) {
                            $sms = array(
                                'msg' => 0,
                                'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                            );
                            session()->set($sms);
                        } else {
                            $sms = array(
                                'msg' => 1,
                                'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
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

    public function trashPlan()
    {
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('id');

                    $data = [
                        'plan_status' => '0',
                        'modified' => date("Y-m-d H:i:s"),
                        'modified_code' => $data['user']['hospcode'],
                    ];

                    try {
                        $query = $this->projectModel->updatePlan($data, $id);
                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }

                    if (!empty($query)) {
                        $sms = array(
                            'msg' => 0,
                            'info' => 'คุณได้ทำการยกเลิกข้อมูลเรียบร้อย',
                        );
                        session()->set($sms);
                    } else {
                        $sms = array(
                            'msg' => 1,
                            'info' => 'ระบบไม่สามารถทำการยกเลิกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        session()->set($sms);
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

    public function product($year = '')
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);
            $data['title'] = 'ผลผลิต';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "แผนงานและโครงการ" => ""
            ];
            $data['breadcrumb'] = $breadcrumb;

            if ($year == '') {
                $year = $this->thaidate->fiscalYear(date("Y-m-d"));
            }

            $data['planList'] = $this->projectModel->planList($year);
            $data['productList'] = $this->projectModel->productList($year);

            return view('project/product/index', $data);
        } else {
            return redirect('auth');
        }
    }

    public function addProduct()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $planId = $this->request->getVar('productPlanId');
                    $productYear = $this->request->getVar('productYear');
                    $productName = $this->request->getVar('productName');

                    if (empty(trim($planId))) {
                        $json['error']['product-PlanId'] = 'กรุณาเลือกแผนงาน';
                    }
                    if (empty(trim($productYear))) {
                        $json['error']['product-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($productName))) {
                        $json['error']['product-name'] = 'กรุณาระบุชื่อผลผลิต';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'plan_id' => $planId,
                            'product_year' => $productYear,
                            'product_name' => $productName,
                            'created' => date("Y-m-d H:i:s"),
                            'created_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $lastId = $this->projectModel->createProduct($data);
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

    public function viewProduct()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');

            $data['product'] = $this->projectModel->getProduct($id);
            return view('project/product/renderView', $data);
        } else {
            return redirect('auth');
        }
    }

    public function editProduct()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $year = $this->request->getVar('year');

            $data['planList'] = $this->projectModel->planList($year);
            $data['product'] = $this->projectModel->getProduct($id);

            return view('project/product/renderEdit', $data);
        } else {
            return redirect('auth');
        }
    }

    public function updateProduct()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('productId');
                    $productYear = $this->request->getVar('productYear');
                    $productName = $this->request->getVar('productName');
                    $planId = $this->request->getVar('planId');

                    if (empty(trim($productYear))) {
                        $json['error']['product-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($planId))) {
                        $json['error']['product-name'] = 'กรุณาระบุชื่อแผนงาน';
                    }
                    if (empty(trim($productName))) {
                        $json['error']['product-planId'] = 'กรุณาเลือกแผนงาน';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'plan_id' => $planId,
                            'product_year' => $productYear,
                            'product_name' => $productName,
                            'modified' => date("Y-m-d H:i:s"),
                            'modified_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $query = $this->projectModel->updateProduct($data, $id);
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }

                        if (!empty($query)) {
                            $sms = array(
                                'msg' => 0,
                                'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                            );
                            session()->set($sms);
                        } else {
                            $sms = array(
                                'msg' => 1,
                                'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
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

    public function trashProduct()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('id');

                    $data = [
                        'product_status' => '0',
                        'modified' => date("Y-m-d H:i:s"),
                        'modified_code' => $data['user']['hospcode'],
                    ];

                    try {
                        $query = $this->projectModel->updateProduct($data, $id);
                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }

                    if (!empty($query)) {
                        $sms = array(
                            'msg' => 0,
                            'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                        );
                        session()->set($sms);
                    } else {
                        $sms = array(
                            'msg' => 1,
                            'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        session()->set($sms);
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

    public function activity($year = '')
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);
            $data['title'] = 'กิจกรรม';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "แผนงานและโครงการ" => ""
            ];
            $data['breadcrumb'] = $breadcrumb;

            if ($year == '') {
                $year = $this->thaidate->fiscalYear(date("Y-m-d"));
            }

            // $data['planList'] = $this->projectModel->planList($year);
            $data['productList'] = $this->projectModel->productList($year);
            $data['activityList'] = $this->projectModel->activityList($year);

            return view('project/activity/index', $data);
        } else {
            return redirect('auth');
        }
    }

    public function addActivity()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $productId = $this->request->getVar('activityProductId');
                    $activityYear = $this->request->getVar('activityYear');
                    $activityName = $this->request->getVar('activityName');

                    if (empty(trim($productId))) {
                        $json['error']['activity-ProductId'] = 'กรุณาเลือกผลผลิต';
                    }
                    if (empty(trim($activityYear))) {
                        $json['error']['activity-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($activityName))) {
                        $json['error']['activity-name'] = 'กรุณาระบุชื่อกิจกรรม';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'product_id' => $productId,
                            'activity_year' => $activityYear,
                            'activity_name' => $activityName,
                            'created' => date("Y-m-d H:i:s"),
                            'created_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $lastId = $this->projectModel->createActivity($data);
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

    public function viewActivity()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');

            $data['activity'] = $this->projectModel->getActivity($id);
            return view('project/activity/renderView', $data);
        } else {
            return redirect('auth');
        }
    }

    public function editActivity()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $year = $this->request->getVar('year');

            $data['productList'] = $this->projectModel->productList($year);
            $data['activity'] = $this->projectModel->getActivity($id);

            return view('project/activity/renderEdit', $data);
        } else {
            return redirect('auth');
        }
    }

    public function updateActivity()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('activityId');
                    $productId = $this->request->getVar('activityProductId');
                    $activityYear = $this->request->getVar('activityYear');
                    $activityName = $this->request->getVar('activityName');

                    if (empty(trim($productId))) {
                        $json['error']['activity-ProductId'] = 'กรุณาเลือกผลผลิต';
                    }
                    if (empty(trim($activityYear))) {
                        $json['error']['activity-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($activityName))) {
                        $json['error']['activity-name'] = 'กรุณาระบุชื่อกิจกรรม';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'product_id' => $productId,
                            'activity_year' => $activityYear,
                            'activity_name' => $activityName,
                            'modified' => date("Y-m-d H:i:s"),
                            'modified_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $query = $this->projectModel->updateActivity($data, $id);
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }

                        if (!empty($query)) {
                            $sms = array(
                                'msg' => 0,
                                'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                            );
                            session()->set($sms);
                        } else {
                            $sms = array(
                                'msg' => 1,
                                'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
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

    public function trashActivity()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('id');

                    $data = [
                        'activity_status' => '0',
                        'modified' => date("Y-m-d H:i:s"),
                        'modified_code' => $data['user']['hospcode'],
                    ];

                    try {
                        $query = $this->projectModel->updateActivity($data, $id);
                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }

                    if (!empty($query)) {
                        $sms = array(
                            'msg' => 0,
                            'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                        );
                        session()->set($sms);
                    } else {
                        $sms = array(
                            'msg' => 1,
                            'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        session()->set($sms);
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

    public function program($year = '')
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);
            $data['title'] = 'โครงการ';
            $breadcrumb = [
                "Home" => "/e-service/public/",
                "แผนงานและโครงการ" => ""
            ];
            $data['breadcrumb'] = $breadcrumb;

            if ($year == '') {
                $year = $this->thaidate->fiscalYear(date("Y-m-d"));
            }
            $data['productList'] = $this->projectModel->productList($year);
            $data['program'] = $this->projectModel->programList($year);

            return view('project/program/index', $data);
        } else {
            return redirect('auth');
        }
    }

    public function addProgram()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $productId = $this->request->getVar('productId');
                    $programYear = $this->request->getVar('programYear');
                    $programName = $this->request->getVar('programName');
                    $programMoney = $this->request->getVar('programMoney');

                    if (empty(trim($productId))) {
                        $json['error']['program-productId'] = 'กรุณาเลือกชื่อผลผลิต';
                    }
                    if (empty(trim($programYear))) {
                        $json['error']['program-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($programName))) {
                        $json['error']['program-name'] = 'กรุณาระบุชื่อโครงการ';
                    }
                    if (empty(trim($programMoney))) {
                        $json['error']['program-money'] = 'กรุณาระบุเงินงบประมาณ';
                    }
                    if ($programMoney < 0) {
                        $json['error']['program-money'] = 'จำนวนเงินงบประมาณไม่ถูกต้อง';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'product_id' => $productId,
                            'program_year' => $programYear,
                            'program_name' => $programName,
                            'program_money' => $programMoney,
                            'created' => date("Y-m-d H:i:s"),
                            'created_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $lastId = $this->projectModel->createProgram($data);
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
    public function viewProgram()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');

            $data['program'] = $this->projectModel->getProgram($id);
            return view('project/program/renderView', $data);
        } else {
            return redirect('auth');
        }
    }

    public function editProgram()
    {
        $data = [];
        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $id = $this->request->getVar('id');
            $year = $this->request->getVar('year');

            $data['productList'] = $this->projectModel->productList($year);
            $data['program'] = $this->projectModel->getProgram($id);

            return view('project/program/renderEdit', $data);
        } else {
            return redirect('auth');
        }
    }

    public function updateProgram()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('programId');
                    $productId = $this->request->getVar('productId');
                    $programYear = $this->request->getVar('programYear');
                    $programName = $this->request->getVar('programName');
                    $programMoney = $this->request->getVar('programMoney');


                    if (empty(trim($productId))) {
                        $json['error']['program-productId'] = 'กรุณาเลือกชื่อผลผลิต';
                    }
                    if (empty(trim($programYear))) {
                        $json['error']['program-year'] = 'กรุณาเลือกปีงบประมาณ';
                    }
                    if (empty(trim($programName))) {
                        $json['error']['program-name'] = 'กรุณาระบุชื่อโครงการ';
                    }
                    if (empty(trim($programMoney))) {
                        $json['error']['program-money'] = 'กรุณาระบุเงินงบประมาณ';
                    }
                    if ($programMoney < 0) {
                        $json['error']['program-money'] = 'จำนวนเงินงบประมาณไม่ถูกต้อง';
                    }

                    if (empty($json['error'])) {
                        $data = [
                            'product_id' => $productId,
                            'program_year' => $programYear,
                            'program_name' => $programName,
                            'program_money' => $programMoney,
                            'modified' => date("Y-m-d H:i:s"),
                            'modified_code' => $data['user']['hospcode'],
                        ];

                        try {
                            $query = $this->projectModel->updateProgram($data, $id);
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }

                        if (!empty($query)) {
                            $sms = array(
                                'msg' => 0,
                                'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                            );
                            session()->set($sms);
                        } else {
                            $sms = array(
                                'msg' => 1,
                                'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
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

    public function trashProgram()
    {
        helper(['form']);
        $data = [];
        $json = [];

        if (session('isLoggedIn')) {
            $data['user'] = $this->userModel->getUser(session('userId'));
            $data['admin'] = $this->userModel->adminProject($data['user']['hospcode']);

            if (!empty($data['admin'])) {
                if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
                    $id = $this->request->getVar('id');

                    $data = [
                        'program_status' => '0',
                        'modified' => date("Y-m-d H:i:s"),
                        'modified_code' => $data['user']['hospcode'],
                    ];

                    try {
                        $query = $this->projectModel->updateProgram($data, $id);
                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }

                    if (!empty($query)) {
                        $sms = array(
                            'msg' => 0,
                            'info' => 'คุณได้ทำการอัพเดทข้อมูลเรียบร้อย',
                        );
                        session()->set($sms);
                    } else {
                        $sms = array(
                            'msg' => 1,
                            'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        session()->set($sms);
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
}


// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;