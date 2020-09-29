<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\MyLibrary;
use App\Libraries\PassEncrypt;
use App\Models\HrModel;
use App\Models\LocationModel;
use App\Models\HrModel\ListingsModel;
use App\Models\HrModel\DiscardModel;
use App\Models\UserModel;
use App\Models\RadiusModel;
use Config\Services;

class Hr extends Controller
{

	protected $hrModel, $myLibrary;

	public function __construct()
	{
		$this->myLibrary = new MyLibrary();
		$this->hrModel = new HrModel();
		$this->location = new LocationModel();
		$this->passEncrypt = new PassEncrypt();
		$this->userModel = new UserModel();

		$db2 = db_connect('radiusDB');
		$this->radiusModel = new RadiusModel($db2);
	}
	public function index()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['title'] = 'ระบบบุคลากร';
			$breadcrumb = [
				"Home" => "/e-service/public/",
				"ระบบบุคลากร" => ""
			];
			$data['breadcrumb'] = $breadcrumb;
			$data['category'] = $this->hrModel->getCategory();
			return view('hr/index', $data);
		} else {
			return redirect('auth');
		}
	}

	public function register()
	{
		helper(['form']);
		$data = [];

		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$data['title'] = 'เพิ่มข้อมูลบุคลากร';
					$breadcrumb = [
						"Home" => "/e-service/public/",
						"ระบบบุคลากร" => "/e-service/public/hr",
						"เพิ่มบุคลากร" => "",
					];
					$data['breadcrumb'] = $breadcrumb;
					$data['codeLast'] = $this->hrModel->hospcodeLast();
					$data['titlename'] = $this->hrModel->getTitlename();
					$data['blood'] = $this->hrModel->getBlood();
					$data['provinces'] = $this->location->getProvinces();
					$data['education'] = $this->hrModel->getEducation();
					$data['degree'] = $this->hrModel->getDegree();
					$data['category'] = $this->hrModel->getCategory();
					$data['position'] = $this->hrModel->getPosition();
					$data['level'] = $this->hrModel->getLevel();
					$data['department'] = $this->hrModel->getDepartment();
					$data['section'] = $this->hrModel->getSection();

					return view('hr/register', $data);
				}
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		} else {
			return redirect('auth');
		}
	}

	public function addUsers()
	{
		$data = [];
		$json = [];
		$data['user'] = $this->userModel->getUser(session('userId'));
		$_hospcode = $this->request->getVar('hospcode');
		$_sex = $this->request->getVar('sex');
		$_marital = $this->request->getVar('marital');
		$_blood = $this->request->getVar('blood');
		$_titlename = $this->request->getVar('titlename');
		$_firstname = $this->request->getVar('firstname');
		$_lastname = $this->request->getVar('lastname');
		$_cid = $this->request->getVar('cid');
		$_birthday = $this->request->getVar('birthday');
		$_firstnameEng = $this->request->getVar('firstnameEng');
		$_lastnameEng = $this->request->getVar('lastnameEng');
		$_email = $this->request->getVar('email');
		$_address = $this->request->getVar('address');
		$_province = $this->request->getVar('province');
		$_amphur = $this->request->getVar('amphur');
		$_district = $this->request->getVar('district');
		$_mobile = $this->request->getVar('mobile');
		$_education = $this->request->getVar('education');
		$_degree = $this->request->getVar('degree');
		$_branch = $this->request->getVar('branch');
		$_positionNo = $this->request->getVar('positionNo');
		$_startDate = $this->request->getVar('startDate');
		$_stopDate = $this->request->getVar('stopDate');
		$_accountNo = $this->request->getVar('accountNo');
		$_salary = $this->request->getVar('salary');
		$_category = $this->request->getVar('category');
		$_position = $this->request->getVar('position');
		$_level = $this->request->getVar('level');
		$_department = $this->request->getVar('department');
		$_section = $this->request->getVar('section');


		if (empty(trim($_hospcode))) {
			$json['error']['hospcode'] = 'ไม่พบรหัสประจำตัว';
		}
		if (empty(trim($_sex))) {
			$json['error']['sex'] = 'กรุณาระบุเพศ';
		}
		if (empty(trim($_marital))) {
			$json['error']['marital'] = 'กรุณาระบุสถานภาพ';
		}
		if (empty(trim($_blood))) {
			$json['error']['blood'] = 'กรุณาระบุกรุ๊ปเลือด';
		}
		if (empty(trim($_titlename))) {
			$json['error']['titlename'] = 'กรุณาระบุคำนำหน้าชื่อ';
		}
		if (empty(trim($_firstname))) {
			$json['error']['firstname'] = 'กรุณาระบุชื่อ';
		}
		if (empty(trim($_lastname))) {
			$json['error']['lastname'] = 'กรุณาระบุนามสกุล';
		}
		if ($this->myLibrary->validateCID($_cid) == FALSE) {
			$json['error']['cid'] = 'เลขบัตรประจำตัวประชาชนไม่ถูกต้อง';
		}
		if ($this->hrModel->doubleCid($_cid) == TRUE) {
			$json['error']['cid'] = 'เลขบัตรประจำตัวประชาชนซ้ำกัน';
		}
		if (empty(trim($_birthday))) {
			$json['error']['birthday'] = 'กรุณาระบุวันเกิด';
		}
		if (empty(trim($_firstnameEng))) {
			$json['error']['firstnameEng'] = 'กรุณาระบุชื่อ (ภาษาอังกฤษ)';
		}
		if (empty(trim($_lastnameEng))) {
			$json['error']['lastnameEng'] = 'กรุณาระบุนามสกุล (ภาษาอังกฤษ)';
		}
		if ($this->myLibrary->validateEmail($_email) == FALSE) {
			$json['error']['email'] = 'รูปแบบอีเมล์ไม่ถูกต้อง';
		}
		if (empty(trim($_address))) {
			$json['error']['address'] = 'กรุณาระบุที่อยู่';
		}
		if (empty(trim($_province))) {
			$json['error']['province'] = 'กรุณาระบุจังหวัด';
		}
		if (empty(trim($_amphur))) {
			$json['error']['amphur'] = 'กรุณาระบุอำเภอ';
		}
		if (empty(trim($_district))) {
			$json['error']['district'] = 'กรุณาระบุตำบล';
		}
		if (empty(trim($_mobile))) {
			$json['error']['mobile'] = 'กรุณาระบุเบอร์โทรศัพท์';
		}
		if (empty(trim($_education))) {
			$json['error']['education'] = 'กรุณาระบุการศึกษา';
		}
		if (empty(trim($_degree))) {
			$json['error']['degree'] = 'กรุณาระบุวุฒิการศึกษา';
		}
		if (empty(trim($_positionNo))) {
			$json['error']['positionNo'] = 'กรุณาระบุเลขที่ตำแหน่ง';
		}
		if (empty(trim($_startDate))) {
			$json['error']['startDate'] = 'กรุณาระบุวันเริ่มสัญญา';
		}
		if (empty(trim($_category))) {
			$json['error']['category'] = 'กรุณาระบุประเภทบุคลากร';
		}
		if (empty(trim($_position))) {
			$json['error']['position'] = 'กรุณาระบุตำแหน่ง';
		}
		if (empty(trim($_department))) {
			$json['error']['department'] = 'กรุณาระบุกลุ่ม/แผนก';
		}
		if (empty(trim($_section))) {
			$json['error']['section'] = 'กรุณาระบุงาน/ฝ่าย';
		}


		if (empty($json['error'])) {
			$this->hrModel->setAddBy($data['user']['hospcode']);
			$this->hrModel->setHospcode($_hospcode);
			$this->hrModel->setSex($_sex);
			$this->hrModel->setMarital($_marital);
			$this->hrModel->setBlood($_blood);
			$this->hrModel->setTitlename($_titlename);
			$this->hrModel->setFirstname($_firstname);
			$this->hrModel->setLastname($_lastname);
			$this->hrModel->setCid($_cid);
			$this->hrModel->setBirthday($_birthday);
			$this->hrModel->setNameEng($_firstnameEng, $_lastnameEng);
			$this->hrModel->setEmail($_email);
			$this->hrModel->setAddress($_address);
			$this->hrModel->setProvince($_province);
			$this->hrModel->setAmphur($_amphur);
			$this->hrModel->setDistrict($_district);
			$this->hrModel->setMobile($_mobile);
			$this->hrModel->setEducation($_education);
			$this->hrModel->setDegree($_degree);
			$this->hrModel->setBranch($_branch);
			$this->hrModel->setPositionNo($_positionNo);
			$this->hrModel->setStartDate($_startDate);
			$this->hrModel->setStopDate($_stopDate);
			$this->hrModel->setAccountno($_accountNo);
			$this->hrModel->setSalary($_salary);
			$this->hrModel->setCategory($_category);
			$this->hrModel->setPosition($_position);
			$this->hrModel->setLevel($_level);
			$this->hrModel->setDepartment($_department);
			$this->hrModel->setSection($_section);
			$md5 = $this->passEncrypt->passwordEncrypt($_cid);
			$encrypt = $this->passEncrypt->passwordHash($md5);
			$this->hrModel->setPassword($encrypt);

			try {
				$lastId = $this->hrModel->createUsers();
			} catch (\Exception $e) {
				die($e->getMessage());
			}
			if ($lastId) {
				//add username to radius
				$this->radiusModel->radiusInfo($lastId);
				$this->radiusModel->radiusCheck($lastId);
				$this->radiusModel->radiusGroup($lastId);

				$sms = array(
					'msg' => 0,
					'info' => 'ระบบได้ทำการบันทึกข้อมูลสำเร็จ',
				);
				session()->set($sms);
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'ระบบไม่สามารถทำการบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		}
		echo json_encode($json);
	}

	// get amphur names
	public function getAmphur()
	{
		$json = [];
		$this->location->setProvincesID($this->request->getVar('provinceID'));
		$json = $this->location->getAmphur();
		echo json_encode($json);
	}

	// get district names
	public function getDistrict()
	{
		$json = [];
		$this->location->setDistrictID($this->request->getVar('amphurID'));
		$json = $this->location->getDistrict();
		echo json_encode($json);
	}

	public function count($id)
	{
		$data = strval($this->hrModel->countEmp($id));
		return $data;
	}

	public function pieCategory()
	{
		$data = $this->hrModel->pieCategory();
		print_r(json_encode($data, true));
	}
	public function pieEducation()
	{
		$data = $this->hrModel->pieEducation();
		print_r(json_encode($data, true));
	}
	function pieGen()
	{
		$data = $this->hrModel->getAge();
		$gen = $this->myLibrary->getGen($data);
		print_r(json_encode($gen, true));
	}
	public function pieLavel()
	{
		$data = $this->hrModel->pieLavel();
		print_r(json_encode($data, true));
	}

	public function listings()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$data['title'] = 'ระบบบุคลากร';
					$breadcrumb = [
						"Home" => "/e-service/public/",
						"ระบบบุคลากร" => "/e-service/public/hr",
						"ตารางรายชื่อบุคลากรทั้งหมด" => ""
					];
					$data['breadcrumb'] = $breadcrumb;

					return view('hr/listings', $data);
				}
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		} else {
			return redirect('auth');
		}
	}

	public function ajaxListings()
	{
		$request = Services::request();
		$m_emp = new ListingsModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $m_emp->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $emp) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $emp->hospcode;
				$row[] = $emp->titlename . $emp->firstname . ' ' . $emp->lastname;
				$row[] = $emp->position_name . $emp->level_name;
				$row[] = $emp->department_name;
				$row[] = "<div class='action-buttons'>
        					<a class='text-blue mx-1' href='hr/profile/$emp->hospcode'>
          						<i class='fa fa-search-plus text-105'></i>
       						</a>
        					<a class='text-success mx-1' href='hr/edit/$emp->hospcode'>
          						<i class='fa fa-pencil-alt text-105'></i>
        					</a>
        					<a class='text-danger-m1 mx-1' href='hr/transfer/$emp->hospcode'>
          						<i class='fa fa-trash-alt text-105'></i>
        					</a>
      					</div>";
				$data[] = $row;
			}
			$output = [
				"draw" => $request->getPost('draw'),
				"recordsTotal" => $m_emp->count_all(),
				"recordsFiltered" => $m_emp->count_filtered(),
				"data" => $data
			];
			echo json_encode($output);
		}
	}

	public function discard()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));

			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$data['title'] = 'ระบบบุคลากร';
					$breadcrumb = [
						"Home" => "/e-service/public/",
						"ระบบบุคลากร" => "/e-service/public/hr",
						"ตารางรายชื่อบุคลากรที่จำหน่าย" => ""
					];
					$data['breadcrumb'] = $breadcrumb;

					return view('hr/discard', $data);
				}
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		} else {
			return redirect('auth');
		}
	}

	public function ajaxDiscard()
	{
		$request = Services::request();
		$m_emp = new DiscardModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $m_emp->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $emp) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $emp->hospcode;
				$row[] = $emp->titlename . $emp->firstname . ' ' . $emp->lastname;
				$row[] = $emp->position_name . $emp->level_name;
				$row[] = $emp->department_name;
				$row[] = "<div class='action-buttons'>
        					<a class='text-blue mx-1' href='hr/profile/$emp->hospcode'>
          						<i class='fa fa-search-plus text-105'></i>
       						</a>
        					<a class='text-success mx-1 disabled' href='#'>
          						<i class='fa fa-pencil-alt text-105'></i>
        					</a>
        					<a class='text-danger-m1 mx-1 disabled' href='#'>
          						<i class='fa fa-trash-alt text-105'></i>
        					</a>
      					</div>";
				$data[] = $row;
			}
			$output = [
				"draw" => $request->getPost('draw'),
				"recordsTotal" => $m_emp->count_all(),
				"recordsFiltered" => $m_emp->count_filtered(),
				"data" => $data
			];
			echo json_encode($output);
		}
	}

	public function category($id = '')
	{
		$data = [];
		$data['category'] = $this->hrModel->getCategory($id);
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$data['title'] = 'ระบบบุคลากร';
					$breadcrumb = [
						"Home" => "/e-service/public/",
						"ระบบบุคลากร" => "/e-service/public/hr",
						"ตารางรายชื่อ" . $data['category'][0]->category_name => ""
					];
					$data['breadcrumb'] = $breadcrumb;

					$data['listCategory'] = $this->hrModel->listCategory($id);

					return view('hr/category', $data);
				}
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		} else {
			return redirect('auth');
		}
	}

	public function profile($hospcode)
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['title'] = 'ระบบบุคลากร';
			$breadcrumb = [
				"Home" => "/e-service/public/",
				"ระบบบุคลากร" => "/e-service/public/hr",
				"ข้อมูลบุคลากร $hospcode" => ""
			];
			$data['breadcrumb'] = $breadcrumb;

			$data['userInfo'] = $this->userModel->getHospcode($hospcode);

			return view('hr/profile', $data);
		} else {
			return redirect('auth');
		}
	}

	public function edit($hospcode)
	{
		helper(['form']);
		$data = [];

		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$data['title'] = 'ระบบบุคลากร';
					$breadcrumb = [
						"Home" => "/e-service/public/",
						"ระบบบุคลากร" => "/e-service/public/hr",
						"ข้อมูลบุคลากร $hospcode" => ""
					];
					$data['userInfo'] = $this->userModel->getHospcode($hospcode);
					$data['breadcrumb'] = $breadcrumb;
					$data['codeLast'] = $this->hrModel->hospcodeLast();
					$data['titlename'] = $this->hrModel->getTitlename();
					$data['blood'] = $this->hrModel->getBlood();
					$data['provinces'] = $this->location->getProvinces();
					$data['education'] = $this->hrModel->getEducation();
					$data['degree'] = $this->hrModel->getDegree();
					$data['category'] = $this->hrModel->getCategory();
					$data['position'] = $this->hrModel->getPosition();
					$data['level'] = $this->hrModel->getLevel();
					$data['department'] = $this->hrModel->getDepartment();
					$data['section'] = $this->hrModel->getSection();

					return view('hr/edit', $data);
				}
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		} else {
			return redirect('auth');
		}
	}

	public function updateUsers()
	{
		$data = [];
		$json = [];
		$data['user'] = $this->userModel->getUser(session('userId'));
		$_hospcode = $this->request->getVar('hospcode');
		$_sex = $this->request->getVar('sex');
		$_marital = $this->request->getVar('marital');
		$_blood = $this->request->getVar('blood');
		$_titlename = $this->request->getVar('titlename');
		$_firstname = $this->request->getVar('firstname');
		$_lastname = $this->request->getVar('lastname');
		$_birthday = $this->request->getVar('birthday');
		$_firstnameEng = $this->request->getVar('firstnameEng');
		$_lastnameEng = $this->request->getVar('lastnameEng');
		$_email = $this->request->getVar('email');
		$_address = $this->request->getVar('address');
		$_province = $this->request->getVar('province');
		$_amphur = $this->request->getVar('amphur');
		$_district = $this->request->getVar('district');
		$_mobile = $this->request->getVar('mobile');
		$_education = $this->request->getVar('education');
		$_degree = $this->request->getVar('degree');
		$_branch = $this->request->getVar('branch');
		$_positionNo = $this->request->getVar('positionNo');
		$_startDate = $this->request->getVar('startDate');
		$_stopDate = $this->request->getVar('stopDate');
		$_accountNo = $this->request->getVar('accountNo');
		$_salary = $this->request->getVar('salary');
		$_category = $this->request->getVar('category');
		$_position = $this->request->getVar('position');
		$_level = $this->request->getVar('level');
		$_department = $this->request->getVar('department');
		$_section = $this->request->getVar('section');
		$_note = $this->request->getVar('hrNote');

		if (empty(trim($_sex))) {
			$json['error']['sex'] = 'กรุณาระบุเพศ';
		}
		if (empty(trim($_marital))) {
			$json['error']['marital'] = 'กรุณาระบุสถานภาพ';
		}
		if (empty(trim($_blood))) {
			$json['error']['blood'] = 'กรุณาระบุกรุ๊ปเลือด';
		}
		if (empty(trim($_titlename))) {
			$json['error']['titlename'] = 'กรุณาระบุคำนำหน้าชื่อ';
		}
		if (empty(trim($_firstname))) {
			$json['error']['firstname'] = 'กรุณาระบุชื่อ';
		}
		if (empty(trim($_lastname))) {
			$json['error']['lastname'] = 'กรุณาระบุนามสกุล';
		}

		if (empty(trim($_birthday))) {
			$json['error']['birthday'] = 'กรุณาระบุวันเกิด';
		}
		if (empty(trim($_firstnameEng))) {
			$json['error']['firstnameEng'] = 'กรุณาระบุชื่อ (ภาษาอังกฤษ)';
		}
		if (empty(trim($_lastnameEng))) {
			$json['error']['lastnameEng'] = 'กรุณาระบุนามสกุล (ภาษาอังกฤษ)';
		}
		if ($this->myLibrary->validateEmail($_email) == FALSE) {
			$json['error']['email'] = 'รูปแบบอีเมล์ไม่ถูกต้อง';
		}
		if (empty(trim($_address))) {
			$json['error']['address'] = 'กรุณาระบุที่อยู่';
		}
		if (empty(trim($_province))) {
			$json['error']['province'] = 'กรุณาระบุจังหวัด';
		}
		if (empty(trim($_amphur))) {
			$json['error']['amphur'] = 'กรุณาระบุอำเภอ';
		}
		if (empty(trim($_district))) {
			$json['error']['district'] = 'กรุณาระบุตำบล';
		}
		if (empty(trim($_mobile))) {
			$json['error']['mobile'] = 'กรุณาระบุเบอร์โทรศัพท์';
		}
		if (empty(trim($_education))) {
			$json['error']['education'] = 'กรุณาระบุการศึกษา';
		}
		if (empty(trim($_degree))) {
			$json['error']['degree'] = 'กรุณาระบุวุฒิการศึกษา';
		}
		if (empty(trim($_positionNo))) {
			$json['error']['positionNo'] = 'กรุณาระบุเลขที่ตำแหน่ง';
		}
		if (empty(trim($_startDate))) {
			$json['error']['startDate'] = 'กรุณาระบุวันเริ่มสัญญา';
		}
		if (empty(trim($_category))) {
			$json['error']['category'] = 'กรุณาระบุประเภทบุคลากร';
		}
		if (empty(trim($_position))) {
			$json['error']['position'] = 'กรุณาระบุตำแหน่ง';
		}
		if (empty(trim($_department))) {
			$json['error']['department'] = 'กรุณาระบุกลุ่ม/แผนก';
		}
		if (empty(trim($_section))) {
			$json['error']['section'] = 'กรุณาระบุงาน/ฝ่าย';
		}


		if (empty($json['error'])) {
			$this->hrModel->setUpdateBy($data['user']['hospcode']);
			$this->hrModel->setHospcode($_hospcode);
			$this->hrModel->setSex($_sex);
			$this->hrModel->setMarital($_marital);
			$this->hrModel->setBlood($_blood);
			$this->hrModel->setTitlename($_titlename);
			$this->hrModel->setFirstname($_firstname);
			$this->hrModel->setLastname($_lastname);
			$this->hrModel->setBirthday($_birthday);
			$this->hrModel->setNameEng($_firstnameEng, $_lastnameEng);
			$this->hrModel->setEmail($_email);
			$this->hrModel->setAddress($_address);
			$this->hrModel->setProvince($_province);
			$this->hrModel->setAmphur($_amphur);
			$this->hrModel->setDistrict($_district);
			$this->hrModel->setMobile($_mobile);
			$this->hrModel->setEducation($_education);
			$this->hrModel->setDegree($_degree);
			$this->hrModel->setBranch($_branch);
			$this->hrModel->setPositionNo($_positionNo);
			$this->hrModel->setStartDate($_startDate);
			$this->hrModel->setStopDate($_stopDate);
			$this->hrModel->setAccountno($_accountNo);
			$this->hrModel->setSalary($_salary);
			$this->hrModel->setCategory($_category);
			$this->hrModel->setPosition($_position);
			$this->hrModel->setLevel($_level);
			$this->hrModel->setDepartment($_department);
			$this->hrModel->setSection($_section);
			$this->hrModel->setNote($_note);

			try {
				$query = $this->hrModel->updateUsers();
			} catch (\Exception $e) {
				die($e->getMessage());
			}
			if (!empty($query)) {
				$json['Hospcode'] = $query;
				$sms = array(
					'msg' => 0,
					'info' => 'ระบบได้ทำการอัพเดทข้อมูลสำเร็จ',
				);
				session()->set($sms);
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		}
		echo json_encode($json);
	}
	public function transfer($hospcode)
	{
		helper(['form']);
		$data = [];

		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$data['title'] = 'ระบบบุคลากร';
					$breadcrumb = [
						"Home" => "/e-service/public/",
						"ระบบบุคลากร" => "/e-service/public/hr",
						"ข้อมูลบุคลากร $hospcode" => ""
					];

					$data['breadcrumb'] = $breadcrumb;
					$data['userInfo'] = $this->userModel->getHospcode($hospcode);
					$data['retire'] = $this->hrModel->getRetire();
					$data['codeLast'] = $this->hrModel->hospcodeLast();
					$data['titlename'] = $this->hrModel->getTitlename();
					$data['blood'] = $this->hrModel->getBlood();
					$data['provinces'] = $this->location->getProvinces();
					$data['education'] = $this->hrModel->getEducation();
					$data['degree'] = $this->hrModel->getDegree();
					$data['category'] = $this->hrModel->getCategory();
					$data['position'] = $this->hrModel->getPosition();
					$data['level'] = $this->hrModel->getLevel();
					$data['department'] = $this->hrModel->getDepartment();
					$data['section'] = $this->hrModel->getSection();

					return view('hr/transfer', $data);
				}
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		} else {
			return redirect('auth');
		}
	}

	public function transferUsers()
	{
		$data = [];
		$json = [];
		$data['user'] = $this->userModel->getUser(session('userId'));
		$_hospcode = $this->request->getVar('hospcode');
		$_retire = $this->request->getVar('retire');
		$_retireDate = $this->request->getVar('retireDate');
		$_retireDetail = $this->request->getVar('retireDetail');
		$_attachment = $this->request->getVar('attachment');

		if (empty(trim($_retire))) {
			$json['error']['retire'] = 'กรุณาระบุประเภทการจำหน่าย';
		}
		if (empty(trim($_retireDate))) {
			$json['error']['retireDate'] = 'กรุณาระบุวันที่จำหน่าย';
		}
		if (empty(trim($_retireDetail))) {
			$json['error']['retireDetail'] = 'กรุณาระบุสาเหตุหรือรายละเอียด';
		}


		if (empty($json['error'])) {
			$this->hrModel->setUpdateBy($data['user']['hospcode']);
			$this->hrModel->setHospcode($_hospcode);
			$this->hrModel->setRetire($_retire);
			$this->hrModel->setRetireDate($_retireDate);
			$this->hrModel->setRetireDetail($_retireDetail);

			try {
				$query = $this->hrModel->transferUsers();
			} catch (\Exception $e) {
				die($e->getMessage());
			}
			if (!empty($query)) {
				$json['Hospcode'] = $query;
				$sms = array(
					'msg' => 0,
					'info' => 'ระบบได้ทำการอัพเดทข้อมูลสำเร็จ',
				);
				session()->set($sms);
			} else {
				$sms = array(
					'msg' => 1,
					'info' => 'ระบบไม่สามารถทำการอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
				);

				session()->set($sms);
				return redirect('hr');
			}
		}
		echo json_encode($json);
	}

	public function resetPasswd()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['admin'] = $this->userModel->adminHr($data['user']['hospcode']);

			if (!empty($data['admin'])) {
				if ($data['admin'][0]->level == 1 || $data['admin'][0]->level == 2) {
					$_hospcode = $this->request->getVar('id');

					$data['userInfo'] = $this->userModel->getHospcode($_hospcode);
					$md5 = $this->passEncrypt->passwordEncrypt($data['userInfo']['cid']);
					$encrypt = $this->passEncrypt->passwordHash($md5);

					$passwd = [
						'passwd' => $encrypt,
						'reset_passwd_by' => $data['user']['hospcode'],
						'reset_passwd_ip' => $_SERVER['REMOTE_ADDR'],
						'reset_passwd_date' => date("Y-m-d H:i:s"),
					];

					$query = $this->hrModel->resetPasswd($passwd, $_hospcode);
					if (!empty($query)) {
						$sms = array(
							'msg' => 0,
							'info' => 'ระบบได้ทำการรีเซ็ตรหัสผ่าน <U>' . $data['userInfo']['titlename'] . $data['userInfo']['firstname'] . ' ' . $data['userInfo']['lastname'] . '</U> เรียบร้อย<p>โดยระบบได้กำหนดรหัสผ่านใหม่เป็นเลขบัตรประจำตัวประชาชน 13 หลัก',
						);
						session()->set($sms);
					}
				} else {
					$sms = array(
						'msg' => 1,
						'info' => 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
					);

					session()->set($sms);
					return redirect('hr');
				}
				echo json_encode($data);
			} else {
				return redirect('auth');
			}
		}
	}

	public function getPassword()
	{
		$user = [
			'id' => '10005',
			'firstname' => 'suthat',
			'lastname' => 'buran',
			'email' => 'kung',
		];

		$pass = 'password';
		$pass2 = 'password';
		$paas_db = '$2y$10$apb9yex/tOru3o/5A.JIL.uLdoYZnYtg8Jo8JXDgRO8VT0vEXiqvS';

		$md5 = $this->passEncrypt->passwordEncrypt($pass);
		$encrypt = $this->passEncrypt->passwordHash($md5);

		echo $encrypt;

		$login = $this->passEncrypt->passwordVerify($pass2, $paas_db);

		echo ' ' . $login;

		if ($login == true) {

			echo '<br/><br/><span style="color:red">OK</span>';
		} else {
			echo '<br/><br/><span style="color:red">Invalid password.</span>';
		}
	}

	public function test()
	{
		$cid = '1-3610-00197-53-6';
		$data['cid'] = $this->hrModel->doubleCid($cid);

		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit;
	}
}
// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;