<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->userModel = new UserModel();
	}
	public function index()
	{
		$data = [];
		if (session('isLoggedIn')) {
			$data['user'] = $this->userModel->getUser(session('userId'));
			$data['title'] = 'Dashboard';
			$breadcrumb = array(
				"Home" => "/e-service/public/",
				"Dashboard" => ""
			);
			$data['breadcrumb'] = $breadcrumb;

			return view('dashboard/index', $data);
		} else {
			return redirect('auth');
		}
	}


}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
