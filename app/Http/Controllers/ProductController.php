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
     * Display all products api
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        return Product::all();
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
     * Include product id, name, price, description, created time, updated time.
     * Note: Multiple images information will be stored into product_images DB which related to product DB.
     * Note: Multiple images will be stored into the file under storage/public/images.
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
        // $extension = $request->file('image')->getClientOriginalExtension();        
        
        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
        ]);

        // 好像也可以用 Product::orderBy('id', 'desc')->first()->id; 找時間測試一下
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
        // if images[] = null , 只清空product DB
        // Product::destroy($id);
        // if($request->images) {
        //     Storage::deleteDirectory("/public/images/$id");
            
        //     $image_path = '/public/images/'.$id.'/';
        //     foreach ($request->images as $image) {
        //         $fileName = $image->getClientOriginalName();     
        //         $image->storeAs($image_path, $fileName);
        //         ProductImage::create([
        //             'product_id' => $product->id,
        //             'filename' => $fileName
        //         ]);
        //     }    
        // }
        // return $request->images;
        return $request->all();
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
