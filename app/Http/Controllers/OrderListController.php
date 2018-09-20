<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderList;
use App\Product;
use Log;
use Auth;

class OrderListController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ecommerce.order-list');
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
        Log::debug($request->all());
        $request->session()->forget('cart');
        $user = Auth::user()->name;
        $list = $request->all();
        $order_lists = []; 
        $i = 0;
        foreach ($list as $key => $value) {            
            if(Product::find($key)){
                // $order_lists[]=Product::find($key);
                // $order_lists[$i]->{'quantity'} = $value;
                // $order_lists[$i]->{'buyer'} = $user;
                OrderList::create([
                    'name'=> Product::find($key)->name,
                    'price'=> Product::find($key)->price,
                    'quantity'=> $value,
                    'buyer'=> $user

                ]);
            }         
            $i++;            
        }
        return view('ecommerce.order-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->middleware('auth');
        $user = Auth::user()->name;
        return OrderList::where('buyer',$user)->get(); 
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
