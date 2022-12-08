<?php

namespace App\Controllers;
use Config\Services;

class Setting extends BaseController
{
    public function online_setting()
    {
        $onlineSettingModel = model(OnlineSettingModel::class);
        $data = ['validation' => Services::validation()];
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'terms' => 'required|min_length[3]',
                'email' => 'required|min_length[3]',
                'phone' => 'required|min_length[3]',
                'fax' => 'required|min_length[3]',
                'address' => 'required|min_length[3]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $terms = $this->request->getPost('terms');
                $email = $this->request->getPost('email');
                $phone = $this->request->getPost('phone');
                $fax = $this->request->getPost('fax');
                $address = $this->request->getPost('address');
                $updatedData = [
                    'terms' => $terms,
                    'email' => $email,
                    'phone' => $phone,
                    'fax'   => $fax,
                    'address' => $address,
                ];
                $response = $onlineSettingModel->update('1', $updatedData);
                if ($response) {
                    $this->session->setFlashdata('flashData', array('status' => 200, 'message' => 'Setting updated successful'));
                }else{
                    $this->session->setFlashdata('flashData', array('status' => 400, 'message' => 'Unable to update setting'));
                }
                return redirect()->to('/setting/online_setting');
            }
        }
        $data['data'] = $onlineSettingModel->where('id', '1')->first();
        return view('setting/online_invoice_setting', $data);
        
    }

    public function retail_setting()
    {
        $retailSettingModel = model(RetailSettingModel::class);
        $data = ['validation' => Services::validation()];
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'terms' => 'required|min_length[3]',
                'email' => 'required|min_length[3]',
                'phone' => 'required|min_length[3]',
                'fax' => 'required|min_length[3]',
                'address' => 'required|min_length[3]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $terms = $this->request->getPost('terms');
                $email = $this->request->getPost('email');
                $phone = $this->request->getPost('phone');
                $fax = $this->request->getPost('fax');
                $address = $this->request->getPost('address');
                $updatedData = [
                    'terms' => $terms,
                    'email' => $email,
                    'phone' => $phone,
                    'fax'   => $fax,
                    'address' => $address,
                ];
                $response = $retailSettingModel->update('1', $updatedData);
                if ($response) {
                    $this->session->setFlashdata('flashData', array('status' => 200, 'message' => 'Setting updated successful'));
                } else {
                    $this->session->setFlashdata('flashData', array('status' => 400, 'message' => 'Unable to update setting'));
                }
                return redirect()->to('/setting/retail_setting');
            }
        }
        $data['data'] = $retailSettingModel->where('id', '1')->first();
        return view('setting/online_invoice_setting', $data);
    }

    public function system_setting()
    {
        $data = ['validation' => Services::validation()];
        $systemSettingModel = model(SystemSettingModel::class);
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'title' => 'required|min_length[3]',
                'smtp_host' => 'required|min_length[3]',
                'smtp_port' => 'required|min_length[2]',
                'smtp_username' => 'required|min_length[3]',
                'smtp_password' => 'required|min_length[3]',
                
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $title = $this->request->getPost('title');
                $smtp_host = $this->request->getPost('smtp_host');
                $smtp_port = $this->request->getPost('smtp_port');
                $smtp_username = $this->request->getPost('smtp_username');
                $smtp_password = $this->request->getPost('smtp_password');
                $logo = $this->request->getFile('logo');
                $favicon = $this->request->getFile('favicon');
                $updateData = [
                    'title' => $title,
                    'smtp_host' => $smtp_host,
                    'smtp_port' => $smtp_port,
                    'smtp_username' => $smtp_username,
                    'smtp_password' => $smtp_password,
                ];
                if($logo->isValid()){
                    $logo->move('./public/uploads', 'logo.png');
                    $updateData['logo'] =  $logo->getName();
                }
                if($favicon->isValid()){
                    $favicon->move('./public/uploads', 'favicon.png');
                    $updateData['favicon'] = $favicon->getName();
                }
                $response = $systemSettingModel->update('1', $updateData);
                if ($response) {
                    $this->session->setFlashdata('flashData', array('status' => 200, 'message' => 'Setting updated successful'));
                }else{
                    $this->session->setFlashdata('flashData', array('status' => 400, 'message' => 'Unable to update setting'));
                }
                return redirect()->to('/setting/system_setting');
            }
        }
        $data['data'] = $systemSettingModel->where('id', '1')->first();
        return view('setting/system_setting', $data);
    }
}
