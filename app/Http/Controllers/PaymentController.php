<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use RemoteMerge\Esewa\Client;

class PaymentController extends Controller
{
    public function paymentProcess(Post $post)
    {
        $amount = $post->price;
        $tax_amount = 10;
        $total_amount = $amount + $tax_amount;
        $transaction_uuid = uuid_create();
        $product_code = "EPAYTEST";
        $product_service_charge = 0;
        $product_delivery_charge = 0;

        $signed_field_names = 'total_amount,transaction_uuid,product_code';
        $s = hash_hmac('sha256', 'total_amount=' . $total_amount . ',transaction_uuid=' . $transaction_uuid . ',product_code=EPAYTEST', '8gBm/:&EnhH.1/q', true);
        $signature = base64_encode($s);
        $success_url = route('success');
        $failure_url = route('failure');

        Payment::create([
            'username' => Auth::user()->username,
            'user_id' => Auth::id(),
            'productid' => $transaction_uuid,
            'price' => $post->price,
            'status' => 'unverified',
        ]);

        $this->generateForm(compact('amount', 'tax_amount', 'total_amount', 'transaction_uuid', 'product_code', 'product_service_charge', 'product_delivery_charge', 'success_url', 'failure_url', 'signed_field_names', 'signature'));
    }

    public function generateForm($fields)
    {
        $apiUrl = config('app.esewa');
        $htmlForm = '<form action="' . $apiUrl . '" method="POST"' . 'id="esewa-form">';
        foreach ($fields as $name => $value) {
            $htmlForm .= sprintf('<input id="%s" type="text" name="%s" value="%s" required>', $name, $name, $value);
        }
        $htmlForm .= '</form><script type="text/javascript">document.getElementById("esewa-form").submit();</script>';
        echo $htmlForm;
    }

    public function success()
    {
        $decodedData = json_decode(base64_decode($_GET['data']));


        $statusCheck = json_decode(Http::get(config('app.esewaStatus'), [
            'product_code' => "EPAYTEST",
            'total_amount' => $decodedData->total_amount,
            'transaction_uuid' => $decodedData->transaction_uuid,
        ]));
        if ($statusCheck->status=='COMPLETE'){
            $payment = Payment::where('productid', $decodedData->transaction_uuid)->first();

            $payment->status = $statusCheck->status;
            $payment->save();

            return redirect("https://developer.esewa.com.np/success");
        }
        else return redirect("https://developer.esewa.com.np/failure");



    }

    public function failure()
    {
//        $decodedData = json_decode(base64_decode($_GET['data']));
//        dd("here");
//        $payment = Payment::where('productid',$decodedData->transaction_uuid)->get();
//        $payment -> status = $decodedData->status;
//        $payment->save();
        return redirect("https://developer.esewa.com.np/failure");
    }
}

