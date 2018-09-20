<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Log;
use Auth;
use Illuminate\Support\Facades\Storage;

use Image;
use Illuminate\Support\Str;

// Validator
use Validator;

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
        return view('products.product-list');
    }

    public function add_cart(Request $request, $id)
    {
        $prev = $request->session()->get('cart');
        $arr = [];
        if( $prev != null ){
            $arr = $prev;
        }
        $arr[] = $id;
        $request->session()->put('cart', $arr);
        return (['status'=>true]);
    }

    public function list_cart(Request $request)
    {
        // return json_decode($request->session()->get('cart'));
        // 取得當初存入 session 中的 id 陣列，然後再排序、歸類
        $session_value = $request->session()->get('cart');
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
            if(Product::find($key)){
                $prod_list[] = Product::find($key);  
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
        return view('products.product-cart');
    }

    // 只有管理員有權限查看的產品清單，包含新增與刪除功能
    public function job() 
    {
        return view('products.product-job');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.product-job-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'=>'required:',
            'price'=>'required|integer',
        ]);
        if ($validate->fails()) {
            return redirect('/products/job/new/')
                        ->withErrors($validate)
                        ->withInput();
        }
        
        $fileName = $request->file('image')->getClientOriginalName();

        // $extension = $request->file('image')->getClientOriginalExtension();
        // return $request->file('image')->getClientOriginalName();
        
        
        $request->file('image')->storeAs("public/images/", $fileName);
        
        // $image_path = public_path("storage/images/$fileName"); 
        // $img = Image::make($image_path)->resize(320,240)->save($image_path);
        // return $img->response('jpg');
        // $img = Image::make("public/images/$fileName")->resize(320, 240)->insert("public/images/$fileName");
        
        $url = url('/');
        $filePath = "$url/storage/images/$fileName";
        Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image_name'=>$fileName,
            'image_path'=>$filePath,
        ]);
        return redirect('/products/job');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.product-detail', [
            'product' => Product::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.product-edit',[
            'product' => Product::find($id)
        ]);
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
        $filename = Product::find($id)->image_name;
        Storage::delete("/public/images/$filename");
        Product::destroy($id);
        return redirect('/products/job');
    }
}
