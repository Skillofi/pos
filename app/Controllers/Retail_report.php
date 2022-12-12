<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\SalesDetailsModel;


class Retail_report extends BaseController
{
    public function summary()
    {
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');
        if (isset($_GET['date'])) {
            $dates = $_GET['date'];
            $dateArray = explode(' to ', $dates);
            if (isset($dateArray[0]) && $dateArray[0]) {
                $from_date = date('Y-m-d', strtotime($dateArray[0]));
            }
            if (isset($dateArray[1]) && $dateArray[1]) {
                $to_date = date('Y-m-d', strtotime($dateArray[1]));
            } else {
                $to_date = date('Y-m-d', strtotime($dateArray[0]));
            }
        }
        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);
        $paymentModel = model(PaymentModel::class);

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
        $shipping = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectSum('shipping')
            ->first()['shipping'];
        $tax = $salesModel
                ->where('DATE(date_time) >= ', $from_date)
                ->where('DATE(date_time) <= ', $to_date)
                ->selectSum('tax_calc')
                ->first()['tax_calc'];

        $salesCount = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectCount('id')
            ->first()['id'];


        $cashTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Cash')
            ->selectSum('amount')
            ->first()['amount'];

        $giftCardTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Gift Card')
            ->selectSum('amount')
            ->first()['amount'];

        $creditCardTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Credit Card')
            ->selectSum('amount')
            ->first()['amount'];

        $chequeTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Cheque')
            ->selectSum('amount')
            ->first()['amount'];

        $otherTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Other')
            ->selectSum('amount')
            ->first()['amount'];


        $zelle = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Zelle')
            ->selectSum('amount')
            ->first()['amount'];

        $cashApp = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Cash App')
            ->selectSum('amount')
            ->first()['amount'];

        $depositeTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Deposite')
            ->selectSum('amount')
            ->first()['amount'];

        $totalPayment = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->selectSum('amount')
            ->first()['amount'];

        $salesItemCount = $salesDetailsModel
            ->where('DATE(sales.date_time) >= ', $from_date)
            ->where('DATE(sales.date_time) <= ', $to_date)
            ->join('sales', 'sales.id=sales_details.sales_id')
            ->selectCount('sales_details.id')
            ->first()['id'];

        $totalSale = floatval($grandTotal) + floatval($discount) - floatval($shipping) - floatval($tax) ;
        $data = [
                'totalSale' => ($totalSale) ? floatval($totalSale) : 0,
                'discount' => ($discount) ? floatval($discount) : 0,
                'shipping' => ($shipping) ? floatval($shipping) : 0,
                'tax' => ($tax) ? floatval($tax) : 0,
                'grandTotal' => ($grandTotal) ? floatval($grandTotal) : 0,
                'salesCount' => ($salesCount) ? floatval($salesCount) : 0,
                'salesItemCount' => ($salesItemCount) ? floatval($salesItemCount) : 0,
                'from_date' => date('M d, Y', strtotime($from_date)),
                'to_date' => date('M d, Y', strtotime($to_date)),

                'cashTotal' => $cashTotal,
                'giftCardTotal' => $giftCardTotal,
                'creditCardTotal' => $creditCardTotal,
                'chequeTotal' => $chequeTotal,
                'otherTotal' => $otherTotal,
                'depositeTotal' => $depositeTotal,
                'totalPayment' => $totalPayment,
                'zelle' => $zelle,
                'cashApp' => $cashApp,
            ];
        
        return view('retails/sales/summary', $data);
    }

    public function summary_pdf()
    {
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');
        if (isset($_GET['date'])) {
            $dates = $_GET['date'];
            $dateArray = explode(' to ', $dates);
            if (isset($dateArray[0]) && $dateArray[0]) {
                $from_date = date('Y-m-d', strtotime($dateArray[0]));
            }
            if (isset($dateArray[1]) && $dateArray[1]) {
                $to_date = date('Y-m-d', strtotime($dateArray[1]));
            }
        }
        $salesModel = model(SalesModel::class);
        $salesDetailsModel = model(SalesDetailsModel::class);
        $paymentModel = model(PaymentModel::class);
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
        $shipping = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectSum('shipping')
            ->first()['shipping'];
        $tax = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectSum('tax_calc')
            ->first()['tax_calc'];

        $salesCount = $salesModel
            ->where('DATE(date_time) >= ', $from_date)
            ->where('DATE(date_time) <= ', $to_date)
            ->selectCount('id')
            ->first()['id'];

        $cashTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Cash')
            ->selectSum('amount')
            ->first()['amount'];

        $giftCardTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Gift Card')
            ->selectSum('amount')
            ->first()['amount'];

        $creditCardTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Credit Card')
            ->selectSum('amount')
            ->first()['amount'];

        $chequeTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Cheque')
            ->selectSum('amount')
            ->first()['amount'];

        $otherTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Other')
            ->selectSum('amount')
            ->first()['amount'];


        $zelle = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Zelle')
            ->selectSum('amount')
            ->first()['amount'];

        $cashApp = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Cash App')
            ->selectSum('amount')
            ->first()['amount'];

        $depositeTotal = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->where('payment_method', 'Deposite')
            ->selectSum('amount')
            ->first()['amount'];

        $totalPayment = $paymentModel
            ->where('DATE(datetime) >= ', $from_date)
            ->where('DATE(datetime) <= ', $to_date)
            ->selectSum('amount')
            ->first()['amount'];

        $salesItemCount = $salesDetailsModel
            ->where('DATE(sales.date_time) >= ', $from_date)
            ->where('DATE(sales.date_time) <= ', $to_date)
            ->join('sales', 'sales.id=sales_details.sales_id')
            ->selectCount('sales_details.id')
            ->first()['id'];

        $totalSale = floatval($grandTotal) + floatval($discount) - floatval($shipping) - floatval($tax);
        $data = [
            'totalSale' => ($totalSale) ? floatval($totalSale) : 0,
            'discount' => ($discount) ? floatval($discount) : 0,
            'shipping' => ($shipping) ? floatval($shipping) : 0,
            'tax' => ($tax) ? floatval($tax) : 0,
            'grandTotal' => ($grandTotal) ? floatval($grandTotal) : 0,
            'salesCount' => ($salesCount) ? floatval($salesCount) : 0,
            'salesItemCount' => ($salesItemCount) ? floatval($salesItemCount) : 0,
            'from_date' => date('M d, Y', strtotime($from_date)),
            'to_date' => date('M d, Y', strtotime($to_date)),

            'cashTotal' => $cashTotal,
            'giftCardTotal' => $giftCardTotal,
            'creditCardTotal' => $creditCardTotal,
            'chequeTotal' => $chequeTotal,
            'otherTotal' => $otherTotal,
            'depositeTotal' => $depositeTotal,
            'totalPayment' => $totalPayment,
            'zelle' => $zelle,
            'cashApp' => $cashApp,
        ];
        $systemSettingModel = model(SystemSettingModel::class);
        $system_setting = $systemSettingModel->where('id', '1')->first();
        $settingModel = model(RetailSettingModel::class);
        $data['setting'] =  $settingModel->first();
        $data['logo'] = base_url('public/uploads/'. $system_setting['logo']);
        $html = view('retails/sales/summary_pdf', $data);
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->setTempDir('temp');
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(
            "retail_summary",
            array("Attachment" => false)
        );
        exit(0);
        // return redirect()->to('online_report/summary?' . $_GET['date']);
    }
}
