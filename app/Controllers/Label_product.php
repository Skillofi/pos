<?php

namespace App\Controllers;

use Config\Services;
use App\Models\LabelProductModel;
// use Zend\Barcode\Object\Code39;

class Label_product extends BaseController
{
    public function index()
    {
        return view('label/product/list');
    }

    public function add_product(){
        if ($this->request->getMethod() === 'post') {
            $labelProductModel = model(LabelProductModel::class);
            $dnumber = $this->request->getPost('dnumber');
            $brand = $this->request->getPost('brand');
            $make = $this->request->getPost('make');
            $storage = $this->request->getPost('storage');
            $model_no = $this->request->getPost('model_no');
            $color = $this->request->getPost('color');
            $grade = $this->request->getPost('grade');
            $icloud = $this->request->getPost('icloud');
            $carrier = $this->request->getPost('carrier');
            $data = [
                'dnumber' => $dnumber,
                'brand' => $brand,
                'make' => $make,
                'storage' => $storage,
                'model_no' => $model_no,
                'color' => $color,
                'grade' => $grade,
                'icloud' => $icloud,
                'carrier' => $carrier,
            ];
            $response = $labelProductModel->insert($data);
            $productId = $labelProductModel->insertID();
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Product addedd', 'productId' => $productId));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to add product'));
            }
        }else{
            return view('label/product/add');
        }
    }
    
    public function update_product(){
        $labelProductModel = model(LabelProductModel::class);
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            $dnumber = $this->request->getPost('dnumber');
            $brand = $this->request->getPost('brand');
            $make = $this->request->getPost('make');
            $storage = $this->request->getPost('storage');
            $model_no = $this->request->getPost('model_no');
            $color = $this->request->getPost('color');
            $grade = $this->request->getPost('grade');
            $icloud = $this->request->getPost('icloud');
            $carrier = $this->request->getPost('carrier');
            $data = [
                'dnumber' => $dnumber,
                'brand' => $brand,
                'make' => $make,
                'storage' => $storage,
                'model_no' => $model_no,
                'color' => $color,
                'grade' => $grade,
                'icloud' => $icloud,
                'carrier' => $carrier,
            ];
            $response = $labelProductModel->update($id, $data);
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Product updated'));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to update product'));
            }
        }else{
            $response =  $labelProductModel->where('id', $_GET['id'])->first();
            return view('label/product/update', [
                'product' => $response,
            ]);
        }
    }
    
    public function delete_product(){
        $labelProductModel = model(LabelProductModel::class);
        if ($this->request->getMethod() === 'get' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = $labelProductModel->where('id', $id)->delete();
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Product deleted'));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to delete product'));
            }
        }else{
            return json_encode(array('status' => 400, 'message' => 'Bad Request'));
        }
    }
    
    public function productJson()
    {
        
        $request = service('request');
        $postData = $request->getGet();
        
        $dtpostData = $postData;
        $response = array();
        
        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value
        
        ## Total number of records without filtering
        $productModal = new LabelProductModel();
        $totalRecords = $productModal->select('id')
        ->countAllResults();
        
        $productModal->select('id');
        $termsArray = explode(" ", $searchValue);
        foreach($termsArray as $value){
            $productModal->Like('dnumber', $value);
            $productModal->Like('make', $value);    
        }
        $totalRecordwithFilter = $productModal
        ->countAllResults();
        
        ## Fetch records
        
        $productModal->select('*');
        $termsArray = explode(" ", $searchValue);
        foreach($termsArray as $value){
            $productModal->Like('dnumber', $value);    
            $productModal->Like('make', $value);    
        }
        $records= $productModal
        ->orderBy($columnName, $columnSortOrder)
        ->findAll($rowperpage, $start);
        
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $records,
            "token" => csrf_hash()
        );
        
        return $this->response->setJSON($response);
    }
    
    public function search_product()
    {
        $request = service('request');
        $postData = $request->getGet();
        $dtpostData = $postData;
        $terms = $dtpostData['term'];
        $productModal = new LabelProductModel();
        $productModal->select('*');
        
        $termsArray = explode(" ", $terms);
        foreach($termsArray as $value){
            $productModal->Like('dnumber', "%{$value}%");
            $productModal->ORLike('make', $value);     
        }
        $records = $productModal
        ->orderBy('dnumber', 'ASC')
        ->findAll();
        return $this->response->setJSON($records);
    }

    public function print_label() {
        return view('label/print/label');
    }

    public function labeling(){
        $productId = $this->request->getPost('productId');
        $size = $this->request->getPost('size');
        $iemis = $this->request->getPost('iemi');
        $labelProductModel = model(LabelProductModel::class);
        $product =  $labelProductModel->where('id', $productId)->first();
        $data = [
            'product' => $product,
            'size' => $size,
            'iemis' => $iemis,
        ];
        // C39E Barcode standard
        return view('label/print/label-print', $data);
    }



    public function barcode()
	{
        $options = ['text' => 'ZEND-FRAMEWORK', 'barHeight' => 40];
        echo APPPATH . 'Library\Zend\Barcode';
        // exit;
        // Case 1: constructor
        $barcode = new \ZendObject\Code39();
        

        // // Case 2: setOptions()
        // $barcode = new Barcode\Object\Code39();
        // $barcode->setOptions($options);

        // // Case 3: individual setters
        // $barcode = new Barcode\Object\Code39();
        $barcode->setText('ZEND-FRAMEWORK')
        ->setBarHeight(40);
	}
}
