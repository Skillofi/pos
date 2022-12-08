<?php

namespace App\Controllers;

use Config\Services;
use App\Models\AuthenticationModel;


class Auth extends BaseController
{
    
    public function index()
    {

        $session = \Config\Services::session();
        $data = ['validation' => Services::validation()];
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[3]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $authModel = model(AuthenticationModel::class);
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $response = $authModel->authenticate($username, $password);
                $this->session->setFlashdata('flashData', $response);
                if($response['status'] == 200){
                    return redirect()->to('/dashboard');
                }
            }
        }
        return view('authentication/login', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url());

    }
}
