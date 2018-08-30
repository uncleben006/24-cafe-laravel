<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    public function list()
    {
        return view('product-list');
    }

    public function add_cart(Request $request, $id)
    {
        $prev = $request->session()->get('cart');
        $arr = [];
        if( $prev != null ){
            $arr = json_decode($prev);
        }
        $arr[] = $id;
        $request->session()->put('cart', json_encode($arr));
        return (['status'=>true]);
    }

    public function list_cart(Request $request)
    {
        // return json_decode($request->session()->get('cart'));
        // 取得當初存入 session 中的 id 陣列，然後再排序、歸類
        $session_value = json_decode($request->session()->get('cart'));
        if ($session_value){
            sort($session_value);   
            $session_value = array_count_values($session_value);   
        } else {
            $session_value = array();
        }

        // 用 session id 陣列來搜尋 product，取得完整的產品資料，再傳給 $prod_list      
        $prod_list = [];         
        $i = 0;
        foreach($session_value as $key => $value){
            // echo "Key: $key";
            // echo "Value: $value";
            $prod_list[] = Product::find($key);           
            if($prod_list[$i]){
                $prod_list[$i]->{'quantity'} = $value;
            }
            $i++;                
        };        
        // echo $i;   
        // print_r($prod_list);
        return $prod_list;
    }

    public function cart(Request $request)
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find(c);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
