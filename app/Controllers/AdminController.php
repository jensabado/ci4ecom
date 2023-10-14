<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\Admin;

class AdminController extends BaseController
{
    protected $db;
    protected $helpers = ['url', 'form', 'CIFunctions'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('back/pages/admin/auth/login', ['pageTitle' => 'Admin Login']);
    }

    public function forgotPassword()
    {
        return view('back/pages/admin/auth/forgot-password', ['pageTitle' => 'Admin Forgot Password']);
    }

    public function loginHandler()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'login_id' => 'required',
            'password' => 'required|min_length[8]',
        ], [
            'login_id' => [
                'required' => 'Username or Email is required',
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters in length',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $adminModel = new Admin();

            $fieldType = filter_var($this->request->getPost('login_id'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if ($fieldType === 'email') {
                if ($adminModel->isEmailExist($this->request->getPost('login_id'))) {
                    $admin = $this->db->table('admins')
                        ->where('email', $this->request->getPost('login_id'))
                        ->where('is_deleted', 'no')
                        ->get()->getRowArray();

                    if (Hash::check($this->request->getPost('password'), $admin['password'])) {
                        CIAuth::setCIAuthAdmin($admin);
                        $response = ['status' => 'success'];
                    } else {
                        $response = ['status' => 'error', 'message' => ['password' => 'The entered password is incorrect. Please double-check and try again']];
                    }
                } else {
                    $response = ['status' => 'error', 'message' => ['login_id' => 'Email is not exists in system']];
                }
            } else {
                if ($adminModel->isUsernameExist($this->request->getPost('login_id'))) {
                    $admin = $this->db->table('admins')
                        ->where('username', $this->request->getPost('login_id'))
                        ->where('is_deleted', 'no')
                        ->get()->getRowArray();

                    if (Hash::check($this->request->getPost('password'), $admin['password'])) {
                        CIAuth::setCIAuthAdmin($admin);
                        $response = ['status' => 'success'];
                    } else {
                        $response = ['status' => 'error', 'message' => ['password' => 'The entered password is incorrect. Please double-check and try again']];
                    }
                } else {
                    $response = ['status' => 'error', 'message' => ['login_id' => 'Username is not exists in system']];
                }
            }
        }

        return $this->response->setJSON($response);
    }

    public function forgotPasswordHandler() 
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'email' => 'required|valid_email'
        ], [
            'email' => [
                'required' => 'Email is required',
                'valid_email' => 'Invalid email format'
            ]
        ]);

        if(!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $adminModel = new Admin();

            if($adminModel->isEmailExist($this->request->getPost('email'))) {

            } else {
                $response = ['status' => 'error', 'message' => ['email' => 'Email is not exists in system']];
            }
        }

        return $this->response->setJSON($response);
    }

    public function logout() 
    {
        CIAuth::forgetAdmin();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('back/pages/admin/home', ['pageTitle' => 'Admin Dashboard', 'header' => 'Dashboard']);
    }
}
