<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use Auth;

class PaymentController extends Controller
{
    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
        $this->middleware('auth');
    }
    public function sendOrder(Request $request)
    {
        $formData = [
            'ItemDescription' => env('ECPAY_ITEM_DESCRIPTION'),
            // 'ItemName' => $request->ItemName,
            // 'TotalAmount' => $request->TotalAmount,
            'Items' => [
                ['name'=>$request->name, 'qty'=>$request->qty, 'price'=>$request->price, 'unit'=>env('ECPAY_ITEM_UNIT')]
            ],
            'PaymentMethod' => env('ECPAY_PAYMENT_METHOD'), // ALL, Credit, ATM, WebATM
            'UserId' => Auth::user()->id
        ];
        $this->checkout->setReturnUrl(env('ECPAY_RETURN_URL'));
        return $this->checkout->setPostData($formData)->send();
    }
    public function show()
    {   
        echo "show merchantID ".$this->checkout->showMerchantID()."<br>show hashkey ".$this->checkout->showHashKey();
        return;
    }
    public function showSuccess()
    {
        return view('payment-success');
    }
}

/**
 * https://vendor-stage.ecpay.com.tw/
 * 4311-9522-2222-2222
 * 222
 * 交易金額最高3萬
 */