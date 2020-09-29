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
            $data['listUser'] = $this->hrModel->getListings();
            return view('planning/training/create', $data);
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
