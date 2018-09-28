<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Racket;
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
     * Display all products api
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        // 把各類的產品資料庫都merge起來，去掉id，sortby product_id
        $merge = Racket::all()->merge(Product::all());
        return Product::all();
    }
    public function racketApi()
    {
        return Racket::all();
    }
    /**
     * Display single product api
     */
    public function singleApi($id)
    {
        return Product::find($id);
    }
    /**
     * Display images api
     */
    public function imagesApi($id)
    {
        return ProductImage::where('product_id', $id)->get();
    }
    /**
     * Display products list
     */
    public function list()
    {
        return view('products.product-list');
    }
    /**
     * Display products rackets list
     */
    public function showRackets()
    {
        return view('products.product-rackets');
    }
    /**
     * Add product into shopping cart
     */
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
    /**
     * Display shopping cart api
     */
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
    /**
     * Display shopping cart interface
     */
    public function cart(Request $request)
    {
        return view('ecommerce.product-cart');
    }

    /**
     * Display product job. 
     * Including add, edit and delete function to adjust product database. 
     * Will only show on administrator's navigation.
     */
    public function job() 
    {
        return view('products.product-job');
    }

    /**
     * Display product form to create a new product.
     *
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
        $product = Product::create([
            'name'=>$request->name
        ]);        

        switch ($request->category) {
            case 'Rackets':
                return self::storeRacket($product->id, $request);
                break;
            case 'Footwear':
                return "You choose Footwear";
                break;
            case 'Bag':
                return "You choose Bag";
                break;
            case 'Apparel':
                return "You choose Apparel";
                break;
            case 'Accessories':
                return "You choose Accessories";
                break;
        }
    } 
    /**
     *  Store a racket into product database, and then store the images. 
     */
    public function storeRacket($id, $request)
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

        $racket = Racket::create([
            'product_id'=>$id,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description||'',
            'series'=>$request->series||'',
            'categories'=>$request->categories||'',
            'rank'=>$request->rank||'',
            'brands'=>$request->brands||''
        ]);

        return self::storeImage($id,$request);
    }
    /**
     * Store images into product image database.
     */
    public function storeImage($id, $request)
    {        
        
        $image_path = '/public/images/'.$id.'/';
        if($request->images){
            foreach ($request->images as $image) {
                echo 
                $fileName = $image->getClientOriginalName();     
                $image->storeAs($image_path, $fileName);
                ProductImage::create([
                    'product_id' => $id,
                    'filename' => $fileName
                ]);
            }   
        }        
        return redirect('/products/job');
    }
    /**
     * Display product detail page.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return view('products.product-detail', [
            'product' => Product::find($id),
        ]);
    }

    /**
     * Display the product edit form to edit the specified product.
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        // 如果有上傳圖片，則刪除原本資料結構裡的圖片，
        // 同時刪除資料庫裡的圖片，並新增新的圖
        if($request->images) {
            Storage::deleteDirectory("/public/images/$id");
            $originalImages = ProductImage::where('product_id',$id);
            $originalImages->delete();     
            $image_path = '/public/images/'.$id.'/';
            foreach ($request->images as $image) {
                $fileName = $image->getClientOriginalName();                     
                $image->storeAs($image_path, $fileName);
                ProductImage::create([
                    'product_id' => $id,
                    'filename' => $fileName
                ]);
            }    
        }
        return redirect('/products/job');
    }

    /**
     * Remove the specified file from storage, including the images inside.
     * Remove the information from products DB and product_images DB.
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
