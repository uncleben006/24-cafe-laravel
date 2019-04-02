<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use Auth;
use App\OrderCart;

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
    /**
     * 從 product-detail page 接到 post 資料後傳到購物車資料庫，並回傳成功或失敗
     */
    public function putCart(Request $request)
    {   

        $cart_product = OrderCart::create([
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id,
            'qty'=>$request->qty
        ]);
        if($cart_product){
            return 'success';
        }else {
            return 'fail';
        }
        
    }
    public function showCart()
    {   
        /**
         * 給 OrderCart 的 user_id 跟 product_id 做一個簡單的關聯，
         * laravel就會把被關聯的所有資料都附加上去喔喔喔!!
         * 這裡只是把 OrderCart 的兩個 id 指向關聯方法中的 id 而已，
         * 但資料量就會瞬間增加!!讚
         */
        $cart = OrderCart::where('user_id', Auth::user()->id)->get();
        foreach ($cart as $key => $value) {            
            $value->user_id = $cart[$key]->user->id;
            $value->product_id = $cart[$key]->product->id;
        }
        return view('cart',[
            'cart' => $cart
        ]);
    }

    public function showSuccess()
    {
        return view('payment-success');
    }

    public function deleteCart(Request $request)
    {
        $id = $request->id;
        // OrderCart::destroy($id);
        return $id;
    }
}

/**
 * https://vendor-stage.ecpay.com.tw/
 * 4311-9522-2222-2222
 * 222
 * 交易金額最高3萬
 */