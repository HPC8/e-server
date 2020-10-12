<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\PassEncrypt;
use App\Models\HrModel;
use App\Models\LocationModel;
use App\Libraries\MyLibrary;
use App\Libraries\LineAPI;

class Users extends BaseController
{

	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->passEncrypt = new PassEncrypt();
		$this->hrModel = new HrModel();
		$this->location = new LocationModel();
		$this->myLibrary = new MyLibrary();
		$this->lineAPI = new LineAPI();
	}

	public function index()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			return redirect('index');
		} else {
			return redirect('auth');
		}
	}

	public function auth()
	{
		$data['line'] = [
			"client_id" => $this->lineAPI->CLIENT_ID(),
			"client_secret" => $this->lineAPI->CLIENT_SECRET(),
			"redirect_uri" => $this->lineAPI->REDIRECT_URL()
		];
		return view('users/auth', $data);
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
		if (session('access_token') != NULL) {
			$this->lineLogout();
		}

		session()->destroy();
		return redirect()->to('auth');
	}

	public function lineCallback()
	{
		if (isset($_GET["code"])) {
			try {
				// Step 1. GET Access Token 
				$post_data = [
					"grant_type" => 'authorization_code',
					"client_id" => $this->lineAPI->CLIENT_ID(),
					"client_secret" => $this->lineAPI->CLIENT_SECRET(),
					"code" => $_GET["code"],
					"redirect_uri" => $this->lineAPI->REDIRECT_URL()
				];

				$headers[] = "Content-Type: application/x-www-form-urlencoded";

				$url = "https://api.line.me/oauth2/v2.1/token";
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
				curl_setopt($ch, CURLINFO_HEADER_OUT, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = json_decode(curl_exec($ch), true);
				curl_close($ch);

				// Step 2. GET User Profile
				$accessToken = $response['access_token'];
				if (!empty($accessToken)) {
					session()->set('access_token', $accessToken);
					$headerData = [
						"content-type: application/x-www-form-urlencoded",
						"charset=UTF-8",
						'Authorization: Bearer ' . $accessToken,
					];

					$ch2 = curl_init();
					curl_setopt($ch2, CURLOPT_HTTPHEADER, $headerData);
					curl_setopt($ch2, CURLOPT_URL, "https://api.line.me/v2/profile");
					curl_setopt($ch2, CURLINFO_HEADER_OUT, true);
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch2);
					$httpcode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
					curl_close($ch2);

					$result = json_decode($result, true);
					if ($httpcode == 200) {

						$data['line'] = [
							"userId" => $result['userId'],
							"name" => $result['displayName'],
							"picture" => $result['pictureUrl'],
						];

						$query = $this->userModel->checkLineID($result['userId']);
						if ($query) {
							session()->set('isLoggedIn', TRUE);
							session()->set('userId', $query['emp_id']);

							return redirect()->to('index');
						} else {
							return redirect()->to('auth');
						}
					} else {
						return redirect()->to('auth');
					}
				}
			} catch (\Exception $e) {
				die($e->getMessage());
			}
		}
	}

	public function lineLogout()
	{
		try {
			$post_data = [
				"access_token" => session('access_token'),
				"client_id" => $this->lineAPI->CLIENT_ID(),
				"client_secret" => $this->lineAPI->CLIENT_SECRET(),
			];

			$headers[] = "Content-Type: application/x-www-form-urlencoded";

			$url = "https://api.line.me/oauth2/v2.1/token";
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = json_decode(curl_exec($ch), true);
			curl_close($ch);
		} catch (\Exception $e) {
			die($e->getMessage());
		}
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
					'mobile' => $_mobile,
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

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;