<?php

namespace App\Controllers;

use Config\Services;
use App\Models\ProductModel;

class Product extends BaseController
{
    public function index()
    {
        return view('retails/product/list');
    }

    public function add_product(){
        if ($this->request->getMethod() === 'post') {
            $productModel = model(ProductModel::class);
            $name = $this->request->getPost('name');
            $code = $this->request->getPost('code');
            $price = $this->request->getPost('price');
            $stock = $this->request->getPost('stock');
            $data = [
                'name' => $name,
                'code' => $code,
                'price' => $price,
                'stock' => $stock,
            ];
            $response = $productModel->insert($data);
            $productId = $productModel->insertID();
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Product addedd', 'productId' => $productId));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to add product'));
            }
        }else{
            return view('retails/product/add');
        }
    }
    
    public function update_product(){
        $productModel = model(ProductModel::class);
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            $name = $this->request->getPost('name');
            $code = $this->request->getPost('code');
            $price = $this->request->getPost('price');
            $stock = $this->request->getPost('stock');
            $data = [
                'name' => $name,
                'code' => $code,
                'price' => $price,
                'stock' => $stock,
            ];
            $response = $productModel->update($id, $data);
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'Product updated'));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to update product'));
            }
        }else{
            $response =  $productModel->where('id', $_GET['id'])->first();
            return view('retails/product/update', [
                'product' => $response,
            ]);
        }
    }
    
    public function delete_product(){
        $productModel = model(ProductModel::class);
        if ($this->request->getMethod() === 'get' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = $productModel->where('id', $id)->delete();
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
        $productModal = new ProductModel();
        $totalRecords = $productModal->select('id')
        ->countAllResults();
        
        $productModal->select('id');
        $termsArray = explode(" ", $searchValue);
        foreach($termsArray as $value){
            $productModal->Like('name', $value);    
        }
        $totalRecordwithFilter = $productModal
        ->countAllResults();
        
        ## Fetch records
        
        $productModal->select('*');
        $termsArray = explode(" ", $searchValue);
        foreach($termsArray as $value){
            $productModal->Like('name', $value);    
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
        $productModal = new ProductModel();
        $productModal->select('*');
        
        $termsArray = explode(" ", $terms);
        foreach($termsArray as $value){
            $productModal->Like('name', $value);    
        }
        $records = $productModal
        ->orderBy('name', 'ASC')
        ->findAll();
        return $this->response->setJSON($records);
    }

    public function sync_products(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.georgiaphonecase.com/pos_api/api/all_products.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $products = json_decode($response, true);
        $productModel = model(ProductModel::class);
        foreach($products as $product){
            if(isset($product['id']) && $product['id']){
                $checkProduct = $productModel->where('post_id', $product['id'])->first();
                if(!$checkProduct){
                    if($product['name'] && $product['price'] && $product['stock']){
                        $data = [
                            'name' => $product['name'],
                            'code' => $product['id'],
                            'price' => $product['price'],
                            'stock' => $product['stock'],
                            'post_id' => $product['id'],
                        ];
                        $response = $productModel->insert($data);   
                    }
                }else{
                    $data = [
                        'name' => $product['name'],
                        'code' => $product['id'],
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'post_id' => $product['id'],
                    ];
                    $response = $productModel->update($checkProduct['id'], $data);   
                }
            }
        }
        return json_encode(['status' => 200, 'message' => 'Product sync has been completed']);
    }
}
