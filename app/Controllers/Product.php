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
        $users = new ProductModel();
        $totalRecords = $users->select('id')
            ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $users->select('id')
            ->orLike('name', $searchValue)
            ->orLike('price', $searchValue)
            ->orLike('stock', $searchValue)
            ->countAllResults();

        ## Fetch records
        $records = $users->select('*')
            ->orLike('name', $searchValue)
            ->orLike('price', $searchValue)
            ->orLike('stock', $searchValue)
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
        $records = $productModal->select('*')
            ->orLike('name', $terms)
            ->orLike('code', $terms)
            ->orderBy('name', 'ASC')
            ->findAll();
        return $this->response->setJSON($records);
    }
}
