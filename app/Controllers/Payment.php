<?php

namespace App\Controllers;

class Payment extends BaseController
{
    public function add_payment(){
        if ($this->request->getMethod() === 'post') {
            $paymentModel = model(PaymentModel::class);
            $data = $this->request->getPost();
            $salesId = $this->request->getPost('sales_id');
            $amount = $this->request->getPost('amount');
            $payment_method = $this->request->getPost('payment_method');
            $payment_note = $this->request->getPost('payment_note');
            $datetime = $this->request->getPost('datetime');
            $paymentData = [
                'sales_id' => $salesId,
                'amount' => $amount,
                'payment_method' => $payment_method,
                'payment_note' => $payment_note,
                'datetime' => $datetime
            ];
            $paymentModel->insert($paymentData);
            return json_encode(['status'=>200, 'message' => 'Payment Added']);
        }else{
            $data = ['sales_id' => $_GET['sales_id']];
            return view('retails/payment/add', $data);
        }
    }

    public function update_payment(){
        $paymentModel = model(PaymentModel::class);
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            $amount = $this->request->getPost('amount');
            $payment_method = $this->request->getPost('payment_method');
            $payment_note = $this->request->getPost('payment_note');
            $datetime = $this->request->getPost('datetime');
            $paymentData = [
                'amount' => $amount,
                'payment_method' => $payment_method,
                'payment_note' => $payment_note,
                'datetime' => $datetime
            ];
            $paymentModel->update($id, $paymentData);
            return json_encode(['status' => 200, 'message' => 'Payment Updated']);
        } else {
            $payment = $paymentModel
                    ->where('id', $_GET['payment_id'])
                    ->first();
            $data = ['payment' => $payment];
            return view('retails/payment/edit', $data);
        }
    }

    public function delete_payment(){
        $paymentModel = model(paymentModel::class);
        if ($this->request->getMethod() === 'get' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = $paymentModel->where('id', $id)->delete();
            if ($response) {
                return json_encode(array('status' => 200, 'message' => 'payment deleted'));
            }else{
                return json_encode(array('status' => 400, 'message' => 'Unable to delete payment'));
            }
        }else{
            return json_encode(array('status' => 400, 'message' => 'Bad Request'));
        }
    }

}
