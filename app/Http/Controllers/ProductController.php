<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
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
        return view('ecommerce.product-cart');
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
        // return $request->all();
        // $file = $request->file('image');
        // $filePath =[];  // 定义空数组用来存放图片路径
        // foreach ($file as $key => $value) {
        //     // 判断图片上传中是否出错
        //     if (!$value->isValid()) {
        //         exit("上传图片出错，请重试！");
        //     }
        //     if($value){//此处防止没有多文件上传的情况
        //         $allowed_extensions = ["png", "jpg", "gif"];
        //         if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
        //             exit('您只能上传PNG、JPG或GIF格式的图片！');
        //         }
        //         $destinationPath = '/app/public/images/'.date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
        //         $extension = $value->getClientOriginalExtension();   // 上传文件后缀
        //         $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension; // 重命名

        //         // $request->file('image')->storeAs(public_path().$destinationPath, $fileName);

        //         $value->move(storage_path().$destinationPath, $fileName); // 保存图片
        //         $filePath[] = $destinationPath.'/'.$fileName;   

        //     }
        // }
        // return gettype($filePath);



        $validate = Validator::make($request->all(), [
            'name'=>'required:',
            'price'=>'required|integer',
        ]);       
        
        if ($validate->fails()) {
            return redirect('/products/job/new/')
                        ->withErrors($validate)
                        ->withInput();
        }      
        // $extension = $request->file('image')->getClientOriginalExtension();        
        
        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
        ]);

        $nowProductID =  Product::where('name',$request->name)->get()->first()->id;
        $image_path = '/public/images/'.$nowProductID.'/';

        foreach ($request->images as $image) {
            $fileName = $image->getClientOriginalName();     
            $image->storeAs($image_path, $fileName);
            ProductImage::create([
                'product_id' => $product->id,
                'filename' => $fileName
            ]);
        }     
        return redirect('/products/job');
    }
    /**
     * To get image real path
     */
    public function getImagePath($fileName)
    {
        $url = url('/');
        $image_path = "$url/storage/images/$fileName";
        return $image_path;
    }
    /**
     * To show images api
     */
    public function images($id)
    {
        return ProductImage::where('product_id', $id)->get();
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
        Storage::deleteDirectory("/public/images/$id");
        Product::destroy($id);
        return redirect('/products/job');
    }
}
