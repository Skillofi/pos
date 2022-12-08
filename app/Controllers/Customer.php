<?php

namespace App\Controllers;

use Config\Services;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    public function index()
    {
        return view('retails/customer/list');
    }

    public function add_customer(){
        if ($this->request->getMethod() === 'post') {
            $customerModel = model(CustomerModel::class);
            $name = $this->request->getPost('name');
            $phone = $this->request->getPost('phone');
            $email = $this->request->getPost('email');
            $company = $this->request->getPost('company');
            $address = $this->request->getPost('address');
            $city = $this->request->getPost('city');
            $state = $this->request->getPost('state');
            $postal_code = $this->request->getPost('postal_code');
            $country = $this->request->getPost('country');
            $data = [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'company' => $company,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'postal_code' => $postal_code,
                'country' => $country,
            ];
            $response = $customerModel->insert($data);
            $customerId = $customerModel->insertID();
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Customer addedd', 'customerId'=> $customerId));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to add customer'));
            }
        }else{
            return view('retails/customer/add');
        }
    }

    public function update_customer(){
        $customerModel = model(CustomerModel::class);
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            $name = $this->request->getPost('name');
            $phone = $this->request->getPost('phone');
            $email = $this->request->getPost('email');
            $company = $this->request->getPost('company');
            $address = $this->request->getPost('address');
            $city = $this->request->getPost('city');
            $state = $this->request->getPost('state');
            $postal_code = $this->request->getPost('postal_code');
            $country = $this->request->getPost('country');
            $data = [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'company' => $company,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'postal_code' => $postal_code,
                'country' => $country,
            ];
            $response = $customerModel->update($id, $data);
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Customer addedd'));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to add customer'));
            }
        }else{
            $response =  $customerModel->where('id', $_GET['id'])->first();
            return view('retails/customer/update', [
                'customer' => $response,
            ]);
        }
    }

    public function delete_customer(){
        $customerModel = model(CustomerModel::class);
        if ($this->request->getMethod() === 'get' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = $customerModel->where('id', $id)->delete();
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Customer addedd'));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to add customer'));
            }
        }else{
            return json_encode(array('status' => 400, 'message' => 'Bad Request'));
        }
    }

    public function customerJson()
    {
        $request = service('request');
        $postData = $request->getGet();
        $dtpostData = $postData;
        $response = array();
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value
        ## Total number of records without filtering
        $users = new CustomerModel();
        $totalRecords = $users->select('id')
            ->countAllResults();
        ## Total number of records with filtering
        $totalRecordwithFilter = $users->select('id')
            ->orLike('name', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('phone', $searchValue)
            ->countAllResults();
        ## Fetch records
        $records = $users->select('*')
            ->orLike('name', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('phone', $searchValue)
            ->orderBy($columnName, $columnSortOrder)
            ->findAll($rowperpage, $start);
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $records,
            "token" => csrf_hash()
        );
        return $this->response->setJSON($response);
    }

    public function search_customer()
    {
        $request = service('request');
        $postData = $request->getGet();
        $dtpostData = $postData;
        $terms = $dtpostData['term'];
        $customerModal = new CustomerModel();
        $records = $customerModal->select('*')
            ->orLike('name', $terms)
            ->orLike('phone', $terms)
            ->orLike('email', $terms)
            ->orderBy('name', 'ASC')
            ->findAll();
        return $this->response->setJSON($records);
    }
}
