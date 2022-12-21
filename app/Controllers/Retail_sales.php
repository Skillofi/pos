<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\SalesDetailsModel;
use App\Models\PaymentModel;

class Retail_sales extends BaseController
{
    public function index()
    {
        return view('retails/sales/pos');
    }

    public function generatePDF($salesId = 0, $sendEmail=False)
    {
        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);
        $settingModel = model(RetailSettingModel::class);
        $systemSettingModel = model(SystemSettingModel::class);
        $setting =  $settingModel->first();
        $sale =  $salesModel
                    ->select('sales.id salesId, sales.*, customer.id customer_id, customer.*')
                    ->where('sales.id', $salesId)
                    ->join('customer', 'customer.id = sales.customer_id', 'left')
                    ->first();
        $salesDetails = $salesDetailsModel
                            ->select('sales_details.*, product.name')
                            ->join('product', 'product.id=sales_details.product_id', 'inner')
                            ->where('sales_id', $salesId)->findAll();
        $systemSetting = $systemSettingModel->where('id', '1')->first();

        $data = [
            'sale' => $sale,
            'salesDetails' => $salesDetails,
            'setting' => $setting,
            'systemSetting' => $systemSetting,
        ];
        $html = view('retails/sales/invoice', $data);
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->setTempDir('temp');
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $name = "public/invoice/{$salesId}-invoice.pdf";
        file_put_contents($name, $dompdf->output());
        
