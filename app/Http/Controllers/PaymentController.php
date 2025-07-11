<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RemoteMerge\Esewa\Client;

class PaymentController extends Controller
{
    public function paymentProcess(Post $post)
    {
//        $pid = uniqid();
//        $amount = $post->price;
        $amount = 100;
        $tax_amount = 0;
        $total_amount = $amount + $tax_amount;
        $transaction_uuid = uuid_create();
        $product_code = "EPAYTEST";
        $product_service_charge = 0;
        $product_delivery_charge = 0;
        $success_url = "https://developer.esewa.com.np/success";
        $failure_url = "https://developer.esewa.com.np/failure";
        $signed_field_names = 'total_amount,transaction_uuid,product_code';
        $s = hash_hmac('sha256', 'total_amount=' . $total_amount . ',transaction_uuid=11-201-13,product_code=EPAYTEST', '8gBm/:&EnhH.1/q', true);
//        $signature = base64_encode($s);
        $signature = 'i94zsd3oXF6ZsSr/kGqT4sSzYQzjj1W/waxjWyRwaME=';
//        dd($signature);
//        $esewa = new Client([
//            'merchant_code' => 'EPAYTEST',
//            'success_url' => $successUrl,
//            'failure_url' => $failureUrl,
//        ]);

//        Payment::create([
//            'username' => Auth::user()->username,
//            'user_id' => Auth::id(),
//            'productid' => $pid,
//            'price' => $post->price,
//            'status' => 'unverified',
//        ]);

        $this->generateForm(compact('amount', 'tax_amount', 'total_amount', 'transaction_uuid', 'product_code', 'product_service_charge', 'product_delivery_charge', 'success_url', 'failure_url', 'signed_field_names', 'signature'));
    }

    public function generateForm($fields)
    {
//        dd($fields);
        $apiUrl = 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';
        $htmlForm = '<form action="' . $apiUrl . '" method="POST"' . 'id="esewa-form">';
        foreach ($fields as $name => $value) {
            $htmlForm .= sprintf('<input id="%s" type="text" name="%s" value="%s" required>', $name, $name, $value);
        }
        $htmlForm .= '</form><script type="text/javascript">document.getElementById("esewa-form").submit();</script>';
//        dd($htmlForm);
        echo $htmlForm;
    }

    public function success()
    {
//        $status = $esewa->verifyPayment('R101', 'P101W201', 245);
//        if ($status) {
//            // Verification successful.
//        }
    }

    public function failure()
    {
        dd('failure');
    }
}

