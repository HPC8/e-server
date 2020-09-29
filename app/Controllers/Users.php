<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\PassEncrypt;
use App\Models\HrModel;
use App\Models\LocationModel;
use App\Libraries\MyLibrary;

class Users extends BaseController
{

	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->passEncrypt = new PassEncrypt();
		$this->hrModel = new HrModel();
		$this->location = new LocationModel();
		$this->myLibrary = new MyLibrary();
	}

	public function auth()
	{
		return view('users/auth');
	}
	public function authSubmit()
	{
		$json = [];
		$_account = $this->request->getVar('account');
		$_password = $this->request->getVar('password');

		if (empty(trim($_account))) {
			$json['error']['account-err'] = 'กรุณาระบุผู้ใช้งาน';
		}
		if (empty(trim($_password))) {
			$json['error']['password-err'] = 'กรุณาระบุรหัสผ่าน';
		}

		if (empty($json['error'])) {

			// check account login
			if (strpos($_account, '10') !== false) {
				$query = $this->userModel->checkCode($_account);
			} elseif (strpos($_account, '@') !== false) {
				$query = $this->userModel->checkEmail($_account);
			} else {
				$query = $this->userModel->checkUser($_account);
			}

			try {
				if ($query) {
					$checkLogin = $this->passEncrypt->passwordVerify($_password, $query['passwd']);

					if ($checkLogin == TRUE) {
						session()->set('isLoggedIn', TRUE);
						session()->set('userId', $query['emp_id']);
					} else {
						$json['error']['password-err'] = 'รหัสผ่านไม่ถูกต้อง';
					}
				} else {
					$json['error']['account-err'] = 'ไม่พบข้อมูลผู้ใช้งานในฐานข้อมูล';
				}
			} catch (\Exception $e) {
				die($e->getMessage());
			}
		}
		echo json_encode($json);
	}


	public function logout()
	{
		session()->destroy();
		return redirect()->to('auth');
	}

	public function profile()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['title'] = 'Profile';
			$breadcrumb = [
				"Home" => "/e-service/public/",
				"Profile" => ""
			];
			$data['breadcrumb'] = $breadcrumb;
			return view('users/profile', $data);
		} else {
			return redirect('auth');
		}
	}

	public function changePasswd()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			//$_hospcode = $this->request->getVar('hospcode');

			return view('users/modal/newPasswd', $data);
		} else {
			return redirect('auth');
		}
	}

	public function updatePasswd()
	{
		helper(['form']);
		$data = [];
		$json = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$_hospcode = $this->request->getVar('hospcode');
			$_passwd_old = $this->request->getVar('passwd_old');
			$_passwd_new = $this->request->getVar('passwd_new');
			$_passwd_confirm = $this->request->getVar('passwd_confirm');


			if ($this->passEncrypt->passwordVerify($_passwd_old, $data['user']['passwd']) == FALSE) {
				$json['error']['passwd-old'] = 'รหัสผ่านไม่ถูกต้อง';
			}

			if ($this->passEncrypt->passwdPattern($_passwd_new) == FALSE) {
				$json['error']['passwd-new'] = 'รูปแบบรหัสผ่านไม่ถูกต้อง';
			}
			if (empty(trim($_passwd_confirm))) {
				$json['error']['passwd-confirm'] = 'กรุณายืนยันรหัสผ่านของคุณอีกครั้ง';
			}
			if ($_passwd_new != $_passwd_confirm) {
				$json['error']['passwd-confirm'] = 'กรุณายืนยันรหัสผ่านของคุณอีกครั้ง';
			}

			if (empty($json['error'])) {

				$md5 = $this->passEncrypt->passwordEncrypt($_passwd_new);
				$encrypt = $this->passEncrypt->passwordHash($md5);

				$passwd = [
					'passwd' => $encrypt,
					'reset_passwd_by' => $data['user']['hospcode'],
					'reset_passwd_ip' => $_SERVER['REMOTE_ADDR'],
					'reset_passwd_date' => date("Y-m-d H:i:s"),
				];

				try {
					$query = $this->hrModel->resetPasswd($passwd, $_hospcode);
				} catch (\Exception $e) {
					die($e->getMessage());
				}

				if (!empty($query)) {
					$sms = array(
						'msg' => 0,
						'info' => 'คุณได้ทำการเปลี่ยนรหัสผ่านเรียบร้อย',
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
		} else {
			return redirect('auth');
		}
	}

	public function edit()
	{
		helper(['form']);
		$data = [];

		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));

			$data['title'] = 'ระบบบุคลากร';
			$breadcrumb = [
				"Home" => "/e-service/public/",
				"ระบบบุคลากร" => "/e-service/public/hr",
				"ข้อมูลบุคลากร " => ""
			];

			$data['breadcrumb'] = $breadcrumb;
			// $data['userInfo'] = $this->userModel->getHospcode($hospcode);
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

			return view('users/edit', $data);
		} else {
			return redirect('auth');
		}
	}

	public function updateUser()
	{
		helper(['form']);
		$data = [];
		$json = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$_hospcode = $this->request->getVar('hospcode');
			$_email = $this->request->getVar('email');
			$_address = $this->request->getVar('address');
			$_province = $this->request->getVar('province');
			$_amphur = $this->request->getVar('amphur');
			$_district = $this->request->getVar('district');
			$_mobile = $this->request->getVar('mobile');

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
			if (empty($json['error'])) {
				$data = [
					'email' => $_email,
					'mobile' =>$_mobile,
					'address' => $_address,
					'province_id' => $_province,
					'amphur_id' => $_amphur,
					'district_id' => $_district,
					'edit_by' => $data['user']['hospcode'],
					'edit_ip' => $_SERVER['REMOTE_ADDR'],
					'edit_date' => date("Y-m-d H:i:s"),
				];

				try {
					$query = $this->hrModel->userUpdate($data, $_hospcode);
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
			echo json_encode($json);
		} else {
			return redirect('auth');
		}
	}



	public function createPassword()
	{
		$pass = 'password';
		$md5 = $this->passEncrypt->passwordEncrypt($pass);
		$encrypt = $this->passEncrypt->passwordHash($md5);
		echo $encrypt;
	}

	public function checkUser()
	{
		$account = 'suthat.b@';

		if (strpos($account, '10') !== false) {
			echo 'code';
		} elseif (strpos($account, '@') !== false) {
			echo 'mail';
		} else {
			echo 'user';
		}
	}

	public function username()
	{
		return redirect()->to(base_url('project/plan'));
	}
}
// return redirect()->to(base_url(''));