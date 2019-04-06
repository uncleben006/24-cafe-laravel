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
        $items = [];
        if ( gettype($request->name) == 'string' ){
            $num = 1;
            $items = [ [ 'name'=>$request->name, 'price'=>$request->price, 'qty'=>$request->qty, 'unit'=>env('ECPAY_ITEM_UNIT') ] ];
        }else {
            $num = count($request->name);
            for ($i=0; $i < $num; $i++) { 
                $item = ['name'=>$request->name[$i], 'price'=>$request->price[$i], 'qty'=>$request->qty[$i], 'unit'=>env('ECPAY_ITEM_UNIT') ];
                $items []= $item;
            }
        }
        
        // return $items;
        $formData = [
            'ItemDescription' => env('ECPAY_ITEM_DESCRIPTION'),
            'Items' => $items,
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
            return [ 'status'=>'success', 'number'=> OrderCart::where('user_id', Auth::user()->id)->count() ];
        }else {
            return [ 'status'=>'fail', 'number'=> 0];
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
        // 刪除該筆購屋車資料
        OrderCart::destroy($id);
        // 重新查詢一次，若查詢不到則回傳success
        if( empty( OrderCart::where('id',$id)->get()->first() )) {
            $total = 0;
            $cart = OrderCart::where('user_id', Auth::user()->id)->get();
            foreach ($cart as $key => $value) {            
                $total += $cart[$key]->product->price;
            }
            return [ 'price'=>$total, 'number'=> OrderCart::where('user_id', Auth::user()->id)->count() ];
            return $total;
        }else {
            return 'fail';
        }
    }
}

/**
 * https://vendor-stage.ecpay.com.tw/
 * 4311-9522-2222-2222
 * 222
 * 交易金額最高3萬
 */