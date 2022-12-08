<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class Online_report extends BaseController
{

    public function summary()
    {
        $url = "";
        $fromDate = date('M d,Y');
        $endDate = date('M d,Y');
        
        if(isset($_GET['date'])){
            $dates = $_GET['date'];
            $dateArray = explode(' to ', $dates);
            $url = "";
            if(isset($dateArray[0])){
                $url = "date_from={$dateArray[0]}";
                $fromDate = date('M d, Y', strtotime($dateArray[0]));
            } 
            if(isset($dateArray[1])){
                $url .= "&date_to={$dateArray[1]}";
                $endDate = date('M d, Y', strtotime($dateArray[1]));
            } else {
                $url .= "&date_to={$dateArray[0]}";
                $endDate = date('M d, Y', strtotime($dateArray[0]));
            }
        } else{
            $url = "date_from=" . date('Y-m-d');
            $fromDate = date('M d, Y');
            $url .= "&date_to=" . date('Y-m-d');
            $endDate = date('M d, Y');
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.georgiaphonecase.com/pos_api/api/possummary.php?{$url}",
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
        $data =  json_decode($response, true);
        $data['fromDate'] = $fromDate;
        $data['endDate'] = $endDate;
        return view('online/report/summary', ['data' => $data]);
    }

    public function compare_summary()
    {
        return view('online/report/compare_summary');
    }

    public function summary_json()
    {
        if (isset($_GET['date1']) && isset($_GET['date2'])) {
            $date1 = $_GET['date1'];
            $url = "date_from={$date1}";
            $url .= "&date_to={$date1}";
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.georgiaphonecase.com/pos_api/api/possummary.php?{$url}",
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
            $dateOneData =  json_decode($response, true);
            $dateOneData['date'] = date('M d, Y', strtotime($date1));

            $date2 = $_GET['date2'];
            $url = "date_from={$date2}";
            $url .= "&date_to={$date2}";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.georgiaphonecase.com/pos_api/api/possummary.php?{$url}",
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
            $dateTwoData =  json_decode($response, true);
            $dateTwoData['date'] = date('M d, Y', strtotime($date2));
            
            return json_encode(['status'=>200, 'date1'=> $dateOneData, 'date2'=> $dateTwoData]);
        } 
    }

    public function summary_pdf()
    {
        $url = "";
        $fromDate = date('M d,Y');
        $endDate = date('M d,Y');

        if (isset($_GET['date'])) {
            $dates = $_GET['date'];
            $dateArray = explode(' to ', $dates);
            $url = "";
            if (isset($dateArray[0])) {
                $url = "date_from={$dateArray[0]}";
                $fromDate = date('M d, Y', strtotime($dateArray[0]));
            }
            if (isset($dateArray[1])) {
                $url .= "&date_to={$dateArray[1]}";
                $endDate = date('M d, Y', strtotime($dateArray[1]));
            } else {
                $url .= "&date_to={$dateArray[0]}";
                $endDate = date('M d, Y', strtotime($dateArray[0]));
            }
        } else {
            $url = "date_from=" . date('Y-m-d');
            $fromDate = date('M d, Y');
            $url .= "&date_to=" . date('Y-m-d');
            $endDate = date('M d, Y');
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.georgiaphonecase.com/pos_api/api/possummary.php?{$url}",
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
        $data =  json_decode($response, true);
        $data['fromDate'] = $fromDate;
        $data['endDate'] = $endDate;
        $systemSettingModel = model(SystemSettingModel::class);
        $data['system_setting'] = $systemSettingModel->where('id', '1')->first();

        $html = view('online/report/summary_pdf', ['data' => $data]);
        // return $html;
        // exit;
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->setTempDir('temp'); // temp folder with write permission
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->setOptions($options);
        // $html = "<h1>PDF Example</h1>";
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(
            "online_summary",
            array("Attachment" => false)
        );
        exit(0);

        // $config = array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_port' => '587',
        //     'smtp_user' => 'salahoddin88@gmail.com',
        //     'smtp_pass' => 'dbouxpykfztkdnhj',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8'
        // );

        // $email = \Config\Services::email();
        // $email->initialize($config);
        // $email->setFrom('salahoddin88@gmail.com', 'Your Name');
        // $email->setTo('salahoddin88@gmail.com');
        // $email->setSubject('Email Test');
        // $email->setMessage('Testing the email class.');

        // $email->send();
    }
    
    public function mail_pdf_report(){
        $url = "";
        $fromDate = date('M d,Y');
        $endDate = date('M d,Y');
        $URLDate = (isset($_POST['date']) ? $_POST['date'] : date('Y-m-d'));
        
        if (isset($_POST['date'])) {
            $dates = $_POST['date'];
            $dateArray = explode(' to ', $dates);
            $url = "";
            if (isset($dateArray[0])) {
                $url = "date_from={$dateArray[0]}";
                $fromDate = date('M d, Y', strtotime($dateArray[0]));
            }
            if (isset($dateArray[1])) {
                $url .= "&date_to={$dateArray[1]}";
                $endDate = date('M d, Y', strtotime($dateArray[1]));
            } else {
                $url .= "&date_to={$dateArray[0]}";
                $endDate = date('M d, Y', strtotime($dateArray[0]));
            }
        } else {
            $url = "date_from=" . date('Y-m-d');
            $fromDate = date('M d, Y');
            $url .= "&date_to=" . date('Y-m-d');
            $endDate = date('M d, Y');
        }
        $subject = "Online Summary";
        $message = "{$fromDate} - {$endDate} Online Summary. Find pdf attachment of report";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.georgiaphonecase.com/pos_api/api/possummary.php?{$url}",
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
        $data =  json_decode($response, true);
        $data['fromDate'] = $fromDate;
        $data['endDate'] = $endDate;
        $systemSettingModel = model(SystemSettingModel::class);
        $data['system_setting'] = $systemSettingModel->where('id', '1')->first();
        $html = view('online/report/summary_pdf', ['data' => $data]);
        // return $html;
        // exit;
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->setTempDir('temp'); // temp folder with write permission
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->setOptions($options);
        // $html = "<h1>PDF Example</h1>";
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // $dompdf->stream();
        $name = "public/invoice/mail-pdf-summary.pdf";
        file_put_contents($name, $dompdf->output());
        
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
        $email->setTo('salahoddin88@gmail.com');
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->attach($name);
        if ($email->send()) {
            // return json_encode(array('status' => 200, 'message' => 'Report send'));
            $this->session->setFlashdata('flashData', ['status' => 200, 'message' => 'Report send successfuly']);
        }
        $this->session->setFlashdata('flashData', ['status' => 400, 'message' => 'Unable to send report SMTP config error.']);
        return redirect()->to('online_report/summary?date='. $URLDate);
    }
    
    
    public function send_mail(){
        
    }
}
