<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');
        $url = "date_from={$from_date}";
        $url .= "&date_to={$to_date}";
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
        $onlineDataArray =  json_decode($response, true);
        
        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);

        $grandTotal = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectSum('grand_total')
            ->first()['grand_total'];
        $discount = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectSum('discount')
            ->first()['discount'];
        
        $tax = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectSum('tax')
            ->first()['tax'];

        $salesCount = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectCount('id')
            ->first()['id'];

        $salesItemCount = $salesDetailsModel
            ->where('DATE(sales.date_time) >= ', $from_date)
            ->where('DATE(sales.date_time) <= ', $to_date)
            ->join('sales', 'sales.id=sales_details.sales_id')
            ->selectCount('sales_details.id')
            ->first()['id'];

        
        $retailData = [
            'grandTotal' => ($grandTotal) ? floatval($grandTotal) : 0,
            'discount' => ($discount) ? floatval($discount) : 0,
            'tax' => ($tax) ? floatval($tax) : 0,
            'salesCount' => ($salesCount) ? floatval($salesCount) : 0,
            'salesItemCount' => ($salesItemCount) ? floatval($salesItemCount) : 0,
        ];

        $onlineData = [
            'grandTotal'  => floatval($onlineDataArray['total_sale']),
            'discount' => floatval($onlineDataArray['total_discount']),
            'tax' => floatval($onlineDataArray['total_tax']),
            'salesCount' => floatval($onlineDataArray['orders_count']),
            'salesItemCount' => floatval($onlineDataArray['items_count']),
        ];

        $totalData = [
            'grandTotal' => $onlineData['grandTotal'] + $retailData['grandTotal'] ,
            'discount' => $onlineData['discount'] + $retailData['discount'],
            'tax' => $onlineData['tax'] + $retailData['tax'],
            'salesCount' => $onlineData['salesCount'] + $retailData['salesCount'],
            'salesItemCount' => $onlineData['salesItemCount'] + $retailData['salesItemCount'],
        ];
        $data = [
            'retail' => $retailData,
            'online' => $onlineData,
            'total' => $totalData,
        ];
        return view('dashboard/admin-dashboard', $data);
    }

}