        if($sendEmail==True){
            if ($sale['email']) {
                $email = \Config\Services::email();
                $email->protocol = 'smtp';
                $email->SMTPHost = 'mail.georgiaphonecase.com';
                $email->SMTPPort = '587';
                $email->SMTPUser = 'billing@georgiaphonecase.com';
                $email->SMTPPass = 'GeorgiaZim#321!';
                $email->mailType  = 'html';
                $email->charset   = 'utf-';
                $email->setNewline("\r\n");
                $email->setCRLF("\r\n");
                $email->setFrom('billing@georgiaphonecase.com', 'Georgia Phone Case');
                // $email->setTo('salahoddin88@gmail.com');
                $email->setTo($sale['email']);
                $subject = "Invoice ".$sale['reference_no'];
                $message = "Thank you for shopping with us, please find invoice attachment";
                $email->setSubject($subject);
                $email->setMessage($message);
                $email->attach($name);
                $email->send();
            }
        }
        return array('status' => 200, 'invoice' => $name);
    }

    public function add_sales(){
        if ($this->request->getMethod() === 'post') {
            $salesModel = model(SalesModel::class);
            $data = $this->request->getPost('data');
            $customer_id = $data['customer'];
            $date_time = $data['date_time'];
            $warehouse = $data['warehouse'];
            $tax = $data['tax'];
            $discount = $data['discount'];
            $shipping = $data['shipping'];
            $status = $data['status'];
            $payment_status = $data['payment_status'];
            $sale_note = $data['sale_note'];
            $staff_note = $data['staff_note'];
            $send_email = $data['send_email'];
            $paymentAmount = $data['amount'];
            $payment_method = $data['payment_method'];
            $payment_note = $data['payment_note'];
            $reference_no = $salesModel->selectMax('reference_no')->first()['reference_no'] + 1;
            $reference_no = (str_pad($reference_no, 7, '0', STR_PAD_LEFT));
            $salesData = [
                'customer_id' => $customer_id,
                'date_time' => $date_time,
                'reference_no' => $reference_no,
                'warehouse' => $warehouse,
                'tax' => $tax,
                'discount' => $discount,
                'shipping' => $shipping,
                'status' => $status,
                'payment_status' => $payment_status,
                'sale_note' => $sale_note,
                'staff_note' => $staff_note,
            ];
            
            $salesModel->insert($salesData);
            $salesId = $salesModel->insertID();
            if($payment_status == 'Partial' || $payment_status == 'Paid'){
                $paymentModel = model(PaymentModel::class);
                $paymentData = [
                    'sales_id' => $salesId,
                    'amount' => $paymentAmount,
                    'payment_method' => $payment_method,
                    'payment_note' => $payment_note,
                ];
                $paymentModel->insert($paymentData);
            }
            $products = $data['products'];
            $salesDetailsModel = model(SalesDetailsModel::class);
            $grandTotal = 0;
            foreach($products as $product){
                $amount = floatval($product['price']) * floatval($product['qty']);
                $salesDetailsData = [
                    'sales_id' => $salesId,
                    'product_id' => $product['productId'],
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'amount' => floatval($product['price']) * floatval($product['qty']),
                ];
                $salesDetailsModel->insert($salesDetailsData);
                $grandTotal = floatval($grandTotal)+ floatval($amount);
            }
            $grandTotal = floatval($grandTotal) - floatval($discount);
            $taxTotal = (floatval($grandTotal) * floatval($tax)) / 100;
            $grandTotal = (floatval($grandTotal) + floatval($taxTotal) + floatval($shipping));
            $response = $salesModel->update($salesId, ['grand_total' => $grandTotal, 'tax_calc' => $taxTotal]);
            $sendEmail = False;
            if($send_email == 1){
                $sendEmail = True;
            }
            $pdfResponse = $this->generatePDF($salesId, $sendEmail);
            if($pdfResponse['status'] == 200){
                $response = $salesModel->update($salesId, ['invoice' => $pdfResponse['invoice']]);
                echo json_encode(array('status' => 200, 'salesId'=> $salesId, 'message' => 'Order created'));
                $this->session->setFlashdata('flashData', ['status' => 200, 'message' => 'Order created']);
            }else{
                echo json_encode(array('status' => 400, 'salesId'=> $salesId, 'message' => 'Unable to generate invoice'));
                $this->session->setFlashdata('flashData', ['status' => 400, 'message' => 'Unable to generate invoice']);
            }
        }else{
            echo json_encode(array('status' => 400, 'message'=> 'Bad request'));
            $this->session->setFlashdata('flashData', ['status' => 400, 'message' => 'Bad request']);
        }
    }

    public function edit_sale($salesId=0){
        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);
        $sales = $salesModel->select('sales.*, customer.name, customer.email, customer.phone, customer.address')
                            ->where('sales.id', $salesId)
                            ->join('customer', 'customer.id=sales.customer_id', 'left')
                            ->first();
        $salesDetails = $salesDetailsModel
                            ->select('sales_details.*, product.name')
                            ->where('sales_details.sales_id', $salesId)
                            ->join('product', 'sales_details.product_id=product.id', 'left')
                            ->findAll();
        $data = [
            'sales' => $sales,
            'salesDetails'  => $salesDetails,
        ];
        return view('retails/sales/edit', $data);
    }

    public function edit_sales(){
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost('data');
            $salesId = $data['sales_id'];
            $date_time = $data['date_time'];
            $reference_no = $data['reference_no'];
            $warehouse = $data['warehouse'];
            $tax = $data['tax'];
            $discount = $data['discount'];
            $shipping = $data['shipping'];
            $payment_status = $data['payment_status'];
            $sale_note = $data['sale_note'];
            $staff_note = $data['staff_note'];
            $send_email = $data['send_email'];
            $salesData = [
                'date_time' => $date_time,
                'reference_no' => $reference_no,
                'warehouse' => $warehouse,
                'tax' => $tax,
                'discount' => $discount,
                'shipping' => $shipping,
                'payment_status' => $payment_status,
                'sale_note' => $sale_note,
                'staff_note' => $staff_note,
            ];
            $salesModel = model(SalesModel::class);
            $salesModel->update($salesId, $salesData);
            $products = $data['products'];
            $salesDetailsModel = model(SalesDetailsModel::class);
            $grandTotal = 0;
            foreach($products as $product){
                $amount = floatval($product['price']) * floatval($product['qty']);
                $salesDetailsId = $product['salesDetailsId'];
                $salesDetailsData = [
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'amount' => floatval($product['price']) * floatval($product['qty']),
                ];
                $salesDetailsModel->update($salesDetailsId, $salesDetailsData);
                $grandTotal = floatval($grandTotal)+ floatval($amount);
            }
            $removedProducts = (isset($data['removedProduct'])) ? $data['removedProduct'] : [];
            if($removedProducts){
                foreach($removedProducts as $salesDetailsId){
                    $salesDetailsModel->where('id', $salesDetailsId)->delete();
                }
            }
            $grandTotal = floatval($grandTotal) - floatval($discount);
            $taxTotal = (floatval($grandTotal) * floatval($tax)) / 100;
            $grandTotal = (floatval($grandTotal) + floatval($taxTotal) + floatval($shipping));
            $response = $salesModel->update($salesId, ['grand_total' => $grandTotal, 'tax_calc'=> $taxTotal]);
            $sendEmail = False;
            if ($send_email == 1) {
                $sendEmail = True;
            }
            $pdfResponse = $this->generatePDF($salesId);
            if ($pdfResponse['status'] == 200) {
                $response = $salesModel->update($salesId, ['invoice' => $pdfResponse['invoice']]);
                $this->session->setFlashdata('flashData', ['status' => 200, 'message' => 'Order created']);
                return json_encode(array('status' => 200, 'salesId' => $salesId, 'message' => 'Order created'));
            } else {
                $this->session->setFlashdata('flashData', ['status' => 400, 'message' => 'Unable to generate invoice']);
                return json_encode(array('status' => 400, 'salesId' => $salesId, 'message' => 'Unable to generate invoice'));
            }
        }else{
            $this->session->setFlashdata('flashData', ['status' => 400, 'message' => 'Bad request']);
            return json_encode(array('status' => 400, 'message'=> 'Bad request'));
        }
    }

    public function delete_sales()
    {
        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);

        if ($this->request->getMethod() === 'get' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $salesResponse = $salesModel->where('id', $id)->delete();
            $salesDetailsResponse = $salesDetailsModel->where('sales_id', $id)->delete();
            if ($salesResponse && $salesDetailsResponse) {
                return json_encode(array('status' => 200, 'message' => 'Sales deleted'));
            } else {
                return json_encode(array('status' => 400, 'message' => 'Unable to delete product'));
            }
        } else {
            return json_encode(array('status' => 400, 'message' => 'Bad Request'));
        }
    }

    public function list()
    {
        return view('retails/sales/list');
    }

    public function salesJson()
    {
        $request = service('request');
        $salesModel = model(SalesModel::class);
        $paymentModel = model(PaymentModel::class);
        $postData = $request->getGet();
        $dtpostData = $postData;
        $response = array();
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length'];
        $columnIndex = $dtpostData['order'][0]['column'];
        $columnName = $dtpostData['columns'][$columnIndex]['data'];
        $columnSortOrder = $dtpostData['order'][0]['dir'];
        $searchValue = $dtpostData['search']['value'];
        $totalRecords = $salesModel->select('id')
            ->countAllResults();

        $totalRecordwithFilter = $salesModel->select('sales.*, customer.name')
            ->orLike('sales.id', $searchValue)
            ->orLike('customer.name', $searchValue)
            ->orLike('customer.email', $searchValue)
            ->orLike('customer.phone', $searchValue)
            ->orderBy($columnName, $columnSortOrder)
            ->join('customer', 'customer.id = sales.customer_id', 'left')
            ->countAllResults();
            
            $records = $salesModel->select('sales.*, customer.name')
            ->orLike('sales.id', $searchValue)
            ->orLike('customer.name', $searchValue)
            ->orLike('customer.email', $searchValue)
            ->orLike('customer.phone', $searchValue)
            ->orderBy($columnName, $columnSortOrder)
            ->join('customer', 'customer.id = sales.customer_id', 'left')
            ->findAll($rowperpage, $start);

        $data = array();

        foreach ($records as $record) {
            $paidAmount = $paymentModel
                ->selectSum('amount')
                ->where('sales_id', $record['id'])
                ->first();
            $record['paid_amount'] = floatVal($paidAmount['amount']);
            $record['balance'] = floatVal($record['grand_total']) - floatVal($record['paid_amount']);
            $data[] = $record;
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "token" => csrf_hash() // New token hash
        );

        return $this->response->setJSON($response);
    }

    public function sales_details($salesId = 0)
    {

        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);
        $paymentModel = model(PaymentModel::class);
        $sales = $salesModel
                            ->select('sales.*, customer.name, customer.email, customer.phone, customer.address')
                            ->where('sales.id', $salesId)
                            ->join('customer', 'customer.id=sales.customer_id', 'left')
                            ->first();
        $salesDetails = $salesDetailsModel
                            ->select('sales_details.*, product.name')
                            ->where('sales_details.sales_id', $salesId)
                            ->join('product', 'sales_details.product_id=product.id', 'left')
                            ->findAll();

        $paidAmount = $paymentModel
                            ->selectSum('amount')
                            ->where('sales_id', $salesId)
                            ->first();
        
        $payments = $paymentModel
                        ->where('sales_id', $salesId)
                        ->orderBy('datetime', 'DESC')
                        ->findAll();
        $data = [
            'sales' => $sales,
            'salesDetails'  => $salesDetails,
            'payments'  => $payments,
            'paidAmount' => $paidAmount,
        ];
        return view('retails/sales/sales_details', $data);
    }
    
}
