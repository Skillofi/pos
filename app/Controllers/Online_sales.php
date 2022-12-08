<?php

namespace App\Controllers;

class Online_sales extends BaseController
{

    public function index()
    {
        return view('online/sales/list');
    }


    public function pos()
    {
        return view('online/sales/pos');
    }

    public function send_invoice_email(){
        $id = $_GET['id'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.georgiaphonecase.com/pos_api/api/receipt.php?id=' . $id,
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
        $response = json_decode($response, true);
        $settingModel = model(OnlineSettingModel::class);
        $systemSettingModel = model(SystemSettingModel::class);
        $setting =  $settingModel->first();
        $systemSetting = $systemSettingModel->where('id', '1')->first();
        $img = file_get_contents(base_url('public/uploads/' . $systemSetting['logo']));
        $logo = base64_encode($img);
        $data = [
            'sale' => $response,
            'setting' => $setting,
            'logo' => $logo,
        ];
        $html = view('online/sales/invoice', $data);
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->setTempDir('temp'); // temp folder with write permission
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->setOptions($options);
        // $html = "<h1>PDF Example</h1>";
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $name = "public/invoice/online-invoice.pdf";
        file_put_contents($name, $dompdf->output());
        if($response['email']){
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
            $email->setTo($response['email']);
            $subject = "Invoice";
            $message = "Thank you for shopping with us, please find invoice attachment";
            $email->setSubject($subject);
            $email->setMessage($message);
            $email->attach($name);
            if($email->send()){
                return json_encode(array('status' => 200, 'message' => 'Order created successfuly'));
            }
            return json_encode(array('status' => 400, 'message' => 'Unbale to send mail, SMTP config error'));
        }
        return json_encode(array('status' => 400, 'message' => 'Customer does not have email address'));
    }

    public function generate_pdf(){
        if ($this->request->getMethod() === 'get') {
            $id = $_GET['id'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.georgiaphonecase.com/pos_api/api/receipt.php?id='. $id,
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
            $response = json_decode($response, true);
            $settingModel = model(OnlineSettingModel::class);
            $systemSettingModel = model(SystemSettingModel::class);
            $setting =  $settingModel->first();
            $systemSetting = $systemSettingModel->where('id', '1')->first();
            $img = file_get_contents(base_url('public/uploads/' . $systemSetting['logo']));
            $logo = base64_encode($img);
            $data = [
                'sale' => $response,
                'setting' => $setting,
                'logo' => $logo,
            ];
            $html = view('online/sales/invoice', $data);
            $options = new \Dompdf\Options();
            $options->set('isRemoteEnabled', true);
            $options->setTempDir('temp'); // temp folder with write permission
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->setOptions($options);
            // $html = "<h1>PDF Example</h1>";
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("{$id}-invoice", array("Attachment" => false));
            exit(0);
            // $name = "public/online_invoice/{$id}-invoice.pdf";
            // file_put_contents($name, $dompdf->output());
        }
    }
}
