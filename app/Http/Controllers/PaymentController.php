<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RemoteMerge\Esewa\Client;

class PaymentController extends Controller
{
    public function payment(Post $post)
    {
        $successUrl = route('success');
        $failureUrl = route('failure');
        $pid = uniqid();

        $esewa = new Client([
            'merchant_code' => 'EPAYTEST',
            'success_url' => $successUrl,
            'failure_url' => $failureUrl,
        ]);
        Payment::create([
            'username' => Auth::user()->username,
            'user_id' => Auth::id(),
            'productid' => $pid,
            'price' => $post->price,
            'status' => 'unverified',
        ]);

        $esewa->payment($pid, $post->price, 0, 0, 0);

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

