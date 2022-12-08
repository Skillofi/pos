<?php

namespace App\Models;
use CodeIgniter\Model;


class AuthenticationModel extends Model
{
    public function authenticate($username, $password)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.georgiaphonecase.com/pos_api/api/login.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('username' => $username, 'password' => $password),
        ));
        $jsonResponse = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($jsonResponse, true);
        if($response['status'] == 200){
            $session = \Config\Services::session();
            $newdata = [
                'userId'  => $response['id'],
                'email'  => $response['name'],
                'display_name'  => $response['display_name'],
                'isAuthenticated' => TRUE
            ];
            $session->set($newdata);
            return array('status' => 200, 'message' => 'Login successful');
        }elseif($response['status'] == 400){
            return array('status' => 400, 'message' => 'Wrong password');
        }
        return array('status' => 404, 'message' => 'Login credentials not found');
    }

}

